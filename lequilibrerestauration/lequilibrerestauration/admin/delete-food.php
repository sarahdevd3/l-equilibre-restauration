<?php

//delete food page
include ('../config/constant.php');

if(isset($_GET['id']) && isset($_GET['image_name']))
{
  
       $id = $_GET['id'];
       $image_name = $_GET['image_name'];

if($image_name != "")
{
     $path = "../images/food/".$image_name;

     $remove = unlink($path);

if($remove==false)
{
    $_SESSION['upload'] = "<div class='error'> Le fichier reste présent dans votre dossier.<div>";
    header('location:'.SITEURL.'admin/manage-food.php');
    }

}
$sql = "DELETE FROM tbl_food WHERE id=$id";

$res = mysqli_query($conn, $sql);

if($res==true){
    //Query successfully executed
    $_SESSION['delete'] = "<div class='success'>Plat supprimé</div>";
    header('location:'.SITEURL.'admin/manage-food.php');
    }
    else{
        $_SESSION['delete'] = "<div class='error'>Plat non supprimé. </div>";
        header('location:'.SITEURL.' admin/manage-food.php');
    
    }
    

}

else
{
    $_SESSION['unauthorized'] = "<div class='error'> Le fichier n'a pas été supprimé.<div>";
    header('location:'.SITEURL.'admin/manage-food.php');
}
?>