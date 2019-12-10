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

			<div class="st">
			</div>
			<div class="content">
				<h2>Register</h2>
			</div>
			<p class="msg">
				<?php
				if($_SERVER["REQUEST_METHOD"]=="POST"){
					$username = $_POST['username'];
					$password = md5($_POST['password']);
					$name = $_POST['name'];
					$email = $_POST['email'];
					$std_id = $_POST['std_id'];
					// $website = $_POST['website'];
					if(empty($username) or empty($password) or  empty($email) or empty($name) or empty($std_id)){
						echo "<span style='color:#e53d37'>Field must not be empty</span>";
					}
					elseif (!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)) {
						# code...
						echo "<span style='color:#e53d37'>Invalid E-mail format.</span>";


					}
					else{
						$register = $loginregister->registerUser($username,$password,$email,$name,$std_id);
						// if(isset($register)){
						// 	echo "<span style='color:green'>Registration successfully compleated <a href='login.php'>Click Here</a> for login.</span>";
						// }else{
						// 	echo "Username or Email or Student ID already exist.";
						// }
					}
				}


				?>
			</p>
			<div class="login_reg">
				<form action="" method="post">
					<table>
						<tr>
							<td>Student ID:</td>
							<td><input type="number" name="std_id" placeholder="Please enter student Id"/></td>
						</tr>
						<tr>
							<td>Username:</td>
							<td><input type="text" name="username" placeholder="Please enter your username"/></td>
						</tr>
						<tr>
							<td>Password:</td>
							<td><input type="password" name="password" placeholder="Please enter your password"/></td>
						</tr>
						<tr>
							<td>Name:</td>
							<td><input type="text" name="name" placeholder="Please enter your name"/></td>
						</tr>
						<tr>
							<td>Email:</td>
							<td><input type="text" name="email" placeholder="Please enter your email"/></td>
						</tr>
						
						<!-- <tr>
							<td>Website:</td>
							<td><input type="text" name="website" placeholder="Please enter your website"/></td>
						</tr> -->
						<tr>
							<td colspan="2">
								<input type="submit" name="register" value="Register"/>
								<input type="reset"  value="Reset"/>
							</td>
						</tr>
					</table>
				</form>
			</div>
			<div class="back"> 
				<a href="login.php"><img src="img/back.png"></a>
			</div>
			<?php include_once "inc/footer2.php"?>
		</div>
	</body>
</html>

