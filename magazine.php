<?php
 
$conn = new PDO("mysql:host=localhost;dbname=mediatheque", "root", "");

 
$stmt = $conn->query("
    SELECT Titre_Magazine, Date_Edition
    FROM Magazine
    WHERE Code_Magazine NOT IN (SELECT Code_Magazine FROM Emprunt)
");

$magazines = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Magazines non empruntés</title>
</head>
<body>
    <h2>Magazines jamais empruntés</h2>
    <ul>
        <?php foreach ($magazines as $magazine): ?>
            <li>
                <?= $magazine['Titre_Magazine'] ?> (Publié le <?= $magazine['Date_Edition'] ?>)
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
