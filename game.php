<?php   //affichage du pseudo en session
    session_start();
    if (isset($_POST['pseudo'])) {
        $_SESSION['pseudo']=$_POST['pseudo'];
    }
?>

<!DOCTYPE html>
<html lang="fr">

    <?php   
    
    //Ancienne fonction pour afficher le pseudo depuis la BDD
    
    //connection à la BDD
    // $mysqli = new mysqli("localhost:3306", "phptest", "phptest", "labyrinthe");
    

    // if ($mysqli->connect_errno) {
    //     printf("Échec de la connexion : %s\n", $mysqli->connect_error);
    //     exit();
    // }

    // function insertUser($mysqli, $user) {       //Creation du user
    //     $sql = "INSERT INTO utilisateurs (nom) VALUES ('".$user."')";
            
    //     if ($mysqli->query($sql) === TRUE) {
    //     return $user;
    //     } else {
    //     echo "Error: " . $sql . "<br>" . $mysqli->error;
    //     }
    // }

    // function getUser($mysqli, $user) {      //recuperation du user pour l'affichage sur l'ecran
    //     $data = [];
    //     if ($result = $mysqli->query("SELECT * FROM utilisateurs WHERE nom = '".$user."'")) {
    //         while ($row = $result->fetch_assoc()) {
    //             $data[] = $row["nom"];
    //         }
    //         $result->close();
    //         if (count($data) === 0) {
    //             return NULL;
    //         }else {
    //             return $data[0];
    //         }
    //     }
    // }

    // $user = getUser($mysqli, $_POST["pseudo"]);
    // if ( is_null($user)) {
    //     $user = insertUser($mysqli, $_POST["pseudo"]);
    // }
    
    echo"<p class='user'>Bienvenue ".($_SESSION['pseudo'])."</p>";
    ?>

<head>
    <title>Jeu du labyrinthe</title>
    <meta charset="utf-8">
    <link href="styles.css" rel="stylesheet" type="text/css" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
</head>

<body> 

    <?php       //Ouvrir et lire le fichier labyrinthe
        $file = fopen('ressources/labyrinthe.txt', 'r+');

        $tablab = [];
        while(!feof($file))  {
            $ligne = fgets($file);
            $tablab[] = explode(" ", $ligne);
            //echo $ligne . "<br />";
        }     
        fclose($file);
    ?>
    <div class="centre">
    <table> <!-- afficher le fichier labyrinthe -->
        <?php foreach( $tablab as $ligne) :?>
            <tr>
                <?php foreach( $ligne as $case) :?>
                    <?php if($case == 0) :?>
                        <td class="mur">
                    <?php endif; ?>
                    <?php if ($case == 1) :?>
                        <td class="chemin">
                    <?php endif; ?>
                    <?php if ($case == 2) :?>
                        <td class="player">
                    <?php endif; ?>
                    <?php if ($case == 3) :?>
                        <td class="start">
                    <?php endif; ?>
                    <?php if ($case == 4) :?>
                        <td class="end">
                    <?php endif; ?>
                    </td>
                <?php endforeach; ?>
            </tr>
        <?php endforeach; ?>    
    </table>
    </div>

    <!-- Affichage bouton haut/bas/gauche/droite -->   
    <form method="post">
        <div class="placement"> <button type="submit" name="up"><img src="ressources/Ufleche.jpg"></button></div>
        <button type="submit" name="left"><img src="ressources/Lfleche.jpg"></button>
        <button type="submit" name="down"><img src ="ressources/Dfleche.jpg"></button>
        <button type="submit" name="right"><img src="ressources/Rfleche.jpg"></button>
    </form>

    <?php
        if (!empty($_POST)) {
            if (isset($_POST["up"])) {
                echo '<p class="btn_up"> Deplacement vers le haut </p>';
            }
            if (isset($_POST["left"])) {
                echo '<p class="btn_left"> Deplacement vers la gauche </p>';
            }
            if (isset($_POST["right"])) {
                echo '<p class="btn_right"> Deplacement vers droite </p>';
            }
            elseif (isset($_POST["down"])) {
                echo '<p class="btn_down"> Deplacement vers le bas </p>';
            } 
        }
    ?>

    <!-- syteme restart -->
    <div class="restart">
        <button type="submit"><a href="index.php">Recommencer</a></button>
    </div>
    
    <!-- formulaire pseudo    -->
    <form class="rename"action="game.php" method="post"> 
            <input type="text" name="pseudo">
            <button type="submit" name="nickname">Changer de surnom</button>
    </form>

</body> 

</html>