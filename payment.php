<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Paiement</title>
</head>
<body>
    <h1>Paiement</h1>
    <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
        <input type="hidden" name="cmd" value="_xclick">
        <input type="hidden" name="business" value="votre_email_paypal@example.com">
        <input type="hidden" name="item_name" value="Dépôt de fonds">
        <label for="amount">Montant :</label>
        <input type="number" name="amount" step="0.01" required>
        <input type="hidden" name="currency_code" value="EUR">
        <br>
        <button type="submit">Effectuer le Paiement</button>
    </form>
</body>
</html>
