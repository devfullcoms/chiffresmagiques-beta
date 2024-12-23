<?php
include('db_config.php'); // Connexion à la base de données

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_POST['user_id'];
    $amount = $_POST['amount'];
    $payment_method = $_POST['payment_method'];

    // Vérifiez le solde de l'utilisateur
    $query = "SELECT balance FROM users WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->bind_result($balance);
    $stmt->fetch();
    $stmt->close();

    if ($balance >= $amount) {
        // Déduisez le montant et enregistrez le retrait
        $query = "UPDATE users SET balance = balance - ? WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("di", $amount, $user_id);
        $stmt->execute();
        $stmt->close();

        $query = "INSERT INTO transactions (user_id, amount, type, method) VALUES (?, ?, 'withdraw', ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ids", $user_id, $amount, $payment_method);
        $stmt->execute();
        $stmt->close();

        echo "Retrait réussi!";
    } else {
        echo "Solde insuffisant.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Retrait</title>
</head>
<body>
    <h1>Retrait</h1>
    <form method="post">
        <label for="user_id">ID Utilisateur :</label>
        <input type="number" name="user_id" required>
        <br>
        <label for="amount">Montant :</label>
        <input type="number" name="amount" step="0.01" required>
        <br>
        <label for="payment_method">Méthode de paiement :</label>
        <select name="payment_method" required>
            <option value="paypal">PayPal</option>
            <option value="bank_transfer">Virement bancaire</option>
        </select>
        <br>
        <button type="submit">Effectuer le Retrait</button>
    </form>
</body>
</html>
