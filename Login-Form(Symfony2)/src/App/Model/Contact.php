<?php
namespace App\Model;

use \Pragmatic\Model as Model;
use \Pragmatic\DBAL\TableJoin as TableJoin;
use \Pragmatic\ModelHelper as ModelHelper;

class Contact extends Model {
	
	protected $firstName;
	protected $lastName;
	protected $address;
	protected $email;
	protected $userId;
	protected $phoneNumbers = array();
	protected $deletedNumbers = array();
	
	protected static $tableName = 'contacts';
	
	
	public function getFirstName() {
		return $this->firstName;
	}

	public function getLastName() {
		return $this->lastName;
	}

	public function getAddress() {
		return $this->address;
	}

	public function getEmail() {
		return $this->email;
	}

	public function getUserId() {
		return $this->userId;
	}

	public function setFirstName($firstName) {
		if ( !$this->validate('firstName', $firstName) ) {
			return false;
		}
		$this->firstName = $firstName;
	}

	public function setLastName($lastName) {
		if ( !$this->validate('lastName', $lastName) ) {
			return false;
		}
		$this->lastName = $lastName;
	}

	public function setAddress($address) {
		if ( !$this->validate('address', $address) ) {
			return false;
		}
		$this->address = $address;
	}

	public function setEmail($email) {
		if ( !$this->validate('email', $email) ) {
			return false;
		}
		$this->email = $email;
	}

	public function setUserId($userId) {
		if ( !$this->validate('userId', $userId) ) {
			return false;
		}
		$this->userId = $userId;
	}
	
	/**
	 * 
	 * @return Contact\Number[]
	 */
	public function getNumbers() {
		return $this->phoneNumbers;
	}


	public function addNumber(Contact\Number $number) {
		$this->phoneNumbers[$this->generateNewNumberId()] = $number;
	}
	
	protected function generateNewNumberId() {
		return 'NEW'.count($this->phoneNumbers);
	}
	
	public function removeNumber($numberId) {
		if (key_exists($numberId, $this->phoneNumbers) ) {
			unset($this->phoneNumbers[$numberId]);
			$this->deletedNumbers[] = $numberId;
			return true;
		}
		return false;
	}

	/**
	 * 
	 * Internal method to fetch all joins
	 * 
	 * @return type
	 */
	protected static function getJoins() {
	
		$contactHasNumbers = new TableJoin();
		$contactHasNumbers->setJoinType(TableJoin::JOIN_LEFT)
				->setRightTable('phone_numbers')
				->setLeftColumns('id')
				->setRightColumns('contacts_id')
				->setLeftTable(static::$tableName);
		
		return array($contactHasNumbers);
		
	}
	
	/**
	 * 
	 * Internal method for fetching all columns definition
	 * 
	 * @return string
	 */
	protected static function getColumns() {
		$columnsToSelect = "`".static::$tableName."`.*, "
				. "GROUP_CONCAT(`phone_numbers`.`id` ORDER BY `phone_numbers`.`id`) as number_ids, "
				. "GROUP_CONCAT(`phone_numbers`.`number` ORDER BY `phone_numbers`.`id`) as numbers, "
				. "GROUP_CONCAT(`phone_numbers`.`type` ORDER BY `phone_numbers`.`id`) as number_types ";
		
		return $columnsToSelect;
		
	}
	
	/**
	 * 
	 * Internal method for fetching the group by condition
	 * 
	 * @return string
	 */
	protected static function getGroupBy() {
		return '`'.static::$tableName.'`.`id`';
	}

	/**
	 * Internal method to create and populate an Order object with data from the database
	 * @param type $dbData
	 * @return \App\Model\Contact
	 */
	protected static function hydrateDBData($dbData) {
		$contact = parent::hydrateDBData($dbData);
		
		if ( !empty($dbData['number_ids']) ) {
		
			$numberIds = explode(',', $dbData['number_ids']);
			$numbers = explode(',', $dbData['numbers']);
			$numberTypes = explode(',', $dbData['number_types']);
			
			foreach ( $numberIds as $idx => $numberId ) {
				$number = new Contact\Number();
				$number->setId($numberId)
						->setNumber($numbers[$idx])
						->setType($numberTypes[$idx]);
				$contact->phoneNumbers[$numberId] = $number;
			}
			
		}
		
		return $contact;
	}

	/**
	 * 
	 * Updates the database with the current data in the category object
	 * 
	 * @return boolean
	 */
	public function update() {
		if ( $this->id === null ) {
			throw new \Exception("This contact instance does not have an id, it is probably not in the database");
		}
		
		if (parent::update()) {
			//Now add all product ids to the table
			
			foreach ( $this->phoneNumbers as $numberId => $number ) {
				/* @var $number Contact\Number */
				if (strpos($numberId, 'NEW') !== false ) {
					static::$dataBase->insert(
						'phone_numbers', 
						array('contacts_id'=>$this->getId(), 'number'=>$number->getNumber(),'type'=>$number->getType())
						);
				} else {
					static::$dataBase->updateById(
						'phone_numbers', 
						array('contacts_id'=>$this->getId(), 'number'=>$number->getNumber(),'type'=>$number->getType()),
						$numberId
						);
				}
			}
			
			foreach ($this->deletedNumbers as $deletedNumber) {
				self::$dataBase->deleteById('phone_numbers', $deletedNumber);
			}
			
		}
	}
	
	protected function toArray() {
		$dataToStore = ModelHelper::modelToArray($this);
		unset($dataToStore['phone_numbers']);
		return $dataToStore;
	}
	
	/**
	 * Deletes the current contact object from the database
	 * @return boolean
	 */
	public function delete() {
		
		if ( $this->id === null ) {
			throw new \Exception("This model instance does not have an id, it is probably not in the database");
		}
		
		//First delete all numbers in the order
		static::$dataBase->delete('phone_numbers', "`contacts_id` = '{$this->id}'");
		parent::delete();
	}
	
	/**
	 * Inserts the current contact object into the database
	 * @return boolean
	 */
	public function insert() {
		
		if ( parent::insert() ) {			
			//Now add all numbers ids to the table
			foreach ( $this->phoneNumbers as $numberId => $number ) {
				/* @var $number Contact\Number */
				static::$dataBase->insert(
					'phone_numbers', 
					array('contacts_id'=>$this->getId(), 'number'=>$number->getNumber(),'type'=>$number->getType())
					);
			}
			
			return true;
		} else {
			return false;
		}
		
	}
	
	public static function listUserItems($userId, $where = '', \Pragmatic\DBAL\Paginator $paginator = null) {
		$where = self::ammendWhere($userId, $where);
		return parent::listItems($where, $paginator);
	}
	
	public static function loadByIdForUser($userId, $id) {
		$where = self::ammendWhere($userId, "`".static::$tableName."`.id = ".self::$dataBase->escape($id));
		$items = parent::listItems($where);
		if ( empty($items) ) {
			return array();
		}
		return array_pop($items);
	}

	protected static function ammendWhere($userId, $where) {
		if ( !empty($where) ) {
			$where = "($where) AND";
		}
		
		$where.=" `".static::$tableName."`.`user_id` = $userId";
		
		return $where;
	}

	
}