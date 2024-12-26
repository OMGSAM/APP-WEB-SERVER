<?php
// Connexion à la base de données
$conn = new PDO("mysql:host=localhost;dbname=mediatheque", "root", "");

// Récupérer la section choisie par l'utilisateur
$code_section = $_GET['code_section'] ?? '';

if ($code_section) {
    // Requête SQL
    $stmt = $conn->prepare("
        SELECT Nom_Stag, Prenom_Stag, Date_Naissance
        FROM Stagiaire
        WHERE Code_Section = :code_section
    ");
    $stmt->bindParam(':code_section', $code_section);
    $stmt->execute();

    $stagiaires = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Liste des Stagiaires</title>
</head>
<body>
    <form method="GET">
        <label for="code_section">Choisir une section :</label>
        <input type="text" name="code_section" id="code_section">
        <button type="submit">Afficher</button>
    </form>

    <?php if (!empty($stagiaires)): ?>
        <h2>Liste des Stagiaires</h2>
        <ul>
            <?php foreach ($stagiaires as $stagiaire): ?>
                <li>
                    <?= $stagiaire['Nom_Stag'] ?> <?= $stagiaire['Prenom_Stag'] ?> (<?= $stagiaire['Date_Naissance'] ?>)
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</body>
</html>
