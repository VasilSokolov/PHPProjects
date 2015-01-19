<?php
namespace App\Model;

use \Pragmatic\Model as Model;

class User extends Model {
	
	protected $username;
	protected $password;
	protected $email;
	protected $firstName;
	protected $lastName;
	
	protected static $tableName = 'user';


	public function getUsername() {
		return $this->username;
	}

	public function getPassword() {
		return $this->password;
	}

	public function getEmail() {
		return $this->email;
	}

	public function getFirstName() {
		return $this->firstName;
	}

	public function getLastName() {
		return $this->lastName;
	}

	public function setUsername($username) {
		if ( !$this->validate('username', $username) ) {
			return false;
		}
		$this->username = $username;
	}

	public function setPassword($password) {
		if ( !$this->validate('password', $password) ) {
			return false;
		}
		$this->password = $password;
	}

	public function setEmail($email) {
		if ( !$this->validate('email', $email) ) {
			return false;
		}
		$this->email = $email;
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
	
	public static function login($username, $password) {
		
		$where = "`username` = ".static::$dataBase->escape($username);
		$where .= "AND `password` = ".static::$dataBase->escape($password);
		$matchedUsers = static::$dataBase->select(static::$tableName, $where, "LIMIT 1");
		
		if ( empty($matchedUsers) ) {
			return null;
		}
		
		$user = self::hydrateDBData(array_pop($matchedUsers));
		
		return $user;
		
	}


	
}