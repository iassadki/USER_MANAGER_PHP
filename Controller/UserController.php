<?php

class userController {
    private $userManager;
    private $user;
 
    public function __construct($db) {
 
        require('./Model/User.php');
        require_once('./Model/UserManager.php');
        $this->userManager = new UserManager($db);
        
        // $this->db = $db1 ;
        
    }

    public function home() {
        $page = 'home';
        require('./View/default.php');
    }

    // public function display() {
    //     $page = 'home';
    //     $user = null;
    //     $admin = false;
    //     if (isset($_SESSION['user']['email'])) {
    //         $user = $this->userManager->findByEmail($_SESSION['user']['email']);
    //         if ($user['admin'] == 1) {
    //             $admin = true;
    //         }
    //     }
    //     require('./View/default.php');
    // }

    public function login() {
        $page = 'login';
        require('./View/default.php');
    }

    public function doLogin() {
        $email = $_POST['email']; 
        $password = $_POST['password']; 

        // Le user extrait par le UserManager est renvoyé dans $result
        // A vous d'écrire les 3 lignes correspondantes
        $result = $this->userManager->login($email, $password);        
        // $result = //_____ ;

        if ( $result ) :
            $info = "Connexion reussie";
            $_SESSION['user'] = $result;
            $page = 'home';
        else :
            $info = "Identifiants incorrects.";
        endif;
        
        require('./View/default.php');
    }

    public function doLogout() {
        unset($_SESSION['user']);
        $page = 'home';
        require('./View/default.php');
    }

    public function doCreate(){
        if (isset($_POST['email']) &&
            isset($_POST['password']) &&
            isset($_POST['lastName']) &&
            isset($_POST['firstName']) &&
            isset($_POST['address']) &&
            isset($_POST['postalCode']) &&
            isset($_POST['city'])) {

        $alreadyExist = $this->userManager->findByEmail($_POST['email']); // Add this line to check if the email already exist
        
        if (!$alreadyExist) {
            $newUser = new User($_POST);
            $this->userManager->create($newUser); // 
            $page = 'login';
        } else {
            $error = "ERROR : This email (" . $_POST['email'] . ") is used by another user";
            $page = 'createAccount';
        }
        }
        require('./View/default.php');
    }

    public function create() {
        $page = 'createAccount';
        require('./View/default.php');
    }

    // fonction unauthorized
    public function unauthorized() {
        $page = 'unauthorized';
        require('./View/default.php');
    }

}