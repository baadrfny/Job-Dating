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
        <section class="hero">
            <h2>Trouvez votre job idéal</h2>
            <p>Des centaines d'offres d'emploi dans votre région</p>
        </section>
        
        <section class="featured-jobs">
            <h3>Offres à la une</h3>
            <div class="jobs-grid">
                <?php if (!empty($featuredJobs)): ?>
                    <?php foreach ($featuredJobs as $job): ?>
                    <div class="job-card">
                        <h4><?php echo htmlspecialchars($job['title']); ?></h4>
                        <p class="company"><?php echo htmlspecialchars($job['company']); ?></p>
                        <p><?php echo substr(htmlspecialchars($job['description']), 0, 100); ?>...</p>
                        <a href="?page=jobs&action=details&id=<?php echo $job['id']; ?>" class="btn">Voir l'offre</a>
                    </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>Aucune offre disponible pour le moment.</p>
                <?php endif; ?>
            </div>
        </section>
    </main>
    
    <footer>
        <p>&copy; <?php echo date('Y'); ?> <?php echo SITE_NAME; ?>. Tous droits réservés.</p>
    </footer>
</body>
</html>