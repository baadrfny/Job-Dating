-- Créer la base de données
CREATE DATABASE IF NOT EXISTS job_dating CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE job_dating;

-- Table des utilisateurs
CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    is_admin BOOLEAN DEFAULT FALSE,
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Table des offres d'emploi
CREATE TABLE jobs (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(200) NOT NULL,
    description TEXT NOT NULL,
    company VARCHAR(100) NOT NULL,
    is_featured BOOLEAN DEFAULT FALSE,
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Insérer un administrateur par défaut
INSERT INTO users (name, email, password, is_admin) 
VALUES ('Admin', 'admin@jobdating.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', TRUE);

-- Insérer des offres d'emploi exemple
INSERT INTO jobs (title, description, company, is_featured) VALUES
('Développeur PHP', 'Nous recherchons un développeur PHP expérimenté pour rejoindre notre équipe.', 'TechCorp', TRUE),
('Designer UX/UI', 'Création d''interfaces utilisateur pour nos applications mobiles.', 'DesignStudio', TRUE),
('Chef de projet', 'Gestion de projets digitaux pour nos clients internationaux.', 'ProjetPlus', FALSE);