<?php
require 'config.php';

// UPDATE
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_POST['id'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $filiere_id = $_POST['filiere_id'];

    $sql = "UPDATE etudiants SET nom = ?, prenom = ?, filiere_id = ? WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nom, $prenom, $filiere_id, $id]);

    header("Location: index.php");
    exit();
}

// GET
$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM etudiants WHERE id = ?");
$stmt->execute([$id]);
$etudiant = $stmt->fetch(PDO::FETCH_ASSOC);

$filieres = $pdo->query("SELECT * FROM filieres")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Modifier</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<h2>Modifier étudiant</h2>

<form method="POST">

    <input type="hidden" name="id" value="<?= $etudiant['id'] ?>">

    <input type="text" name="nom" value="<?= $etudiant['nom'] ?>"><br><br>
    <input type="text" name="prenom" value="<?= $etudiant['prenom'] ?>"><br><br>

    <select name="filiere_id">
        <?php foreach ($filieres as $f): ?>
            <option value="<?= $f['id'] ?>" <?= $f['id'] == $etudiant['filiere_id'] ? 'selected' : '' ?>>
                <?= $f['nom'] ?>
            </option>
        <?php endforeach; ?>
    </select><br><br>

    <button type="submit">Modifier</button>

</form>
<script src="assets/js/script.js"></script>
</body>
</html>