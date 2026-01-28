<?php
require_once 'Database.php';

class UserModel {
    public function authenticate($email, $password) {
        $sql = "SELECT * FROM users WHERE email = ? AND is_active = 1";
        $result = Database::query($sql, [$email]);
        
        if ($result && $result->num_rows > 0) {
            $user = $result->fetch_assoc();
            
            // Vérifier le mot de passe
            if (password_verify($password, $user['password'])) {
                return $user;
            }
        }
        
        return null;
    }
    
    public function createUser($name, $email, $password) {
        // Vérifier si l'email existe déjà
        if ($this->emailExists($email)) {
            return false;
        }
        
        // Hasher le mot de passe
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        
        $sql = "INSERT INTO users (name, email, password, created_at) VALUES (?, ?, ?, NOW())";
        $result = Database::query($sql, [$name, $email, $hashedPassword]);
        
        return $result !== false;
    }
    
    public function emailExists($email) {
        $sql = "SELECT id FROM users WHERE email = ?";
        $result = Database::query($sql, [$email]);
        
        return $result && $result->num_rows > 0;
    }
    
    public function countUsers() {
        $sql = "SELECT COUNT(*) as total FROM users WHERE is_active = 1";
        $result = Database::query($sql);
        
        if ($result) {
            $row = $result->fetch_assoc();
            return $row['total'];
        }
        
        return 0;
    }
}