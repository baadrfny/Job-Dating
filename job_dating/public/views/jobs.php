<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITE_NAME . ' - ' . $title; ?></title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <header>
        <nav>
            <h1><a href="?page=home"><?php echo SITE_NAME; ?></a></h1>
            <ul>
                <li><a href="?page=home">Accueil</a></li>
                <li><a href="?page=jobs">Offres</a></li>
                <?php if (isLoggedIn()): ?>
                    <li><a href="?page=admin">Tableau de bord</a></li>
                    <li><a href="?page=admin&action=logout">Déconnexion</a></li>
                <?php else: ?>
                    <li><a href="?page=login">Connexion</a></li>
                    <li><a href="?page=register">Inscription</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
    
    <main>
        <h2>Toutes les offres d'emploi</h2>
        
        <div class="jobs-list">
            <?php if (!empty($jobs)): ?>
                <?php foreach ($jobs as $job): ?>
                <div class="job-item">
                    <h3><?php echo htmlspecialchars($job['title']); ?></h3>
                    <p class="company"><?php echo htmlspecialchars($job['company']); ?></p>
                    <p class="description"><?php echo htmlspecialchars($job['description']); ?></p>
                    <p class="date">Publié le: <?php echo date('d/m/Y', strtotime($job['created_at'])); ?></p>
                    <a href="?page=jobs&action=details&id=<?php echo $job['id']; ?>" class="btn">Postuler</a>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Aucune offre d'emploi disponible pour le moment.</p>
            <?php endif; ?>
        </div>
    </main>
</body>
</html>