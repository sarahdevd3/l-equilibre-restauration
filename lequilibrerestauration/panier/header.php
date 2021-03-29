<?php
require 'db.class.php';
require 'panier.class.php';
$DB = new DB();
// j'initialise le panier en lui envoyant la connexion à la BDD
$panier = new panier($DB);

?>
<a href="panier.php"><img src="panier.png" alt="logo d'un panier" width="50px" height="50px"></a>
<a href="accueil.php">Retour à l'accueil</a>