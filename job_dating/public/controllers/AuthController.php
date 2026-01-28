<?php
require_once 'models/Database.php';
require_once 'models/UserModel.php';

class AuthController {
    private $userModel;
    
    public function __construct() {
        $this->userModel = new UserModel();
    }
    
    public function showLogin() {
        $title = "Connexion";
        require_once 'views/login.php';
    }
    
    public function login() {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        
        $user = $this->userModel->authenticate($email, $password);
        
        if ($user) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['is_admin'] = $user['is_admin'];
            
            redirect('?page=admin&action=dashboard');
        } else {
            $error = "Email ou mot de passe incorrect";
            require_once 'views/login.php';
        }
    }
    
    public function showRegister() {
        $title = "Inscription";
        require_once 'views/register.php';
    }
    
    public function register() {
        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $confirm_password = $_POST['confirm_password'] ?? '';
        
        // Validation simple
        if (empty($name) || empty($email) || empty($password)) {
            $error = "Tous les champs sont requis";
            require_once 'views/register.php';
            return;
        }
        
        if ($password !== $confirm_password) {
            $error = "Les mots de passe ne correspondent pas";
            require_once 'views/register.php';
            return;
        }
        
        if ($this->userModel->emailExists($email)) {
            $error = "Cet email est déjà utilisé";
            require_once 'views/register.php';
            return;
        }
        
        try {
            $success = $this->userModel->createUser($name, $email, $password);
            
            if ($success) {
                $_SESSION['success'] = "Inscription réussie. Vous pouvez vous connecter.";
                redirect('?page=login');
            } else {
                $error = "Erreur lors de l'inscription";
                require_once 'views/register.php';
            }
        } catch (Exception $e) {
            $error = "Erreur lors de l'inscription: " . $e->getMessage();
            require_once 'views/register.php';
        }
    }
    
    public function logout() {
        session_destroy();
        redirect('?page=home');
    }
}