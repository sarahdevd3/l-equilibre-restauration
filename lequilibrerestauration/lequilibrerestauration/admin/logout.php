<?php
//include constant.php
include ('../config/constant.php');

//destroy the session
session_destroy();

//redirect
header('location:'.SITEURL.'admin/login.php');

?>