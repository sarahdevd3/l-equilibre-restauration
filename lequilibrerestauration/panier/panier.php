<?php require 'header.php' ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <style>
    
    </style>
</head>
<body>
    
<div class="checkout">
    <div class="title">
        <div class="wrap">
        <h2 class='first'>Ma commande</h2>
        <a href="#" class="proceed">
        Proceed to checkout
        </a>
        </div>
    </div>
    <div class="table">
        <div class="wrap">

        <div class="rowtitle">
            <table class="table">
            <thead>
            <tr>
            <th scope="col"><span></span></th>
            <th scope="col"><span class="name">Plat</span></th>
            <th scope="col"><span class="price">Prix</span></th>
            <th scope="col"><span class="quantity">Quantité</span></th>
            <th scope="col"><span class="subtotal">Sous-total</span></th>
            <th scope="col"><span class="action">Actions</span></th>
            </tr>
            </thead>
        </div>

        <?php // il nous faut une requête pour afficher les produits du panier
        // Je récupère les clés du tableau où sont stockés les produits selectionnés 
        // je fais un implode par une virgule de mes id 

        $ids = array_keys($_SESSION['panier']);
        // si le tableau des id est vide, le tableau envoyé ailleurs est vide sinon continue la requête
        if(empty($ids)){
            $products = array();
        } else{
        $products = $DB->query('SELECT * FROM products WHERE id IN ('.implode(',',$ids).')');
        }
        // boucle foreach 
        foreach($products as $product):
        ?>

        <div class="row">
        <tbody>
        <tr>
        
            <td><a href="#" class='img'><img src="<?= $product->id; ?>.jpg" height='50px' width='50px'></a></td>
            <td><span class="name"><?= $product->name; ?></span></td>
            <td><span class="price"><?= number_format($product->price, 2); ?> €</span></td>
            <td><span class="quantity"><?= $_SESSION['panier'][$product->id] ?></span></td>
            <td><span class="subtotal"><?= number_format($product->price * $_SESSION['panier'][$product->id], 2); ?> €</span></td>
            <!-- Pour la suppression, on fait passer la variable del par l'url avec l'id récupéré du produit -->
            <td><span class="action"><a href="panier.php?delPanier=<?= $product->id; ?>" class="del"><img src="trash.png" height='30px' width='30px'></a></td>
            </span>
            </tr>
            
        </div>

        <?php endForeach; ?>
        <tr>
        <td>Frais de livraison</td>
        <td>3.50 €</td>
        </tr>
        </tbody>
        </table>

        </div> <!-- bizarre cette fin div ?? -->
        <div class="rowtotal">
            Total:<span class="total"><?= $panier->total() + 3.5 ?>€</span>
            Nombre d'articles:<span class="nbre_products"><?= $panier->count(); ?></span>
        </div>
    </div>
</div>

<!-- form qui réucpère les infos  -->
<form method='POST'>
<?php $i = 0; ?>
<?php foreach($products as $product): ?>
<input type="text" hidden name="food<?= $i; ?>" value="<?= $product->name; ?>">
<input type="text" hidden name="price<?= $i; ?>" value="<?= $product->price; ?>">
<input type="text" hidden name="qty<?= $i; ?>" value="<?= $_SESSION['panier'][$product->id]; ?>">
<input type="text" hidden name="total<?= $i; ?>" value="<?= $panier->total() + 3.5; ?>">
<input type="text" hidden name="order_date<?= $i; ?>" value="<?= date('Y-m-d h:i:s'); ?>">
<input type="text" hidden name="status<?= $i; ?>" value="en cours">
<?php $i++; ?>
<?php endForeach; ?>
<label for="customer_name">Nom</label>
<input type="text" name="customer_name">
<label for="customer_contact">Téléphone</label>
<input type="text" name="customer_contact">
<label for="customer_email">Email</label>
<input type="text" name="customer_email">
<label for="contact_address">Adresse de livraison</label>
<input type="text" name="customer_address">
<input type="submit" name="submit" method='POST'>
</form>

<!-- boucle qui insère les données au fur et à mesure si on clique sur envoyer -->

<?php

if(isset($_POST['submit'])){
    $i = 0;
    while($i <= array_key_last($products)){

        $food = $_POST['food'.$i];
        $price = $_POST['price'.$i];
        $qty = $_POST['qty'.$i];
        $total = $_POST['total'.$i];
        $order_date = $_POST['order_date'.$i];
        $status = $_POST['status'.$i];
        $customer_name = $_POST['customer_name'];
        $customer_contact = $_POST['customer_contact'];
        $customer_email = $_POST['customer_email'];
        $customer_address = $_POST['customer_address'];

        try{
            $requete = "INSERT INTO `tbl_order` (`id`, `food`, `price`, `qty`, `total`, `order_date`, `status`, `customer_name`, `customer_contact`, `customer_email`, `customer_address`) VALUES (NULL, '$food', '$price', '$qty', '$total', '$order_date', '$status', '$customer_name', '$customer_contact', '$customer_email', '$customer_address')";
            $DB->query($requete);
            $i++;
        }catch (PDOException $e) {
            exit($e->getMessage());
        
        }
    }
}

//INSERT INTO `tbl_order` (`id`, `food`, `price`, `qty`, `total`, `order_date`, `status`, `customer_name`, `customer_contact`, `customer_email`, `customer_address`) VALUES (NULL, 'salade', '1', '1', '1', '2021-03-23 15:41:29', 'en cours', 'lindsay', 'l@l.fr', 'erzrzr', 'fffff');


?>

</body>
</html>