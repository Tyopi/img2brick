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
	<a href="get_img.php">changer l'image</a><br>
	<a href="connecte.php">validez l'image</a><br>
    <form method="post" enctype="multipart/form-data">
        <input type="submit" name="lancer">
    </form>
    <?php
    if (isset($_POST['lancer'])) {
    	$sql = "INSERT INTO matheo.test_connexion (test) VALUES (:id_uti)";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([
 	   ':id_uti' => 1
	]);
    	echo "Insertion reussie !";
    	echo $pdo->query("SELECT current_database();")->fetchColumn();

    	if ($stmt) {
        	echo "oui";
    	} else {
        	echo "non";
        	print_r($stmt->errorInfo());
    	}
    }
?>
</html>

