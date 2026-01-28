<?php
require_once 'Database.php';

class JobModel {
    public function getAllJobs() {
        $sql = "SELECT * FROM jobs WHERE is_active = 1 ORDER BY created_at DESC";
        $result = Database::query($sql);
        
        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        }
        
        return [];
    }
    
    public function getFeaturedJobs() {
        $sql = "SELECT * FROM jobs WHERE is_active = 1 AND is_featured = 1 ORDER BY created_at DESC LIMIT 5";
        $result = Database::query($sql);
        
        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        }
        
        return [];
    }
    
    public function getJobById($id) {
        $sql = "SELECT * FROM jobs WHERE id = ? AND is_active = 1";
        $result = Database::query($sql, [$id]);
        
        if ($result && $result->num_rows > 0) {
            return $result->fetch_assoc();
        }
        
        return null;
    }
    
    public function createJob($title, $description, $company) {
        $sql = "INSERT INTO jobs (title, description, company, created_at) VALUES (?, ?, ?, NOW())";
        $result = Database::query($sql, [$title, $description, $company]);
        return $result !== false;
    }
    
    public function updateJob($id, $title, $description, $company) {
        $sql = "UPDATE jobs SET title = ?, description = ?, company = ? WHERE id = ?";
        $result = Database::query($sql, [$title, $description, $company, $id]);
        return $result !== false;
    }
    
    public function deleteJob($id) {
        $sql = "UPDATE jobs SET is_active = 0 WHERE id = ?";
        $result = Database::query($sql, [$id]);
        return $result !== false;
    }
    
    public function countJobs() {
        $sql = "SELECT COUNT(*) as total FROM jobs WHERE is_active = 1";
        $result = Database::query($sql);
        
        if ($result) {
            $row = $result->fetch_assoc();
            return $row['total'];
        }
        
        return 0;
    }
}