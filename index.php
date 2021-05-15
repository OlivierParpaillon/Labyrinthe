<!DOCTYPE html>
<html lang="fr">

<?php       //connection a la BDD
$mysqli = new mysqli("localhost:3306", "phptest", "phptest", "labyrinthe");

if ($mysqli->connect_errno) {
    printf("Échec de la connexion : %s\n", $mysqli->connect_error);
    exit();
}
?>


<head>
    <title>Jeu du labyrinthe</title>
    <meta charset="utf-8">

    <style>
       body{
           background-image: url(ressources/lab.jpg);
       } 

       .form{
            margin: 0 auto;
            padding: 150px;
            width: 280px;
            text-align: center;
            text-justify: inter-word;
       }

    </style>

</head>

<body>

<div class="form">
    <h1>Bienvenue dans le jeu du labyrinthe !</h1>
    <h3>Pour commencer, veuillez choisir un surnom :</h3>

    <!-- formulaire pseudo -->   
    <form action="game.php" method="post"> 
        <div>
            <input type="text" name="pseudo">
            <button type="submit" name="nickname">Selectionner ce surnom</button>
        </div>
    </form>

</div>

</body>
</html>