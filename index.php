<!DOCTYPE html>
<html lang="fr">

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
            width: 20px;
            height: 20px;
        }
    </style>
</head>

<body> 

    <?php       //Ouvrir un fichier
        $file = fopen('labyrinthe.txt', 'r+');

        $tablab = [];
        while(!feof($file))  {
            $ligne = fgets($file);
            $tablab[] = explode(" ", $ligne);
            echo $ligne . "<br />";
        }     
        fclose($file);
    ?>

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



<!-- formulaire pseudo -->   
    <form action="" method="POST"> 
        <div>
            <input type="text" name="pseudo">
            <button type="submit" name="surname">Selectionner ce pseudo</button>
        </div>
    </form>

</body> 

</html>