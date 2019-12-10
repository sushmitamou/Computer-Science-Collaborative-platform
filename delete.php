
<?php
session_start();
require_once "functions.php";
$loginregister = new LoginRegister();

    if(isset($_GET['skill_id'])){
       $id = $_GET['skill_id'];
       $loginregister->deleteUserSkill($id);
      header('location:skill.php');
    }

?>