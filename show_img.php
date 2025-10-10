<?php
require_once 'connexion.inc.php';
if (isset($_GET['img']) && file_exists($_GET['img'])) {
    $image = $_GET['img'];

} else {
    die("Image introuvable !");
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Affichage image</title>
</head>
<body>
    <h1>Voici ton image :</h1>
    <img src="<?php echo htmlspecialchars($image); ?>"><br>    
    <a href="get_img.php">changer l'image<br>
    <a href="connecte.php">validez l'image
    <form method="post" enctype="multipart/form-data">
        <input type="submit" name="lancer">
    </form>
    <?php
    if (isset($_POST['lancer'])) {
        $sql = "INSERT INTO img (lien, id_uti) VALUES (:lien, :id_uti)";
    $stmt = $pdo->prepare($sql);


    $stmt->execute([
        ':lien' => $image,
        ':id_uti' => 1
    ]);
    }
?>
</html>
if ($largeur < 512 && $hauteur < 512){
  				echo "image trop petit (minimum 512pixel par 512 pixel)";
  			}else{|| $hauteur < 10
