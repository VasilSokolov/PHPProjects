<?php
require_once __DIR__.'/../DB/Connection.php';
class User {
    
    protected $id;
    protected $username;
    protected $password;
    protected $first_name;
    protected $last_name;
    protected $email;
    protected $address;
    protected $phone_number;
    
    /**
     *
     * @var Connection
     */
    protected static $db;
    
    protected static $table = 'users';
    
    public static function setDB(Connection $db) {
        self::$db = $db;
    }


    public function getId() {
        return $this->id;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getFirstName() {
        return $this->first_name;
    }

    public function getLastName() {
        return $this->last_name;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getAddress() {
        return $this->address;
    }

    public function getPhoneNumber() {
        return $this->phone_number;
    }

    public function setUsername($username) {
        
        if ($username == 'admin') {
            throw new Exception("Incorrect username should not be 'admin'");
        }
        
        if (!preg_match('/^[a-z][a-z0-9]{7,15}$/i', $username)) {
            throw new Exception("Incorrect username should match '/^[a-z][a-z0-9]{7,15}$/i'");
        }
        $this->username = $username;
        return true;
    }

    public function setPassword($password) {
        $this->password = md5($password);
        return true;
    }

    public function setFirstName($first_name) {
        if (!preg_match('/^[a-z]{2,255}$/i', $first_name)) {
            throw new Exception("Incorrect FirstName should match '/^[a-z]{2,255}$/i'");
        }
        $this->first_name = $first_name;
        return true;
    }

    public function setLastName($last_name) {
        if (!preg_match('/^[a-z]{2,255}$/i', $last_name)) {
            throw new Exception("Incorrect LastName should match '/^[a-z]{2,255}$/i'");
        }
        $this->last_name = $last_name;
        return true;
    }

    public function setEmail($email) {
        if (!preg_match('/^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,6}$/i', $email)) {
            throw new Exception("Incorrect Email should match '/^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,6}$/i'");
        }
        $this->email = $email;
        return true;
    }

    public function setAddress($address) {        
        if (!preg_match('/^.{10,255}$/i', $address)) {
            throw new Exception("Incorrect Address should match '/^.{10,255}$/i'");
        }
        $this->address = $address;
        return true;
    }

    public function setPhoneNumber($phone_number) {
        if (!preg_match('/^[0-9+\s().]{8,255}$/i', $phone_number)) {
            throw new Exception("Incorrect PhoneNumber should match '/^[0-9+\s().]{8,255}$/i'");
        }
        $this->phone_number = $phone_number;
        return true;
    }
    
    public function toArray() {
        $data = array(
            'id' => $this->id,
            'username' => $this->username,
            'password' => $this->password,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'address' => $this->address,
            'phone_number' => $this->phone_number,
        );
        return $data;
    }
    
    public function insert() {
        self::$db->insert(self::$table, $this->toArray());
        $this->id = self::$db->getLastId();
    }
    
    public function updete() {
        self::$db->update(self::$table, $this->toArray(), $this->id);
    }
    
    public function delete() {
        self::$db->delete(self::$table, $this->id);
    }
    
    static public function listUsers($conditions = array()) {
        $result = self::$db->select(self::$table, $conditions);
        
        $users = array();
        foreach ($result as $res) {
            $user = new User();
            $user->id = $res['id'];
            $user->username = $res['username'];
            $user->password = $res['password'];
            $user->first_name = $res['first_name'];
            $user->last_name = $res['last_name'];
            $user->email = $res['email'];
            $user->address = $res['address'];
            $user->phone_number = $res['phone_number'];
            $users[] = $user;
        }
        return $users;
    }
    
    static public function validateLogin($username, $password) {
        
        $results = static::listUsers(array(
            'username' => $username,
            'password' => md5($password)
        ));
        
        if(count($results) != 1) {
            return null;
        }
        
        return array_pop($results);
        
    }
}

?>
