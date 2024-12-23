<?php
include('db_config.php'); // Connexion à la base de données

$user_id = 1; // Remplacez par l'ID utilisateur dynamique
$query = "SELECT vip_status, vip_level FROM users WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($vip_status, $vip_level);
$stmt->fetch();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Page VIP</title>
</head>
<body>
    <h1>Bienvenue dans le Club VIP</h1>
    <?php if ($vip_status): ?>
        <p>Niveau VIP actuel : <?= $vip_level ?></p>
        <ul>
            <li>Bonus de dépôt exclusif</li>
            <li>Assistance prioritaire</li>
            <li>Accès à des jeux réservés</li>
            <li>Retraits accélérés</li>
        </ul>
    <?php else: ?>
        <p>Devenez VIP pour débloquer des avantages exclusifs !</p>
    <?php endif; ?>
</body>
</html>
