<?php
require_once 'models/Database.php';
require_once 'models/JobModel.php';

class FrontController {
    private $jobModel;
    
    public function __construct() {
        $this->jobModel = new JobModel();
    }
    
    public function home() {
        $title = "Accueil - Job Dating";
        $featuredJobs = $this->jobModel->getFeaturedJobs();
        
        require_once 'views/home.php';
    }
    
    public function jobs() {
        $title = "Offres d'emploi";
        $jobs = $this->jobModel->getAllJobs();
        
        require_once 'views/jobs.php';
    }
    
    public function jobDetails($id) {
        $job = $this->jobModel->getJobById($id);
        
        if (!$job) {
            echo "Offre non trouvée";
            return;
        }
        
        $title = $job['title'];
        require_once 'views/job_details.php';
    }
}