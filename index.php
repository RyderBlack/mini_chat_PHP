<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Mini-chat</title>
        <link rel="stylesheet" href="style.css">
    </head>

    <body>
<h1>Mini chat for SIMPLonMARS students</h1>

    <form class="formulaire" action="data_processing.php" method="post">
        <p>
        <label for="pseudo">Pseudo</label> : <input type="text" name="pseudo" id="pseudo" class="input01" />
        <br />
        <label for="message">Message</label> :  <input type="text" name="message" id="message" class="input02"/><br />

        <button type="submit" name="button">Chattez !</button>
        </p>
    </form>

<?php

try// Connexion à la base de données

{ //ici on met dans une variable la connexion avec la BDD mysql
  //(attention a ne pas oublier le username et mdp de connexion a PHPmyadmin car c est lui qui gere la bdd)

    $bdd = new PDO('mysql:host=localhost;dbname=minichat;charset=utf8mb4', 'root', 'simplonmars');

}
catch(Exception $e) // recupere si une erreur se produit
{
        die('Erreur : '.$e->getMessage()); //affiche l erreur en question
}

// On recupere les 30 derniers messages... mais on peut aussi recuperer bcp plus
$request = $bdd->query('SELECT pseudo, message FROM minichat ORDER BY ID DESC LIMIT 0, 30');

// Recupere et affiche de chaque message (toutes les données sont protégées par htmlspecialchars)
while ($data = $request->fetch())
{
?>

<div class="container-chat"> <!-- on repasse sur du html pour mettre en forme -->

<?php
    echo '<p class="pseudo-p"><strong>' . htmlspecialchars($data['pseudo']) . '</strong> : ' . htmlspecialchars($data['message']) . '</p>';
}

$request->closeCursor(); // fin de la connexion avec la BDD

?>

</div> <!-- fin du container chat -->

    </body>
</html>
