<?php
namespace App\Controller;

class UserController extends AuthorizedController {
	
	public function __construct($request, $session, $response) {
		$this->authorizeExceptions = [
			'user' => array('login','register')
		];
		parent::__construct($request, $session, $response);
	}
	
	public function index() {
		$data = \Pragmatic\ModelHelper::modelToArray($this->activeUser, false);
		
		if ( $this->request->method() == \Pragmatic\Request::METHOD_POST ) {
			
			try {
				$this->activeUser->hydrateFromPOSTData($this->request->post());
				$this->activeUser->update();
				$this->setActiveUser($this->activeUser);
				\Pragmatic\FlashMessage::write("User with id {$this->activeUser->getId()} updated successfully ");
				$this->response->redirect('user', 'index');
			} catch ( \Exception $e ) {
				\Pragmatic\FlashMessage::write(nl2br($e->getMessage()));
			}
		
		}
		
		$this->render($data, 'form.php');
	}
	
	
	public function register() {
		
		$userObject = new \App\Model\User();
		
		$data = \Pragmatic\ModelHelper::modelToArray($userObject, false);
		
		if ( $this->request->method() == \Pragmatic\Request::METHOD_POST ) {
			
			try {
				$userObject = \App\Model\User::createFromPOSTData($this->request->post());
				$userObject->insert();
				$this->response->redirect('user', 'login');
			} catch ( \Exception $e ) {
				\Pragmatic\FlashMessage::write(nl2br($e->getMessage()));
				$data = $this->request->post();
			}
		
		}
		
		$this->render($data, 'form.php');
		
	}
	
	public function login() {
		
		if ( $this->request->method() == \Pragmatic\Request::METHOD_POST ) {
			
			$user = \App\Model\User::login($this->request->post('username'), $this->request->post('password'));
			
			if ( !empty($user) ) {
				$this->setActiveUser($user);
				$this->response->redirect('contact', 'index');
			}
			
			\Pragmatic\FlashMessage::write("Invalid username or password");
			
		}
		
		$this->renderTpl(array(), 'login.php');
		
	}
	
	public function logout() {
		$this->session->destroy();
		$this->response->redirect('user', 'login');
	}
	
	protected function renderTpl($data, $tpl) {
		$content = $this->view->render($tpl, $data, true);
		$this->response->addContent($content);
		return $this->response;
	}
	
}

