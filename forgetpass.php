<?php 

require_once "functions.php";


$loginregister = new LoginRegister();
if($loginregister->getSession()){
	header('location:index.php');
	exit();
}

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>Registration Page</title>
		<link rel="stylesheet" type="text/css" href="style1.css">
	</head>
	<body>
		<div class="wrapper">
			<?php include_once "inc/header2.php";?>
			<div class="mainmenu">
				<ul>
				<?php if($loginregister->getSession()){?>
					<li><a href="index.php">Home</a></li>
					<li><a href="profile.php">Show Profile</a></li>
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
			<p class="login_msg">
				<?php
					if(isset($_GET['response'])){
						if($_GET['response']=='1'){
							echo "Logout successfully...";
						}
					}
				?>
			</p>
			<div class="content">
				<h2>Password Reset</h2>
			</div>
			<p class="msg">
			
			</p>
			<div class="login_reg">
				<form action="" method="post">
					<table>
						<tr>
							<td>Email:</td>
							<td><input type="text" name="email" placeholder="Please enter your email"/></td>
						</tr>
						<tr>
							<td>Password:</td>
							<td><input type="password" name="new_pass" placeholder="Please enter your password"/></td>
						</tr>
						<tr>
							<td>Confirm Password:</td>
							<td><input type="password" name="cpass" placeholder="Please enter your password"/></td>
						</tr>
						<tr>
							<td colspan="2">
								<input type="submit" name="submit" value="Submit"/>
								<input type="reset"  value="Reset"/>
							</td>
						</tr>
					</table>
				</form>
				<?php
					
				if($_SERVER["REQUEST_METHOD"]=="POST"){
					$email 	= $_POST['email'];
					$new_pass 	= md5($_POST['new_pass']);
					$cpass= md5($_POST['cpass']);
					
					if(empty($email) or empty($new_pass) or empty($cpass)){
						echo "<span style='color:#e53d37'>Field must not be empty</span>";
					}elseif($new_pass!=$cpass){
						echo "<span style='color:#e53d37'>Password did not matched</span>";
					}else{
						$ForgetPassword = $loginregister->ForgetPassword($email,$new_pass,$cpass);

					}

				}



				 ?>

			</div>
						<div class="back"> 
				<a href="login.php"><img src="img/back.png"></a>
			</div>
			<?php include_once "inc/footer2.php"?>
		</div>
	</body>
</html>

