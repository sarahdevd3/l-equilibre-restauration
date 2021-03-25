<?php include ('partials/menu.php'); ?>

<div class = "main-content">
    <div class="wrapper">
        <h1> Modifier Admin </h1>
<br>

<?php
    //1. get the id of the selected admin
    $id=$_GET['id'];

    //2.Create sql query to get the details
    $sql="SELECT * FROM tbl_admin WHERE id=$id";
    

    //execute the query
    $res=mysqli_query($conn,$sql);

    //check wether the query is executed or not

    if($res==true)
    {
        //check wether the query is executed or not
        $count = mysqli_num_rows($res);
        //check wether we have admin or not
        if($count==1){
                //get the details
                $row=mysqli_fetch_assoc($res);

                $full_name = $row['full_name'];
                $username = $row['username'];
        }
        else{
            //redirect
            header('location:'.SITEURL.'admin/manage-admin.php');
        }
    }

?>
        <form action="" method="POST">

<table class="tbl-30">
    <tr> 
        <td> Nom :</td>
        <td> <input type ="text"name="full_name"value="<?php echo $full_name; ?>"></td>
     </tr>
     <tr> 
        <td> Pseudo :</td>
        <td> <input type ="text"name="username"value="<?php echo $username; ?>"></td>
     </tr>
     <tr>
     <td colspan="2">
     <input type ="hidden"name="id"value= <?php echo $id; ?> class="btn-secondary">
     <input type ="submit"name="submit"value="Modifier un admin" class="btn-secondary"></td>
     </tr>
</table>

</form>

</div>
</div>
<?php
// check wether the submit button is clicled or not
if(isset($_POST['submit']))
{
    //echo"ok modifié"
    //get all the values from form
    $id = $_POST['id'];
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
   //create sql query to update admin 
    $sql = "UPDATE tbl_admin SET 
    full_name = '$full_name',
    username = '$username'

    WHERE id= '$id'
    ";

      //execute the query
      $res = mysqli_query($conn, $sql);

  

    //check wether query is successfully executed or not

    if($res==true)
    {
        //query executed and admin updated
        $_SESSION['update'] = "<div class='success'> Administrateur modifié.<div>";
        //redirect
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
    else
    {
        $_SESSION['update'] = "<div class='success'> Administrateur non modifié.<div>";
        //redirect
        header('location:'.SITEURL.'admin/manage-admin.php');
    }

}

?>
<?php include('partials/footer.php'); ?>
