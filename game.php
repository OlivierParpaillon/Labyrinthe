<!DOCTYPE html>
<html lang="fr">

<?php   //connection à la BDD
$mysqli = new mysqli("localhost:3306", "phptest", "phptest", "labyrinthe");

if ($mysqli->connect_errno) {
    printf("Échec de la connexion : %s\n", $mysqli->connect_error);
    exit();
}

$mysqli -> query("USE labyrinte");
function insertUser($mysqli, $user) {       //Creation du user
    $sql = "INSERT INTO utilisateurs (nom) VALUES ('".$user."')";
        
    if ($mysqli->query($sql) === TRUE) {
    return $user;
    } else {
    echo "Error: " . $sql . "<br>" . $mysqli->error;
    }
}

function getUser($mysqli, $user) {      //affichage du user sur l'ecran
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

$user = getUser($mysqli, $_POST['pseudo']);

if ( is_null($user)) {
    $user = insertUser($mysqli, $_POST["pseudo"]);
}
echo($user);
?>

<head>
    <title>Jeu du labyrinthe</title>
    <meta charset="utf-8">
    <style>
        .mur {
            background-color: black;
        }

        .chemin {
            background-color: antiquewhite;
        }

        td {
            width: 30px;
            height: 30px;

        }

        .centre {
            margin-left: 40em;
            margin-top: 12em;
        }
    </style>
</head>

<body> 

    <?php       //Ouvrir un fichier
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
    <table> <!-- lire un fichier -->
        <?php foreach( $tablab as $ligne) :?>
            <tr>
                <?php foreach( $ligne as $case) :?>
                    <?php if($case == 0) :?>
                        <td class="mur">
                    <?php endif; ?>
                    <?php if ($case == 1) :?>
                        <td class="chemin">
                    <?php endif; ?>
                    </td>
                <?php endforeach; ?>
            </tr>
        <?php endforeach; ?>    
    </table>
    </div>
</body> 

</html>