<?php
require_once 'models/Database.php';
require_once 'models/JobModel.php';
require_once 'models/UserModel.php';

class AdminController {
    private $jobModel;
    private $userModel;
    
    public function __construct() {
        $this->jobModel = new JobModel();
        $this->userModel = new UserModel();
        
        // Vérifier les permissions
        if (!isLoggedIn()) {
            redirect('?page=login');
        }
        
        if (!isAdmin()) {
            echo "Accès non autorisé";
            exit;
        }
    }
    
    public function dashboard() {
        $title = "Tableau de bord";
        $totalJobs = $this->jobModel->countJobs();
        $totalUsers = $this->userModel->countUsers();
        
        require_once 'views/admin/dashboard.php';
    }
    
    public function manageJobs() {
        $title = "Gestion des offres";
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Ajouter ou modifier une offre
            $id = $_POST['id'] ?? 0;
            $title = $_POST['title'] ?? '';
            $description = $_POST['description'] ?? '';
            $company = $_POST['company'] ?? '';
            
            if ($id > 0) {
                $this->jobModel->updateJob($id, $title, $description, $company);
            } else {
                $this->jobModel->createJob($title, $description, $company);
            }
        }
        
        // Supprimer une offre
        if (isset($_GET['delete'])) {
            $this->jobModel->deleteJob($_GET['delete']);
        }
        
        $jobs = $this->jobModel->getAllJobs();
        require_once 'views/admin/jobs.php';
    }
    
    public function logout() {
        session_destroy();
        redirect('?page=home');
    }
}