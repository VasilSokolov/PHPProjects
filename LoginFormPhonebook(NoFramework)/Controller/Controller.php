<?php
require_once __DIR__.'/../Model/User.php';

class Controller{


    /**
     *
     * @var User
     */
    protected $currentUser;
    
    public function __construct() {
        session_start();
        if (array_key_exists('user', $_SESSION)) {
            $this->currentUser = $_SESSION['user'];
        }
        
    }
    
    public function login() {
        
        if ($this->isPost()) {
            $user = User::validateLogin($_POST['username'], $_POST['password']);
            if (empty($user)) {
                $this->render('Login', array('error'=>'Invalid username or password'));
                
            }
            $_SESSION['user'] = $user;
            $this->currentUser = $user;
            
            header('Location: ?action=welcome');
            
        } else {
            $this->render('Login', array());
        }
        
    }
    
    public function logout() {
        $_SESSION['user'] = null;
        session_write_close();
        header('Location: ?action=login');
    }
    
    public function update() {
        
        if (empty($this->currentUser)) {
            echo "You need to login first!!!";
            die();
        }
        
        
        
        if ($this->isPost()) {
            $postData = $_POST;
            if ( !$this->isAdmin() && $this->currentUser->getId() != $postData['id'] ) {
                echo "You are not allowed to update other users if you are not an admin";
                die();
            }
            
            $userToUpdate = User::listUsers(array('id'=>$postData['id']));
            if (empty($userToUpdate)) {
                echo 'Invalid userid'; die();
            }
            
            $userToUpdate = array_pop($userToUpdate);
            /* @var $userToUpdate User */
            
            try {
                $userToUpdate->setAddress($postData['address']);
                $userToUpdate->setEmail($postData['email']);
                $userToUpdate->setFirstName($postData['first_name']);
                $userToUpdate->setLastName($postData['last_name']);
                if (!empty($postData['password'])) {
                    $userToUpdate->setPassword($postData['password']);
                }
                $userToUpdate->setPhoneNumber($postData['phone_number']);
                $userToUpdate->setUsername($postData['username']);
            } catch (Exception $e) {
                $this->render('Register', array('userdata'=>$userToUpdate->toArray(), 'action'=>'Update', 'error'=>$e->getMessage()));
            }
            
            $userToUpdate->updete();
            
            if ($this->currentUser->getId() == $userToUpdate->getId()) {
                $this->currentUser = $userToUpdate;
                $_SESSION['user'] = $userToUpdate;
            }
            
            $this->render('Register', array('userdata'=>$userToUpdate->toArray(), 'action'=>'Update'));
            
        } else {
            
            $this->render('Register', array('userdata'=>$this->currentUser->toArray(), 'action'=>'Update'));
            
        }
        
    }
    
    public function create() {
        
        if ($this->isPost()) {
            $postData = $_POST;
            $user = new User();
            try {
                $user->setAddress($postData['address']);
                $user->setEmail($postData['email']);
                $user->setFirstName($postData['first_name']);
                $user->setLastName($postData['last_name']);
                $user->setPassword($postData['password']);
                $user->setPhoneNumber($postData['phone_number']);
                $user->setUsername($postData['username']);
            } catch (Exception $e) {
               $this->render('Register', array('userdata'=>$postData, 'error'=>$e->getMessage()));
            }
            
            $user->insert();
            $_SESSION['user'] = $user;
            header('Location: ?action=update');
        } else {
            $this->render('Register', array());
        }
        
    }
    
    public function delete() {
        $postData = $_GET;
        if ( !$this->isAdmin() && $this->currentUser->getId() != $postData['id'] ) {
            echo "You are not allowed to delete other users if you are not an admin";
        }

        $userToDelete = User::listUsers(array('id'=>$postData['id']));
        if (empty($userToDelete)) {
            echo 'Invalid userid'; die();
        }

        $userToDelete = array_pop($userToDelete);
        /* @var $userToDelete User */
        $userToDelete->delete();
        
        header('Location: ?action=listUsers');
        
    }
    
    public function welcome() {
        if (empty($this->currentUser)) {
            echo "You need to login first!!!";
            die();
        }
        $this->render('Welcome', array('user'=>$this->currentUser));
    }
    
    public function listUsers() {
        
        if ( !$this->isAdmin() ) {
            echo "You are not allowed to list users if you are not an admin";
            die();
        }
        
        $users = User::listUsers();
        
        $this->render('List', array('users'=>$users));
        
    }
    
    protected function isPost() {
        return strtolower($_SERVER['REQUEST_METHOD']) == 'post';
    }
    
    protected function isAdmin() {
        if (empty($this->currentUser)) {
            return false;
        }
        
        return $this->currentUser->getUsername() == 'admin';
    }
    
    protected function render($tpl, $data) {
        $tplFile = __DIR__.'/../View/'.$tpl.'.php';
        if (!file_exists($tplFile)) {
            echo "Template $tpl not found";
        }
        
        include $tplFile;
        exit();
    }
    
}
?>
