
 <?php include ('partials/menu.php'); ?>

   <!-- main section starts !-->
   <div class="main-content">
    <div class="wrapper">
     <h1>Modifier une catégorie</h1>
    <br><br>

    <?php
        if(isset($_GET['id']))
        {


        //select id
            $id= $_GET['id'];

           //create sql to get * the details
            $sql= "SELECT * FROM tbl_category WHERE id=$id";

            //execute the query
            $res= mysqli_query($conn, $sql);

            //count the row to check wether the id is valid or not

            $count = mysqli_num_rows($res);

            if($count==1)
             {
                $row = mysqli_fetch_assoc($res);
                $title = $row['title'];
                $current_image = $row['image_name'];
                $featured = $row['featured'];
                $active = $row['active'];

             }
             else
             {
                $_SESSION['no-category-found'] = "<div class='success'> Cette catégorie n'existe pas<div>";
                //redirect
                header('location:'.SITEURL.'admin/manage-category.php');
             }



        }
        else
        {
            header('location:'.SITEURL.'admin/manage-category.php');
        }

    ?>

      <form action="" method="POST" enctype="multipart/form-data">

<table class="tbl-30">
    <tr> 
        <td> Catégorie:</td>
        <td> <input type ="text"name="title"value=<?php echo $title ?> ></td>
     </tr>

     <tr> 
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
    </td> 
      </tr>

      <tr> 
          <td> Nouvelle image </td>
          <td>
            <input type ="file"name="image">
          </td> 
      </tr>

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
     <input type ="submit"name="submit"value="Modifier la catégorie" class="btn-secondary"></td>
     </tr>
</table>

</form>

<?php
if(isset($_POST['submit']))
{
    //echo "clicked";
    $id= $_POST['id'];
    $title= $_POST['title'];
    $current_image= $_POST['current_image'];
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
           $destination_path = $_FILES['image']['tmp_name'];
           $destination_path = "../images/".$image_name;

           //finally upload
           $upload = move_uploaded_file($source_path, $destination_path);
           //check wether the image is uploaded or not
           // and if the image is not uploaded then we will stop the process and redirect with error message
           if($upload==false)
           {
                 $_SESSION['upload'] = "<div class = 'error'> le fichier n'a pas été téléchargé. </div>";
                 header('location:'.SITEURL.'admin/add-category.php');
           }
            if($current_image != ""){
                $remove_path = "../images".$current_image;
                $remove = unlink($remove_path);
              }
    
             
                if($remove==false)
                {
                    //set the session message
                    $_SESSION['failed-remove'] = "<div class='error'> Le fichier reste présent dans votre dossier<div>";
                    //redirect
                    header('location:'.SITEURL.'admin/manage-category.php');
        
                  
                }
            }
            
          
          else
          {
                 //don't upload and set the value as blank
                 $image_name= $current_image;
          }
        }
          else
          {
                 //don't upload and set the value as blank
                 $image_name= $current_image;
          }
     
   


    $sql2 = "UPDATE tbl_category SET 
    title= '$title',
    image_name= '$image_name',
    featured = '$featured',
    active= '$active'
    WHERE id= $id ";

    //execute
    $res2 = mysqli_query($conn, $sql2);
    

    if($res2==true)
    {
        //category updated

        $_SESSION['update'] = "<div class='success'> La catégorie a bien été modifiée <div>";
        //redirect
        header('location:'.SITEURL.'admin/manage-category.php');
      
    }
    else
    {
        //failed
        $_SESSION['update'] = "<div class='error'> La catégorie n'a pas été modifiée<div>";
        //redirect
        header('location:'.SITEURL.'admin/manage-category.php');
      
    }


}
?>

</div>
</div>
<?php include('partials/footer.php'); ?>