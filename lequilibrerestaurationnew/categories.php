<?php include('partials-front/menu.php')?>



    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
           
     <?php
        $sql="SELECT*FROM tbl_category limit 6";
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
       

       <a href="#">
       <div class="box-3 float-container">
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
    
    <h3 class="float-text text-white"> <?php echo $title?></h3>
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
    <!-- Categories Section Ends Here -->


     <!-- fOOD MEnu Section Starts Here -->
     <section class="food-menu">
        <div class="container">
            <?php
        $sql2="SELECT*FROM tbl_food";
        $res2 = mysqli_query($conn, $sql2);
        //count rows

        $count2 = mysqli_num_rows($res2);

        if($count2>0)
        {
            // we have data in database
            while($row2=mysqli_fetch_assoc($res2)){
                  $id=$row2['id'];
                  $title=$row2['title'];
                  $price=$row2['price'];
                  $description = $row2['description'];
                  $image_name=$row2['image_name'];


                ?>
       

            <div class="food-menu-box">
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
                    <p class="food-price"><?php echo $price;?></p>
                    <p class="food-detail">
                    <?php echo $description;?>
                    </p>
                    <br>

                    <a href="<?php echo SITEURL;?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                </div>
            </div>
<?php
            }
        }

        else
        {
            echo "<div class='error'>Image non disponible .</div>"; 
        }

?>
            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->


</body>
</html>

<?php include('partials-front/footer.php')?>
