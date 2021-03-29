<?php

class panier{

    // on a besoin de connaître la connexion à la bdd

    private $DB;

    // pour stocker les infos on va utiliser des variables de session
    // = tableau conservé tout le long de la navigation

    public function __construct($DB){
        // je vais vérifier que la session existe sinon je la créé avec un panier vide array 

        if(!isset($_SESSION)){
            session_start();
        }
        if(!isset($_SESSION['panier'])){
            $_SESSION['panier'] = array();
        }
        
        // pour supprimer que le montant s'adapte en direct quand je supprime un article
        // on récupère l'info par l'url avec delPanier
        $this->DB = $DB;
        if(isset($_GET['delPanier'])){
            $this->del($_GET['delPanier']);
        }

    }

    public function total(){
        $total = 0;
        $ids = array_keys($_SESSION['panier']);
        // si le tableau des id est vide, le tableau envoyé ailleurs est vide sinon continue la requête
        if(empty($ids)){
            $products = array();
        } else{
        $products = $this->DB->query('SELECT id, price FROM products WHERE id IN ('.implode(',',$ids).')');
        }
        foreach($products as $product){
            $total += $product->price * $_SESSION['panier'][$product->id];
        }
        return $total;
    }

    // pour connaître le nombre d'éléments dans le panier 

    public function count(){
        return array_sum($_SESSION['panier']);
    }

    // Je créé une fonction d'ajout au panier pour que le code soit plus propre

    public function add($product_id){
        // on prend l'id du produit et on incrémente sinon on initialise en mettant 1
        // je teste si une variable est définie 
        if(isset($_SESSION['panier'][$product_id])){
            $_SESSION['panier'][$product_id]++;
        }else{
            $_SESSION['panier'][$product_id] = 1;
        }
    }

    // fonction de suppression d'un produit du panier 

    public function del($product_id){
        unset($_SESSION['panier'][$product_id]);
    }

}

?>