<?php
session_start();
require_once "functions.php";
$loginregister = new LoginRegister();

$uid   = $_SESSION['uid'];

if(!$loginregister->getSession()){
	header('location:login.php');
	exit();
}

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>Change password</title>
		<link rel="stylesheet" type="text/css" href="style1.css">
	</head>
	<body>
		<div class="wrapper">
			<?php include_once "inc/header2.php";?>
			<div class="mainmenu">
				<ul>
				<?php if($loginregister->getSession()){?>
					<li><a href="index.php">Home</a></li>
					<li>
						<a href="userprofile.php?id=<?php echo $uid?>">Show Profile</a>
					</li>
					<li><a href="changepassword.php">Change password</a></li>
					<li><a href="skill.php">Skill</a></li>
					<li><a href="logout.php">Logout</a></li>
					<?php } else {?>
					<li><a href="login.php">Login</a></li>
					<li><a href="register.php">Register</a></li>
					<?php }?>
				</ul>
			</div>
			<div class="st">
			</div>
			<div class="content">
				<h2>Update Your Password</h2>
			</div>
			<p class="msg">
			<?php
				if($_SERVER["REQUEST_METHOD"]=="POST"){
					$old_pass 	= md5($_POST['old_password']);
					$new_pass 	= md5($_POST['new_assword']);
					$confirm_new= md5($_POST['confirm_password']);
					
					if(empty($old_pass) or empty($new_pass) or empty($confirm_new)){
						echo "<span style='color:#e53d37'>Field must not be empty</span>";
					}elseif($new_pass!=$confirm_new){
						echo "<span style='color:#e53d37'>Password did not matched</span>";
					}else{
						$updatepassword = $loginregister->updatePassword($uid,$old_pass,$new_pass,$confirm_new);

					}

				}


				?>	
			</p>
			<div class="login_reg">
				<form action="" method="post" name="reg">
					<table>
						<tr>
							<td>Old Password:</td>
							<td><input type="text" name="old_password" placehplder="Please enter your old password"/></td>
						</tr>
						<tr>
							<td>New Password</td>
							<td><input type="text" name="new_assword" placehplder="Please enter your new password"/></td>
						</tr>
						<tr>
							<td>Confirm Password</td>
							<td><input type="text" name="confirm_password" placehplder="Please enter again your new password"/></td>
						</tr>
						<tr>
							<td colspan="2">
								<input type="submit" name="update" value="Update"/>
								<input type="reset"  value="Reset"/>
							</td>
						</tr>
					</table>
				</form>
			</div>
			<div class="back"> 
				<a href="index.php"><img src="img/back.png"></a>
			</div>
			<?php include_once "inc/footer2.php"?>
		</div>
	</body>
</html>

