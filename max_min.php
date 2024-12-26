<?php
 
$conn = new PDO("mysql:host=localhost;dbname=mediatheque", "root", "");

 
$stmtMax = $conn->query("
    SELECT Section.Libelle_Section, COUNT(Emprunt.Num_Emprunt) AS Total_Emprunts
    FROM Section
    LEFT JOIN Stagiaire ON Section.Code_Section = Stagiaire.Code_Section
    LEFT JOIN Emprunt ON Stagiaire.Num_Stag = Emprunt.Num_Stag
    GROUP BY Section.Libelle_Section
    ORDER BY Total_Emprunts DESC
    LIMIT 1
");
$maxSection = $stmtMax->fetch(PDO::FETCH_ASSOC);

// Requête pour le minimum des emprunts
$stmtMin = $conn->query("
    SELECT Section.Libelle_Section, COUNT(Emprunt.Num_Emprunt) AS Total_Emprunts
    FROM Section
    LEFT JOIN Stagiaire ON Section.Code_Section = Stagiaire.Code_Section
    LEFT JOIN Emprunt ON Stagiaire.Num_Stag = Emprunt.Num_Stag
    GROUP BY Section.Libelle_Section
    ORDER BY Total_Emprunts ASC
    LIMIT 1
");
$minSection = $stmtMin->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sections avec max/min emprunts</title>
</head>
<body>
    <h2>Section avec le maximum d'emprunts</h2>
    <p><?= $maxSection['Libelle_Section'] ?> : <?= $maxSection['Total_Emprunts'] ?> emprunts</p>

    <h2>Section avec le minimum d'emprunts</h2>
    <p><?= $minSection['Libelle_Section'] ?> : <?= $minSection['Total_Emprunts'] ?> emprunts</p>
</body>
</html>
