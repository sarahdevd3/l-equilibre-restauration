<?php include('partials-front/menu.php')?>

   <?php
    
    if(isset($_SESSION['order']))
    {
          echo $_SESSION['order'];
          unset($_SESSION['order']); //remove the message
    }

?>

   <!-- fOOD sEARCH Section Starts Here -->
   <section class="food-search text-center">
        <div class="container">
            
            <form action="food-search.html" method="POST">
                <input type="search" name="search" placeholder="Un plat vous tente? Recherchez-le.." required>
                <input type="submit" name="submit" value="Miam!" class="btn btn-primary">
            </form>

        </div>
    </section>
  
    <!-- fOOD sEARCH Section Ends Here -->

    <div class="hours">
        <h2>UNIQUEMENT EN LIVRAISON</h2>
        <p>3.50 € Alès et environs</p></br>
        <h3>Commande jusqu'à 11h pour le midi, livraison de 11h30 à 14h</h3></br>
        <h3>Commande jusqu'à 18h pour le soir, livraison de 19h à 22h</h3>
    </div>
    <!-- History Section Starts Here -->
    <section class="history">
        <div class="container">
            <br> <br>
            <p class="text-cent"><span style="color:  #00917C">M</span>anger bien <span style="color:  #00917C">M</span>anger sain <br>
                <br>
                Une invitation pour un vrai retour aux sources.<br> Une cuisine simple, originale. <br> des saveurs, des goûts
<br> et des associations insolites.<br>

            
            <form action="<?php echo SITEURL; ?>categories.php"> 
<input type="submit"value="Découvrir notre carte" class="btn-discover">
</form>
</div>
    
                <section class="categories">
        <div class="container">
           
     <?php
        $sql="SELECT*FROM tbl_category";
        $res = mysqli_query($conn, $sql);
        //count rows

        $count = mysqli_num_rows($res);

        if($count>0)
        {
            // we have data in database
            while($row=mysqli_fetch_assoc($res)){
                  $id=$row['id'];
                  $title=$row['title'];
                  $image_name=$row['image_name'];
                ?>
       

       <a href="category-foods.html">
       <div class="box-3 float-container">
       <?php 
        if($image_name=="")
        {
            echo "<div class='error'>Image non disponible .</div>"; 
        }
        else
        {

          ?>
       <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Pizza" class="img-responsive img-curve">


                <?php
        }
    
     ?>
    
  
</div>
</a>
    <?php    

        }
    }
    else
    {

    }

    ?>

 <div class="clearfix"></div>
 </div>
    </section>
            

</body>
</html>

<?php include('partials-front/footer.php')?>
