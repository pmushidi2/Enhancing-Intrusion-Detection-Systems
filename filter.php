<?php

    $uploaddir = 'upld';

    if (!is_dir($uploaddir)) {
        mkdir($uploaddir);
    }

    $error = false;
    $newName = bin2hex(random_bytes(32));
    $legalExtensions = array("jpg", "png", "gif");
    $legalSize = "10000000"; // 10000000 Octets = 10 MO
    $file = $_FILES["fl"];
    $actualName = $file['tmp_name'];
    $actualSize = $file['size'];
    $extension = pathinfo(basename($file['name']), PATHINFO_EXTENSION);

    if (file_exists($uploaddir.'/'.$newName.'.'.$extension)) {
        $error = true; 
    }
    if (!$error) {
        if ($actualSize < $legalSize) {
            if (in_array($extension, $legalExtensions)) {

                $uploadfile = $uploaddir.'/'.$newName.'.'.$extension;
                move_uploaded_file($actualName, $uploadfile);

                echo "<p>";
                echo "<strong>Voici votre photo de profil:</strong><br>";
                echo '<br><img src="'.$uploadfile.'" alt="image" height="200">';
                echo '<br><br><a href="index.php">Retour</a>';
                echo "</p>";
            } else {
                echo "<p>".$extension;
                echo "<strong>Fichier non autorisé</strong><br>";
                echo '<br><br><a href="index.php">Retour</a>';
                echo "</p>";
            }
        }
    }
    else {
        @unlink($path.'/'.$newName.'.'.$extension);
        
        echo "Une erreur s'est produite";
        
    }
?>
