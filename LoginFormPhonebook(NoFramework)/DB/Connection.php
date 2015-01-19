<?php

class Connection {

    protected $username;
    protected $password;
    protected $db;
    protected $host;
    protected $port;
    protected $link;


    public function __construct($username, $password, $host, $port, $db ) {
        $this->username = $username;
        $this->password = $password;
        $this->host = $host;
        $this->port = $port;
        $this->db = $db;
    }
    
    protected function connect() {        
        if ($this->link === null) {
            $this->link = mysqli_connect($this->host, $this->username, $this->password, $this->db, $this->port);
            if (empty($this->link)) {
                die(mysqli_error());
            }
            mysqli_set_charset($this->link, 'utf8');
        }
        return $this->link;
        
    }
    
    public function query($query) {
        $result = mysqli_query($this->connect(), $query);
        if (empty($result)) {
             die(mysqli_error($this->connect()));
        }
        return $result;
    }
    
    public function select($table, $conditions =array()) {
        
        $query = "SELECT * FROM `$table` ";
        
        if (!empty($conditions)) {
            $query.="WHERE ";
        }
        
        $whereConditions = array();
        foreach ($conditions as $field=>$value) {
            $field = mysqli_real_escape_string($this->connect(), $field);
            $value = mysqli_real_escape_string($this->connect(), $value);
            $whereConditions[] = "`$field` = '$value'";
        }
        $query.=implode(' AND ', $whereConditions);
        
        $result = $this->query($query);
        
        $results = array();
        
        while ($row = mysqli_fetch_assoc($result)) {
            $results[] = $row;
        }
        
        return $results;
        
    }
    
    public function insert($table, $data) {
        
        $query = "INSERT INTO `$table`";
        
        $fields = array();
        $values = array();
        
        foreach ($data as $field => $value) {
            $fields[] = "`".mysqli_real_escape_string($this->connect(), $field)."`";
            $values[] = "'".mysqli_real_escape_string($this->connect(), $value)."'";
        }
        
        $query.="(".implode(',', $fields).") VALUES(".implode(',', $values).")";
        
        return $this->query($query);
        
        
    }
    
    public function getLastId() {
        return mysqli_insert_id($this->connect());
    }


    public function update($table, $data, $id) {
        $query = "UPDATE `$table` SET ";
        
        if (array_key_exists('id', $data)) {
            unset($data['id']);   
        }
        
        $sets = array();
        foreach ($data as $field => $value) {
            $sets[] = "`".mysqli_real_escape_string($this->connect(), $field)."` = "."'".mysqli_real_escape_string($this->connect(), $value)."'";
        }
        $query.=implode(',', $sets)."WHERE `id` = '".  mysqli_real_escape_string($this->connect(), $id)."'";
        return $this->query($query);
        
    }
    
    public function delete($table, $id) {
        
        $query = "DELETE FROM `$table` WHERE `id` = '".mysqli_real_escape_string($this->connect(), $id)."'";
        return $this->query($query);
        
    }
}
?>

