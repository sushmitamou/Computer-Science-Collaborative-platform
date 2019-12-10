<?php 
session_start();
require_once "functions.php";
$loginregister = new LoginRegister();
$loginregister->logoutUser();
header("location:login.php?response=1");
exit();

?>