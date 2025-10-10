<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Envoi de photo par formulaire</title>
</head>
<body>
    <form method="post" enctype="multipart/form-data">
        <input type="file" name="photo" >
        <input type="submit">
    </form>

    <?php
    if (isset($_FILES['photo'])) {
        $dossier = "uploads/";
        if (!is_dir($dossier)) {
            mkdir($dossier, 0777, true); 
        }

        
        $fichier = basename($_FILES['photo']['name']);
        $chemin = $dossier . $fichier;
        move_uploaded_file($_FILES['photo']['tmp_name'], $chemin);

        echo "<img src='$chemin';'><br>";
        echo "<a href='show_img.php?img=" . urlencode($chemin) . "'>Voir l’image sur une autre page</a>";
    }
    ?>
</body>
</html>
