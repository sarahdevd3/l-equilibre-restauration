
<?php
include('../config/constant.php');

//check wether the id and image name is set or not
if(isset($_GET['id']) AND isset($_GET['image_name']))
{
    //get the value
    $id= $_GET['id'];
    $image_name = $_GET['image_name'];

    //remove the physical image file
    if($image_name != "")
    {
        $path= "../images/".$image_name;

        $remove = unlink($path);

        if($remove==false)
        {
            //set the session message
            $_SESSION['remove'] = "<div class='success'> Le fichier reste présent dans votre dossier<div>";
            //redirect
            header('location:'.SITEURL.'admin/manage-category.php');
          
        }
    
    }

    //delete data
    $sql = "DELETE FROM tbl_category WHERE id=$id";

    //Execute

    $res = mysqli_query($conn, $sql);

    if($res==true)
    {
        $_SESSION['delete'] = "<div class='success'> La Catégorie a bien été supprimée.<div>";
        header('location:'.SITEURL.'admin/manage-category.php');
    }
    else
    {
        $_SESSION['delete'] = "<div class='error'> La Catégorie n'a pas été supprimée.<div>";
        header('location:'.SITEURL.'admin/manage-category.php');
    }

    //redirect with message
}

?>