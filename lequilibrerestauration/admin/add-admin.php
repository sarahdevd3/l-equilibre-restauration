<?php include('partials/menu.php'); ?>


     <!-- main section starts !-->
     <div class="main-content">
      <div class="wrapper">
      <h1>Ajouter un administrateur</h1>
<br> <br>

<?php
if(isset($_SESSION['add']));//Checking wether the Session is set or not
{
echo ($_SESSION['add']); //Display the session message if set
unset($_SESSION['add']); //Remove Session message
}
?>

    <form action="" method="POST">

    <table class="tbl-30">
        <tr> 
            <td> Nom :</td>
            <td> <input type ="text"name="full_name"placeholder="Entrez votre Nom et Prénom"></td>
         </tr>
         <tr> 
            <td> Pseudo :</td>
            <td> <input type ="text"name="username"placeholder="Entrez votre Pseudo"></td>
         </tr>
         <tr> 
            <td> Password:</td>
            <td> <input type ="password"name="password"placeholder="Entrez votre mot de passe"></td>
         </tr>
         <tr>
         <td colspan="2">
             
         <input type ="submit"name="submit"value="Ajouter un admin" class="btn-secondary"></td>
         </tr>
</table>

    </form>
</div>
<?php include('partials/footer.php'); ?>


<?php
// process the value from form and save it to database
//Check wether the submit button is clicked or not

if(isset($_POST['submit']))
{
    //button clicked
   // echo "button clicked";
   // get the data from form

   $full_name= $_POST['full_name'];
   $username= $_POST['username'];
   $password= md5($_POST['password']); //password encription with md5

   //sql query to save the data into database

   $sql= "INSERT INTO tbl_admin SET
   full_name='$full_name',
   username='$username',
   password= '$password'
   ";
  
//execute query and save it to database
$res = mysqli_query($conn,$sql) or die (mysqli_error());
// check wether the data is inserted or not and display appropriate message
if($res==TRUE)
{
   //create a session variable to display message
   $_SESSION['add'] = "L'administrateur à bien été ajouté";
   //redirect page to manage admin
   header("location:".SITEURL.'admin/manage-admin.php');
}
else{
    //failed to insert data
  //create a session variable to display message
  $_SESSION['add'] = "L'administrateur n'a pas été ajouté";
  //redirect page to manage admin
  header("location:".SITEURL.'admin/add-admin.php');
}
}
?>