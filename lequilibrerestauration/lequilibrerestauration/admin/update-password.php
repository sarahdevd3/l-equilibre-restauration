<?php include('partials/menu.php'); ?>

      <!-- main section starts !-->
      <div class="main-content">
      <div class="wrapper">
       <h1>Modifier le mot de passe</h1>
      <br><br><br>
      <?php   $id=$_GET['id']; ?>


      <form action="" method="POST">

<table class="tbl-30">
    <tr> 
        <td> MDP actuel :</td>
        <td> <input type ="password"name="current_password"placeholder="Mot de passe actuel"></td>
     </tr>
     <tr> 
        <td> Nouveau MDP :</td>
        <td> <input type ="password"name="new_password"placeholder="Nouveau mot de passe"></td>
     </tr>
     <tr> 
        <td> Confirmez le MDP :</td>
        <td> <input type ="password"name="confirm_password"placeholder="Confirmez le mot de passe"></td>
     </tr>
     <tr>
     <td colspan="2">
     <input type ="hidden"name="id"value= <?php echo $id; ?> class="btn-secondary">
     <input type ="submit"name="submit"value="Changer le mot de passe" class="btn-secondary"></td>
     </tr>
</table>

</form>

</div>
</div>

<?php
// check wether the submit button is clicled or not
if(isset($_POST['submit']))
{
    //get all the values from form
    $id = $_POST['id'];
    $current_password =  md5($_POST['current_password']);
    $new_password =  md5($_POST['new_password']);
    $confirm_password =  md5($_POST['confirm_password']);


    //check wether the user with current ID and current Password exist or not
    $sql="SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";

    $res = mysqli_query($conn, $sql);

    if($res==true)
{
 //check wether data is available or not
    $count=mysqli_num_rows($res);

    if($count==1){
      
        if($new_password==$confirm_password){
         $sql2 = "UPDATE tbl_admin SET 
         password = '$new_password'
         WHERE id=$id
         ";

        $res2 = mysqli_query($conn, $sql2);
         // check if ok or not

        if($res2==true){

            $_SESSION['change-pwd'] ="<div class='error'>Le mot de passe a bien été modifié </div>";
            header('location:'.SITEURL.'admin/manage-admin.php');
        }

        }
        else
        {
            $_SESSION['user-not-match'] ="<div class='error'>Le mot de passe ne correspond pas </div>";
            header('location:'.SITEURL.'admin/manage-admin.php');
        }
    }

else
{
      $_SESSION['user-not-found'] ="<div class='error'>utilisateur inconnu</div>";
      header('location:'.SITEURL.'admin/manage-admin.php');
    
}
}

}
    

?>
<?php include('partials/footer.php'); ?>
