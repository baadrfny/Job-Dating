<?php
class Database {
    private static $connection = null;
    
    public static function getConnection() {
        if (self::$connection === null) {
            try {
                self::$connection = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
                
                if (self::$connection->connect_error) {
                    die("Erreur de connexion: " . self::$connection->connect_error);
                }
                
                self::$connection->set_charset("utf8mb4");
            } catch (Exception $e) {
                die("Erreur de base de données: " . $e->getMessage());
            }
        }
        
        return self::$connection;
    }
    
    public static function query($sql, $params = []) {
        $conn = self::getConnection();
        $stmt = $conn->prepare($sql);
        
        if (!$stmt) {
            throw new Exception("Erreur de préparation de requête: " . $conn->error);
        }
        
        if (!empty($params)) {
            $types = '';
            $values = [];
            
            foreach ($params as $param) {
                if (is_int($param)) {
                    $types .= 'i';
                } elseif (is_float($param)) {
                    $types .= 'd';
                } elseif (is_string($param)) {
                    $types .= 's';
                } else {
                    $types .= 'b';
                }
                $values[] = $param;
            }
            
            if (!$stmt->bind_param($types, ...$values)) {
                throw new Exception("Erreur de liaison des paramètres: " . $stmt->error);
            }
        }
        
        if (!$stmt->execute()) {
            throw new Exception("Erreur d'exécution de requête: " . $stmt->error);
        }
        
        return $stmt->get_result();
    }
    
    public static function escape($string) {
        $conn = self::getConnection();
        return $conn->real_escape_string($string);
    }
}