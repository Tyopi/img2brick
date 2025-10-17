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
	<?php echo "<a href='connecte.php?img=" . urlencode($_GET['img']) . "'>validez l'image</a><br>"; ?>
    <form method="post" enctype="multipart/form-data">
        <input type="submit" name="lancer">
    </form>
	
    <?php
	$image_blob = addslashes(file_get_contents($image));
    if (isset($_POST['lancer'])) {
		$sql = "SELECT * FROM get2brick WHERE image = :image_blob";
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(':image_blob', $image_blob, PDO::PARAM_LOB);
		$stmt->execute();

		if ($stmt->num_rows > 0) {
			echo "resultat trouver";
		} else {
			echo "aucun résultat";
		}
    	$sql = "INSERT INTO get2brick.img (image) VALUES (:id_uti)";
		$stmt = $pdo->prepare($sql);
		$stmt->execute([
		':id_uti' => $image_blob
		]);	
		$lastId = $pdo->lastInsertId();
		echo "Image insérée avec id_img = " . $lastId . "<br>";
    }	
	?>

</html>

