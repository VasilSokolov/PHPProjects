<?php
namespace App\Controller;

class ContactController extends AuthorizedController {
	
	public function index() {
		
		$paginator = new \Pragmatic\DBAL\Paginator(10);
		
		$contacts = \App\Model\Contact::listUserItems($this->activeUser->getId(), '', $paginator);
		$this->render(array(
			'contacts' => $contacts,
			'paginator' => $paginator
		), 'list.php');
		
	}
	
	public function addNumber() {
		
		$contactId = intval($this->request->get('contactId', $this->request->post('contactId')));
			
		$contact = \App\Model\Contact::loadByIdForUser($this->activeUser->getId(), $contactId);

		if (empty($contact)) {
			$this->response->redirect('contact', 'index');
		}
		
		$numberObject = new \App\Model\Contact\Number();
		
		$data = \Pragmatic\ModelHelper::modelToArray($numberObject, $numberObject);
		
		if ( $this->request->method() == \Pragmatic\Request::METHOD_POST ) {
			
			try {
				$number = new \App\Model\Contact\Number();
				$number->setNumber($this->request->post('number'))
						->setType($this->request->post('type'));

				$contact->addNumber($number);

				$contact->update();
				$this->response->redirect('contact', 'index');
			} catch (\Exception $e) {
				\Pragmatic\FlashMessage::write(nl2br($e->getMessage()));
				
			}
		}
		
		$data['types'] = $numberObject->getAvialableTypes();
		$data['contactId'] = $contact->getId();
		$this->render($data, 'numberForm.php');
		
	}
	
	public function deleteNumber() {
		$contactId = intval($this->request->get('contactId'));
		$numberId = intval($this->request->get('numberId'));
		$contact = \App\Model\Contact::loadByIdForUser($this->activeUser->getId(), $contactId);
		if (empty($contact)) {
			$this->response->redirect('contact', 'index');
		}
		
		if ($contact->removeNumber($numberId)) {
			$contact->update();
		}
		
		$this->response->redirect('contact', 'index');
		
	}
	
	public function updateNumber() {
		$contactId = intval($this->request->get('contactId', $this->request->post('contactId')));
		$numberId = intval($this->request->get('numberId', $this->request->post('numberId')));
		
		$contact = \App\Model\Contact::loadByIdForUser($this->activeUser->getId(), $contactId);
		
		if (empty($contact) ) {
			$this->response->redirect('contact', 'index');
		}
		
		$numbers = $contact->getNumbers();
		if ( !key_exists($numberId, $numbers) ) {
			$this->response->redirect('contact', 'index');	
		}
		
		$numberObject = $numbers[$numberId];
		
		$data = \Pragmatic\ModelHelper::modelToArray($numberObject, $numberObject);
		
		if ( $this->request->method() == \Pragmatic\Request::METHOD_POST ) {
			
			try {
				$numberObject->setNumber($this->request->post('number'))
						->setType($this->request->post('type'));
				
				$contact->update();
				$this->response->redirect('contact', 'index');
			} catch (\Exception $e) {
				\Pragmatic\FlashMessage::write(nl2br($e->getMessage()));
				
			}
		}
		
		$data['types'] = $numberObject->getAvialableTypes();
		$data['contactId'] = $contact->getId();
		$this->render($data, 'numberForm.php');
	}
	
	public function create() {
		
		$contactObject = new \App\Model\Contact();
		
		$data = \Pragmatic\ModelHelper::modelToArray($contactObject, false);
		
		if ( $this->request->method() == \Pragmatic\Request::METHOD_POST ) {
			try {
				$contactObject = \App\Model\Contact::createFromPOSTData($this->request->post());
				$contactObject->setUserId($this->activeUser->getId());
				$contactObject->insert();
				$this->response->redirect('contact', 'index');
			} catch (Exception $ex) {
				\Pragmatic\FlashMessage::write(nl2br($e->getMessage()));
			}
			$data = $this->request->post();
		}
		
		$this->render($data, 'form.php');
	}
	
	public function update() {
		
		$contactId = intval($this->request->get('id',$this->request->post('id')));
		$contact = \App\Model\Contact::loadByIdForUser($this->activeUser->getId(), $contactId);
		if (empty($contact)) {
			$this->response->redirect('contact', 'index');
		}
		
		$data = \Pragmatic\ModelHelper::modelToArray($contact, false);
		
		if ( $this->request->method() == \Pragmatic\Request::METHOD_POST ) {
			
			try {
				$contact->hydrateFromPOSTData($this->request->post());
				$contact->update();
				$this->response->redirect('contact', 'index');
			} catch (Exception $ex) {
				\Pragmatic\FlashMessage::write(nl2br($e->getMessage()));
			}
			$data = $this->request->post();
		}
		
		
		$this->render($data, 'form.php');
	}
	
	public function delete() {
		$contactId = intval($this->request->get('id'));
		$contact = \App\Model\Contact::loadByIdForUser($this->activeUser->getId(), $contactId);
		if (empty($contact)) {
			$this->response->redirect('contact', 'index');
		}
		$contact->delete();
		
		$this->response->redirect('contact', 'index');
	}
	
}

