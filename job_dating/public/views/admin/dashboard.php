<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - <?php echo SITE_NAME; ?></title>
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>
<body>
    <header>
        <nav>
            <h1><a href="?page=home"><?php echo SITE_NAME; ?> Admin</a></h1>
            <ul>
                <li><a href="?page=home">Site public</a></li>
                <li><a href="?page=admin">Tableau de bord</a></li>
                <li><a href="?page=admin&action=jobs">Gérer les offres</a></li>
                <li><a href="?page=admin&action=logout">Déconnexion</a></li>
            </ul>
        </nav>
    </header>
    
    <main class="admin-container">
        <h2>Tableau de bord administrateur</h2>
        
        <div class="stats">
            <div class="stat-card">
                <h3>Offres d'emploi</h3>
                <p class="stat-number"><?php echo $totalJobs; ?></p>
            </div>
            
            <div class="stat-card">
                <h3>Utilisateurs</h3>
                <p class="stat-number"><?php echo $totalUsers; ?></p>
            </div>
        </div>
        
        <div class="admin-actions">
            <a href="?page=admin&action=jobs" class="btn">Gérer les offres</a>
            <a href="?page=home" class="btn">Voir le site</a>
        </div>
    </main>
</body>
</html>