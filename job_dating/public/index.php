<?php
// Démarrer la session
session_start();

// Charger la configuration
require_once 'config.php';

// Routeur simple
$page = $_GET['page'] ?? 'home';
$action = $_GET['action'] ?? 'index';

// Routes principales
switch($page) {
    case 'home':
        require_once 'controllers/FrontController.php';
        $controller = new FrontController();
        $controller->home();
        break;
        
    case 'jobs':
        require_once 'controllers/FrontController.php';
        $controller = new FrontController();
        if ($action == 'details') {
            $controller->jobDetails($_GET['id'] ?? 0);
        } else {
            $controller->jobs();
        }
        break;
        
    case 'login':
        require_once 'controllers/AuthController.php';
        $controller = new AuthController();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->login();
        } else {
            $controller->showLogin();
        }
        break;
        
    case 'register':
        require_once 'controllers/AuthController.php';
        $controller = new AuthController();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->register();
        } else {
            $controller->showRegister();
        }
        break;
        
    case 'admin':
        require_once 'controllers/AdminController.php';
        $controller = new AdminController();
        
        // Vérifier si l'utilisateur est connecté
        if (!isset($_SESSION['user_id'])) {
            header('Location: ?page=login');
            exit;
        }
        
        switch($action) {
            case 'dashboard':
                $controller->dashboard();
                break;
            case 'jobs':
                $controller->manageJobs();
                break;
            case 'logout':
                $controller->logout();
                break;
            default:
                $controller->dashboard();
        }
        break;
        
    default:
        http_response_code(404);
        echo "Page non trouvée";
}