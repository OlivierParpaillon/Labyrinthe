<!DOCTYPE html>
<html lang="fr">

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
       }

    </style>

</head>

<body>

<div class="form">
    <h1>Bienvenue dans le jeu du labyrinthe !</h1>
    <h3>Pour commencer, veuillez choisir un pseudo :</h3>

    <!-- formulaire pseudo -->   
    <form action="game.php" method="POST"> 
        <div>
            <input type="text" name="pseudo">
            <button type="submit" name="surname">Selectionner ce pseudo</button>
        </div>
    </form>
</div>
</body>