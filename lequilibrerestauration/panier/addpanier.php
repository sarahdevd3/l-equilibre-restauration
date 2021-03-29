<?php
require "header.php";

// GET permet de récupérer tout ce qui est envoyé par l'url 
// je vérifie avec GET que l'id s'est bien envoyé

if(isset($_GET['id'])){
    // je récupère l'article qui est visé par l'id
    // Je prépare la requête pour éviter une injection dans l'url en mettant la valeur de id dans array
    $product = $DB->query('SELECT id FROM products WHERE id = :id', array('id' => $_GET['id']));
    // si le produit est vide => ce produit n'existe pas 
    if(empty($product)){
        die("Ce produit n'existe pas.");
    }
    // si ce produit existe, je l'ajoute au panier 
    // J'appelle ma fonction add définie dans panier.class.php 
    // toute la logique du code se trouve dans la class panier
    $panier->add($product[0]->id);
    // du JS pour revenir un cran en arrière dans l'historique du navigateur 
    die('Le produit a bien été ajouté à votre panier, <a href="javascript:history.back()">retourner sur le catalogue</a>');
}else{
    die("Vous n'avez pas selectionné de produit à ajouter au panier");
}

?>