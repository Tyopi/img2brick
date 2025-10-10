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
    /*-------------------------parametre-----------------------------*/
    
    $lenght = 2000000;
    $autorize = array('image/jpeg','image/jpg','image/png','image/webp');
    $largeur_accepter = 112; 
    $hauteur_accepter = 112;
    
    /*---------------------------------------------------------------*/
    
    
    
    
    
    
    
    if (isset($_FILES['photo'])) {
        $dossier = "uploads/";
        if (!is_dir($dossier)) {
            mkdir($dossier, 0777, true); 
        }
        
	$infos_image = @getImageSize($_FILES['photo']['tmp_name']);
	$largeur = $infos_image[0]; 
   	$hauteur = $infos_image[1];
	
	if (!in_array($_FILES['photo']['type'], $autorize)){
		echo "image non conforme (.jpg, .jpeg, .png, .webp)";
	}else{
		if ($_FILES['photo']['size'] >= $lenght){
			echo "image trop lourde (maximum 2 MO)";
		}else{
		
		
			if ($largeur < $largeur_accepter || $hauteur < $hauteur_accepter){
  				echo "image trop petit (minimum 112 pixel par 112 pixel)";
  			}else{
	
        			$fichier = $_FILES['photo']['name'];
        			$chemin = $dossier . $fichier;
        			move_uploaded_file($_FILES['photo']['tmp_name'], $chemin);
        			echo "<img src='$chemin';'><br>";
	
        			if (isset($chemin) && file_exists($chemin)) {
    					echo "<a href='show_img.php?img=" . urlencode($chemin) . "'>Voir l’image sur une autre page</a>";
				} else {
    					echo "image invalide";
    				}
    			}
    		}
     	}   
    }
    ?>
</body>
</html>
