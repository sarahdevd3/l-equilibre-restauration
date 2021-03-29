<?php 
require "header.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <title>Document</title>
    <style>
    body{
      display:flex;
    }
    .card{
      flex-direction:column;
    }
    </style>
</head>
<body>

<?php

// J'ai déjà initialisé un objet db qui est ramené par le header), je peux préparer ma requête comme ça: 
// J'ai créé une fonction query dans db.class.php pour faire des requêtes plus rapidement 

// var_dump($DB->query('SELECT * FROM products'));

// je lance une requête pour afficher mes produits 

$products = $DB->QUERY('SELECT * FROM products');

// on va parcourir plusieurs fois avec un foreach et je met la box à l'intérieur

foreach($products as $product):?>

<div class="card" style="width: 18rem;">
  <img src="<?=$product->id;?>.jpg" height="270px" class="card-img-top" alt="...">
    <div class="card-body">
    <h5 class="card-title"><?= $product->name; // C'est pareil que <?php echo ... ?></h5>
    <p class="card-text"><?= number_format($product->price, 2); //number_format pour le nombre de chiffres après la virgule?> €</p>
    <!-- bouton qui renvoie vers addpanier.php avec l'id du produit -->
    <a href="addpanier.php?id=<?= $product->id; ?>" class="btn btn-primary">Ajouter</a>
  </div>
</div>

<?php endForeach ?>

</body>
</html>