<!DOCTYPE html>
<html lang="fr">

    <?php   //connection à la BDD
    $mysqli = new mysqli("localhost:3306", "phptest", "phptest", "labyrinthe");
    

    if ($mysqli->connect_errno) {
        printf("Échec de la connexion : %s\n", $mysqli->connect_error);
        exit();
    }

    function insertUser($mysqli, $user) {       //Creation du user
        $sql = "INSERT INTO utilisateurs (nom) VALUES ('".$user."')";
            
        if ($mysqli->query($sql) === TRUE) {
        return $user;
        } else {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
        }
    }

    function getUser($mysqli, $user) {      //recuperation du user pour l'affichage sur l'ecran
        $data = [];
        if ($result = $mysqli->query("SELECT * FROM utilisateurs WHERE nom = '".$user."'")) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row["nom"];
            }
            $result->close();
            if (count($data) === 0) {
                return NULL;
            }else {
                return $data[0];
            }
        }
    }

    $user = getUser($mysqli, $_POST["pseudo"]);
    if ( is_null($user)) {
        $user = insertUser($mysqli, $_POST["pseudo"]);
    }
    echo"<p class='user'>Bienvenue ".($user)."</p>";
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

    function findPlayer($file)    {
        $i = 0;
        foreach ($file as $line) {
            if ($key = array_search("2", $line)) {
                return [$i, $key];
            }
            $i++;
        }
    }

    function checkInputs($file) {
        if (array_key_exists('up', $_POST)) {
            up($file);
        } 
        else if (array_key_exists('down', $_POST)) {
            down($file);
        } 
        else if (array_key_exists('left', $_POST)) {
            left($file);
        } 
        else if (array_key_exists('right', $_POST)) {
            right($file);
        }
    }

    function up($file)    {
        $key = findPlayer($file);
        if ($file[$key[0] - 1][$key[1]] == "1") {
            $file[$key[0]][$key[1]] = "1";
            $file[$key[0] - 1][$key[1]] = "2";
        }
        // updateBDD($file);
    }

    function down($file)  {
        $key = findPlayer($file);
        if ($file[$key[0] + 1][$key[1]] == "4") {
            $file[$key[0]][$key[1]] = "1";
            $file[$key[0] + 1][$key[1]] = "2";
            victory($file);
        }
        // updateBDD($file);
    }

    function left($file){
        $key = findPlayer($file);
        if ($file[$key[0]][$key[1] - 1] == "1") {
            $file[$key[0]][$key[1]] = "1";
            $file[$key[0]][$key[1] - 1] = "2";
        }
        // updateBDD($file);
    }

    function right($file){
        $key = findPlayer($file);
        if ($file[$key[0]][$key[1] + 1] == "1") {
            $file[$key[0]][$key[1]] = "1";
            $file[$key[0]][$key[1] + 1] = "2";
        }
        if ($file[$key[0]][$key[1] + 1] == "1") {
            $file[$key[0]][$key[1]] = "1";
            $file[$key[0]][$key[1] + 1] = "2";
        }
        // updateBDD($file);
    }


    function victory($file) {
        echo "Victory";
    }

    checkInputs($file);
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