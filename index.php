
<?php
// Connexion à la base de données
$conn = new mysqli("localhost", "root", "", "magic_game_db");
if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}

// Initialisation des variables
session_start();
$magicNumber = rand(1, 100);
$_SESSION['magic_number'] = $magicNumber;

// Traitement de la mise et de la devinette
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $bet = (float)$_POST['bet'];
    $guess = (int)$_POST['guess'];
    $user_id = 1; // Simulé

    if ($bet > 0 && $guess >= 1 && $guess <= 100) {
        $winAmount = abs($magicNumber - $guess) <= 5 ? $bet * 2 : 0;
        $resultMessage = $winAmount > 0 ? "Félicitations ! Vous avez gagné $winAmount € !" : "Dommage ! Le chiffre magique était $magicNumber.";
    } else {
        $resultMessage = "Veuillez entrer une mise valide et un chiffre entre 1 et 100.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Jeu de Chiffres Magiques</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<div class="game-container">
    <h1>Jeu de Chiffres Magiques</h1>
    <?php if (!empty($resultMessage)) : ?>
        <p class="result-message"><?= htmlspecialchars($resultMessage) ?></p>
    <?php endif; ?>
    <form method="POST">
        <label for="bet">Mise (€) :</label>
        <input type="number" name="bet" min="1" required>
        <label for="guess">Votre devinette :</label>
        <input type="number" name="guess" min="1" max="100" required>
        <button type="submit">Valider</button>
    </form>
</div>
</body>
</html>
