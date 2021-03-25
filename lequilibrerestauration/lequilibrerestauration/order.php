<?php include('partials-front/menu.php')?>


<?php

        if(isset($_GET['food_id']))
        {
            $food_id = $_GET['food_id'];

            $sql="SELECT * FROM tbl_food WHERE id=$food_id";
            $res = mysqli_query($conn, $sql);
            //count rows
    
            $count = mysqli_num_rows($res);

            if($count==1){

                $row = mysqli_fetch_assoc($res);
                

                      $title=$row['title'];
                      $price=$row['price'];
                      $image_name=$row['image_name'];            
           
                }
        else
        {
                header('location:'.SITEURL);
        }

    }

?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="bg">
        <div class="container">
            
            <h3 class="text-center text-white">Envoyez-nous votre commande <br> via ce formulaire</h3>
  


            <form action="" method="POST" class="order">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">

                    
      <?php
                
       
      if($image_name=="")

        {
            echo "<div class='error'>Image non disponible .</div>"; 

        }
        else
        {
            ?>

            <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Pizza" class="img-food">

            <?php

        }

        ?>

       </div>
           <div class="food-menu-desc">
                    <h4><?php echo $title;?></h4>
                    <input type="hidden" name="food" value="<?php echo $title?>">
                    <p class="food-price"><?php echo $price;?>€</p>
                    <input type="hidden" name="price" value="<?php echo $price?>">
                    <div class="order-label"> Quantité </div>
                    <input type="number" name="qty" class="input-responsive" value="1" required>
                </div>
        

    

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. Vijay Thapa" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. hi@vijaythapa.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>
            <?php
    
    if(isset($_SESSION['order']))
    {
          echo $_SESSION['order'];
          unset($_SESSION['order']); //remove the message
    }

?>

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
                    $_SESSION['order']= "<div class='text-center'> La commande à bien été envoyée.<div>";
                    
            }
            else
            {
                    
                $_SESSION['order']= "<div class='error'> La commande n'a pas été envoyée.<div>";
                
            }
}

?>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

</body>
</html>
<?php include('partials-front/footer.php')?>