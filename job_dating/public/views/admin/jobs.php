<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des offres - <?php echo SITE_NAME; ?></title>
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
        <h2>Gestion des offres d'emploi</h2>
        
        <section class="add-job">
            <h3>Ajouter une nouvelle offre</h3>
            <form method="POST" action="?page=admin&action=jobs">
                <input type="hidden" name="id" value="0">
                
                <div class="form-group">
                    <label for="title">Titre:</label>
                    <input type="text" id="title" name="title" required>
                </div>
                
                <div class="form-group">
                    <label for="company">Entreprise:</label>
                    <input type="text" id="company" name="company" required>
                </div>
                
                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea id="description" name="description" rows="5" required></textarea>
                </div>
                
                <button type="submit" class="btn">Ajouter l'offre</button>
            </form>
        </section>
        
        <section class="jobs-list">
            <h3>Offres existantes</h3>
            
            <?php if (!empty($jobs)): ?>
                <table class="jobs-table">
                    <thead>
                        <tr>
                            <th>Titre</th>
                            <th>Entreprise</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($jobs as $job): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($job['title']); ?></td>
                            <td><?php echo htmlspecialchars($job['company']); ?></td>
                            <td><?php echo date('d/m/Y', strtotime($job['created_at'])); ?></td>
                            <td>
                                <a href="?page=admin&action=jobs&delete=<?php echo $job['id']; ?>" 
                                   class="btn btn-danger"
                                   onclick="return confirm('Supprimer cette offre?')">Supprimer</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>Aucune offre à afficher.</p>
            <?php endif; ?>
        </section>
    </main>
</body>
</html>