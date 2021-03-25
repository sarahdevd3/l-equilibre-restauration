<?php include ('partials/menu.php'); ?>

     <!-- main section starts !-->
     <div class="main-content">
      <div class="wrapper">
       <h1>Ajouter une catégorie</h1>
      <br><br><br>

      <?php
       if(isset($_SESSION['add']))
       {
         echo $_SESSION['add'];
         unset($_SESSION['add']); //remove the message
      }
      if(isset($_SESSION['upload']))
      {
        echo $_SESSION['upload'];
        unset($_SESSION['upload']); //remove the message
     }


?>

<br><br>
      <form action="" method="POST" enctype="multipart/form-data">

<table class="tbl-30">
    <tr> 
        <td> Catégorie:</td>
        <td> <input type ="text"name="title"placeholder="Entrez la catégorie"></td>
     </tr>

      <tr> 
          <td> Select image </td>
          <td>
            <input type ="file"name="image">
          </td> 
      </tr>

     <tr> 
        <td> En vedette: </td>
        <td> <input type ="radio"name="featured"value="Yes">Yes
             <input type ="radio"name="featured"value="No"> No
         </td> 
     </tr>

     <tr> 
        <td> Active :</td>
        <td> <input type ="radio"name="active"value="Yes">Yes
             <input type ="radio"name="active"value="No">No
            </td> 
     </tr>

     <tr>
     <td colspan="2">
     <input type ="submit"name="submit"value="Add Category" class="btn-secondary"></td>
     </tr>
</table>

</form>

<?php

if(isset($_POST['submit']))
{
     $title= $_POST['title'];

//for radio input
     if(isset($_POST['featured']))
     {
            $featured = $_POST['featured'];
     }

else
      {
      $featured = "No";
      }


      if(isset($_POST['active']))
      
      {
            $active = $_POST['active'];
      }
 
      else
       {
            $active = "No";
       
       }

     //check wether image is selected or not
     //print_r($_FILES['image']);

     //die();
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
           $_image_name = "food-category-".rand(000,999).'.'.$ext; //e.g. food_category_834.jpg
           

           $_source_path = $_FILES['image']['tmp_name'];
           $destination_path = $_FILES['image']['tmp_name'];
           $destination_path = "../images/food".$image_name;

           //finally upload
           $upload = move_uploaded_file($source_path, $destination_path);
           //check wether the image is uploaded or not
           // and if the image is not uploaded then we will stop the process and redirect with error message
           if($upload==false)
           {
                 $_SESSION['upload'] = "<div class = 'error'> le fichier n'a pas été téléchargé. </div>";
                 header('location:'.SITEURL.'admin/add-category.php');
           }

          }
     }
     else
     {
            //don't upload and set the value as blank
            $image_name="";
     }


     $sql = 
     "INSERT INTO tbl_category SET
       title='$title',
       image_name='$image_name',
       featured='$featured',
       active='$active'";
        

  //execute the query
  $res = mysqli_query($conn, $sql);
 

       if($res==TRUE)
  {
      //query executed and add category
      $_SESSION['add'] = "<div class='success'> Catégorie ajoutée.<div>";
      //redirect
      header('location:'.SITEURL.'admin/manage-category.php');
  }
 
  else
  {
      $_SESSION['add'] = "<div class='error'> La Catégorie n'a pas été ajoutée.<div>";
      //redirect
      header('location:'.SITEURL.'admin/add-category.php');
  }

}


?>

      </div>
      </div>

<?php include('partials/footer.php'); ?>