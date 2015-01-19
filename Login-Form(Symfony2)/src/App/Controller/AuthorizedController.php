<?php
namespace App\Controller;

class AuthorizedController extends \Pragmatic\Controller {
	
	/**
	 *
	 * @var \App\Model\User
	 */
	protected $activeUser;
	protected $userSessionKey = 'user';

	protected $authorizeExceptions = array();
	
	protected $loginController = 'user';
	protected $loginAction = 'login';

	public function __construct($request, $session, $response) {
		parent::__construct($request, $session, $response);
		
		
		if ( !$this->isUserLogged() && !$this->isActionExcepted() ) {
			$this->response->redirect($this->loginController, $this->loginAction);
		}
		
		$this->activeUser = $this->getLoggedUser();
		
	}
	
	protected function isActionExcepted() {
		
		foreach ( $this->authorizeExceptions as $controller => $actions ) {
			foreach ( $actions as $action ) {
			if ( 
				$controller == $this->request->get('controller')
				&& $action == $this->request->get('action')
				) {
					return true;
				}
			}
			
		}
		
		return false;
		
	}
	
	protected function isUserLogged() {
		$user = $this->session->get($this->userSessionKey); 
		return  $user !== null && $user instanceof \App\Model\User;
	}

	protected function setActiveUser(\App\Model\User $user) {
		$this->activeUser = $user;
		$this->session->set($this->userSessionKey, $user);
	}

	private function getLoggedUser() {
		return $this->session->get($this->userSessionKey);
	}
	
	protected function render($data, $tpl) {
		
		$data = array(
			'data' => $data,
			'user' => $this->activeUser
		);
		
		parent::render($data, $tpl);
	}
	
}

