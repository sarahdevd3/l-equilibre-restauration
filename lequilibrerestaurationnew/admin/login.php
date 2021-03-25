
<?php  include ('../config/constant.php')?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/admin.css">
    <title>Login-food order system</title>
</head>
<body>
<div class="login">
    <h1 class="text-center"> Login </h1>
    <br><br>
    <?php
    if(isset($_SESSION['login'])){
        echo $_SESSION['login'];
        unset($_SESSION['login']);
    }
    if(isset($_SESSION['no-login-message'])){
        echo $_SESSION['no-login-message'];
        unset($_SESSION['no-login-message']);
    }

    ?>
<!--login form starts here -->
<form action="" class="text-center" method="POST">
Pseudo:  <br>
<input type="text" name="username" placeholder="entrez votre pseudo"> <br><br>
Mot de passe:  <br>
<input type="text" name="password" placeholder="entrez votre mot de passe"> <br><br>
<input type="submit" name="submit" value="valider" class="btn-primary"> <br><br>

<!--login form starts here -->
</div>
</body>
</html>
<?php
//check wether the submit button is clicked
if(isset($_POST['submit']))
{
//process for login

//get the data from login form
$username= md5($_POST['username']);
$password= md5($_POST['password']);

//create sql query to check wether the user infos exists

$sql = "SELECT * FROM tbl_admin WHERE '$username' AND password='$password'";

//execute query
$res = mysqli_query($conn, $sql);
//count rows to check wether the user exists
$count = mysqli_num_rows($res);

if($count==1){
    //user available and login success
    $_SESSION['login'] = "<div class='success'>Connexion réussie!</div>";
    $_SESSION['user'] = $username;

    header('location:'.SITEURL.'admin/');
}
else{
    //user not available and login fail
    $_SESSION['login'] = "<div class='error'>Mauvais identifiant!Nous ne pouvons pas vous connecter </div>";
    header('location:'.SITEURL.'admin/login.php');
}
}
    ?>