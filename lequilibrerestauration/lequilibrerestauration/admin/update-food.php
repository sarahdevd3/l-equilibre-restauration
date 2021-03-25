<?php include('partials/menu.php'); ?>

     <!-- main section starts !-->
     <div class="main-content">
      <div class="wrapper">
       <h1>Modifier le Menu</h1>
       <br><br><br>

       <?php
        if(isset($_GET['id']))
        {


        //select id
            $id= $_GET['id'];

           //create sql to get * the details
            $sql2= "SELECT * FROM tbl_food WHERE id=$id";

            //execute the query
            $res2= mysqli_query($conn, $sql2);

            //count the row to check wether the id is valid or not

            $count = mysqli_num_rows($res2);

            if($count==1)
             {
                $row2 = mysqli_fetch_assoc($res2);
                $title = $row2['title'];
                $description = $row2['description'];
                $price = $row2['price'];
                $current_image= $row2['image_name'];
                $current_category= $row2['category_id'];
                $featured = $row2['featured'];
                $active = $row2['active'];

             }
             else
             {
                $_SESSION['no-category-found'] = "<div class='success'> Cette catégorie n'existe pas<div>";
                //redirect
                header('location:'.SITEURL.'admin/manage-food.php');
             }



        }
        else
        {
            header('location:'.SITEURL.'admin/manage-food.php');
        }

    ?>

       <form action="" method="POST" enctype="multipart/form-data">

<table class="tbl-30">
    <tr> 
        <td> Nom du plat:</td>
        <td>  <input type ="text"name="title"value=<?php echo $title ?> ></td>
     </tr>

     <tr> 
        <td> Description:</td>
        <td> <textarea name="description" cols="30" rows= "5" ><?php echo $description ?></textarea>
        </td>
     </tr>



     <tr> 
        <td> Prix </td>
        <td> <input type ="number"name="price" step=".01" value=<?php echo $price ?>></td>
     </tr>


     <td> Image actuelle </td>
          <td>
       <?php
            if($current_image != "")
            {
                  ?>
                    <img src="<?php echo SITEURL;?>images/food/<?php echo $current_image; ?>"width="150px">
                  <?php
            }
            else
            {
                echo "<div class='error'> image non ajoutée. </div>";
            }

        
       ?>

      <tr> 
          <td> Select image </td>
          <td>
            <input type ="file"name="image">
          </td> 
      </tr>

     <tr> 
        <td> Catégorie </td>
        <td> <select name="category">
        <?php
        $sql = "SELECT * FROM tbl_category WHERE active= 'Yes'";

        $res = mysqli_query($conn, $sql);

        $count = mysqli_num_rows($res);

        if($count>0)
        {
            while($row=mysqli_fetch_assoc($res))
            {
            $category_title= $row['title'];
            $category_id= $row['id'];
            ?>
            <option value="<?php echo $category_id; ?>" ><?php echo $category_title ?> </option>
<?php


        
    }
}
    
        else
        {
            ?>
            <option value="0"> Not found </option>
            <?php
        }
           


        ?>
    </select>
    <tr> 
        <td> En vedette: </td>
        <td> <input <?php  if($featured=="Yes") {echo"checked";}  ?> type ="radio"name="featured"value="Yes">Yes
             <input <?php  if($featured=="No") {echo"checked";}  ?>  type ="radio"name="featured"value="No"> No
         </td> 
     </tr>

     <tr> 
        <td> Active :</td>
        <td> 
        <input <?php  if($active=="Yes") {echo"checked";}  ?> type ="radio"name="active"value="Yes">Yes
        <input <?php  if($active=="No") {echo"checked";}  ?> type ="radio"name="active"value="No">No
            </td> 
     </tr>

     <tr>
     <input type ="hidden"name="current_image"value="<?php echo $current_image; ?>"></td>
     <input type ="hidden"name="id"value="<?php echo $id; ?>"></td>
     </tr>
     <tr>
     <td>
     <input type ="submit"name="submit"value="Modifier" class="btn-secondary"></td>
     </tr>
</table>

</form>

<?php
if(isset($_POST['submit']))
{
    //echo "clicked";
    $id= $_POST['id'];
    $title= $_POST['title'];
    $description= $_POST['description'];
    $price= $_POST['price'];
    $current_image= $_POST['current_image'];
    $category= $_POST['category'];
    $featured= $_POST['featured'];
    $active= $_POST['active'];
 


                //Check if the image is selected or not
                if(isset($_FILES['image']['name']))
     {
           //upload image
           //to upload we need image name, source path and destination path
           $image_name = $_FILES['image']['name'];

           //upload only if image is selected
           if($image_name != "")
           {


           //auto rename image
           //get the extension of our image (jpg, png, gif...)e.g. specialfood1.jpg
           $ext= end(explode('.', $image_name));

           //rename the image
           $_image_name = "food_category_".rand(000,999).'.'.$ext; //e.g. food_category_834.jpg
           

           $_source_path = $_FILES['image']['tmp_name'];
           $destination_path = "../images/food/".$image_name;

           //finally upload
           $upload = move_uploaded_file($source_path, $destination_path);
           //check wether the image is uploaded or not
           // and if the image is not uploaded then we will stop the process and redirect with error message
           if($upload==false)
           {
                 $_SESSION['upload'] = "<div class = 'error'> le fichier n'a pas été téléchargé. </div>";
                 header('location:'.SITEURL.'admin/add-food.php');
           }
            if($current_image != ""){
                $remove_path = "../images/food/".$current_image;
                $remove = unlink($remove_path);
              }
    
             
                if($remove==false)
                {
                    //set the session message
                    $_SESSION['remove-failed'] = "<div class='error'> Le fichier reste présent dans votre dossier<div>";
                    //redirect
                    header('location:'.SITEURL.'admin/manage-food.php');
        
                  
                }
            }
            
          
          else
          {
                 //don't upload and set the value as blank
                 $image_name= $current_image;
          }
        
        }
   


    $sql3 = "UPDATE tbl_food SET 
    title= '$title',
    description = '$description',
    price = $price,
    image_name= '$image_name',
    category_id =  '$category',
    featured = '$featured',
    active= '$active'
    WHERE id= $id ";

    //execute
    $res3 = mysqli_query($conn, $sql3);
    

    if($res3==true)
    {
        //category updated

        $_SESSION['update'] = "<div class='success'> Le plat a bien été modifié <div>";
        //redirect
        header('location:'.SITEURL.'admin/manage-food.php');
      
    }
    else
    {
        //failed
        $_SESSION['update'] = "<div class='error'> Le plat n'a pas été modifié<div>";
        //redirect
        header('location:'.SITEURL.'admin/manage-food.php');
      
    }


}
?>
</div>
</div>
