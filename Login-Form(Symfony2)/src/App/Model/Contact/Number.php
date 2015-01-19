<?php
namespace App\Model\Contact;

use \Pragmatic\Model as Model;

class Number {
	
	protected $id;
	protected $number;
	protected $type;
	
	protected static $types = array('work','home','mobile');
	
	public function getId() {
		return $this->id;
	}
	
	public function getNumber() {
		return $this->number;
	}

	public function getType() {
		return $this->type;
	}
	
	public function setId($id) {
		$this->id = $id;
		return $this;
	}

	public function setNumber($number) {
		$this->number = $number;
		return $this;
	}

	public function setType($type) {
		
		if ( !in_array($type, static::$types) ) {
			throw new Exception("Invalid number type $type");
		}
		
		$this->type = $type;
		return $this;
	}
	
	public function getAvialableTypes() {
		return self::$types;
	}


	
}