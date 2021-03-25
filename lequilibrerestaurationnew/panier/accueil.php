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

$products = $DB->QUERY('SELECT * FROM tbl_food');
//var_dump($products);

// on va parcourir plusieurs fois avec un foreach et je met la box à l'intérieur

foreach($products as $product):?>

<div class="card" style="width: 18rem;">
  <img src="../images/food/<?=$product->image_name;?>" height="270px" class="card-img-top" alt="...">
  
    <div class="card-body">
    <h5 class="card-title"><?=$product->title; // C'est pareil que <?php echo ... ?></h5>
    <p class="card-text"><?= number_format($product->price,2); //number_format pour le nombre de chiffres après la virgule?> €</p>
    <!-- bouton qui renvoie vers addpanier.php avec l'id du produit -->
    <a href="addpanier.php?id=<?= $product->id; ?>" name="submit" class="btn btn-primary">Ajouter</a>
  </div>
</div>
<?php endForeach ?>
<?php
    if(isset($_POST['submit']))
        {
        //add in DB
        //echo"clicked";

            //1.get the data from form
            $food = $_POST['food'];
            $price = $_POST['price'];
            $qty = $_POST['qty'];
            $total = $price* $qty; //calculate total

            $order_date = date('Y-m-d h:i:s'); //current date

            $status = "Livré"; //livré, en cours, annulé

            $customer_name = $_POST['full-name'];
            $customer_contact = $_POST['contact'];
            $customer_email = $_POST['email'];
            $customer_address = $_POST['address'];

    //save the order

    $sql2 = "INSERT INTO tbl_order SET
            food ='$food',
            price = $price,
            qty = $qty,
            total= $total,
            order_date = '$order_date',
            status = '$status',
            customer_name= '$customer_name',
            customer_contact= '$customer_contact',
            customer_email= '$customer_email',
            customer_address= '$customer_address'

            ";

            //echo $sql2; die();

            $res2 = mysqli_query($conn, $sql2);

            if($res2==true)
            {
                    $_SESSION['order']= "<div class='success'> La commande à bien été envoyée.<div>";
                    header('location:'.SITEURL);
            }
            else
            {
                    
                $_SESSION['order']= "<div class='error'> La commande n'a pas été envoyée.<div>";
                header('location:'.SITEURL);
            }
}

?>
</body>
</html>