<?php
//check wether the user is logged in
if(!isset($_SESSION['user'])) //if user session is not set 
{
             $_SESSION['no-login-message']="<div class='error'> Merci de vous identifier à nouveau.<div>";
             header('location:'.SITEURL.'admin/login.php');
}

?>