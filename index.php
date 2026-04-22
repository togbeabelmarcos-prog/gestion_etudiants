<?php
require 'config.php';

// filieres
$filieres = $pdo->query("SELECT * FROM filieres")->fetchAll(PDO::FETCH_ASSOC);

// etudiants
$etudiants = $pdo->query("
    SELECT etudiants.*, filieres.nom AS filiere_nom
    FROM etudiants
    JOIN filieres ON etudiants.filiere_id = filieres.id
")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Gestion étudiants</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<h2>Ajouter un étudiant</h2>

<form action="traitement.php" method="POST">
    <input type="text" name="nom" placeholder="Nom" required><br><br>
    <input type="text" name="prenom" placeholder="Prénom" required><br><br>

    <select name="filiere_id">
        <?php foreach ($filieres as $f): ?>
            <option value="<?= $f['id'] ?>"><?= $f['nom'] ?></option>
        <?php endforeach; ?>
    </select><br><br>

    <button type="submit">Ajouter</button>
</form>

<h2>Liste des étudiants</h2>

<table border="1" cellpadding="10">
<tr>
    <th>Nom</th>
    <th>Prénom</th>
    <th>Filière</th>
    <th>Actions</th>
</tr>

<?php foreach ($etudiants as $e): ?>
<tr>
    <td><?= $e['nom'] ?></td>
    <td><?= $e['prenom'] ?></td>
    <td><?= $e['filiere_nom'] ?></td>
    <td>
        <a href="update.php?id=<?= $e['id'] ?>">Modifier</a> |
        <a href="delete.php?id=<?= $e['id'] ?>" onclick="return confirm('Supprimer ?')">Supprimer</a>
    </td>
</tr>
<?php endforeach; ?>

</table>
<script src="assets/js/script.js"></script>
</body>
</html>