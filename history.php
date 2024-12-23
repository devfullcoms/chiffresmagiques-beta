<?php
include('db_config.php'); // Connexion à la base de données

$user_id = 1; // Remplacez par l'ID utilisateur dynamique
$query = "SELECT amount, type, method, created_at FROM transactions WHERE user_id = ? ORDER BY created_at DESC";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Historique des Transactions</title>
</head>
<body>
    <h1>Historique des Transactions</h1>
    <table border="1">
        <tr>
            <th>Montant</th>
            <th>Type</th>
            <th>Méthode</th>
            <th>Date</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['amount'] ?></td>
                <td><?= $row['type'] ?></td>
                <td><?= $row['method'] ?></td>
                <td><?= $row['created_at'] ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
