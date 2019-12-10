<?php
session_start();
require_once "functions.php";
$loginregister = new LoginRegister();

$uid   = $_SESSION['uid'];
$uname = $_SESSION['uname'];
/*
if(isset($_REQUEST ['id'])){
$id = $_REQUEST ['id'];
}else{
	header("location:index.php");
	exit();
}
*/
if(!$loginregister->getSession()){
	header('location:login.php');
	exit();
}

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>Update Profile</title>
		<link rel="stylesheet" type="text/css" href="style1.css">
	</head>
	<body>
		<div class="wrapper">
			<?php include_once "inc/header.php";?>
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
				<h2>Update Your Profile</h2>
			</div>
			<p class="msg">
			<?php
				if($_SERVER["REQUEST_METHOD"]=="POST"){
					$permited 	= array('jpg','jpeg','png','gif','swf');
			$file_name  = $_FILES['image']['name'];
			$file_size  = $_FILES['image']['size'];
			$file_temp  = $_FILES['image']['tmp_name'];

			$div 		= explode('.', $file_name);
			$file_ext   = end($div);
			$unique_name 	= substr(md5(time()), 0,10).'.'.$file_ext;
			$uploaded_image = "img/".$unique_name;

			
					$username = $_POST['username'];
					$name = $_POST['name'];
					$email = $_POST['email'];
					$website = $_POST['website'];
					$occupation = $_POST['occupation'];
					$phone = $_POST['phone'];
					$std_id = $_POST['std_id'];
				
					if(empty($username) or empty($name) or empty($email) or empty($website) or empty($occupation) or empty($phone) or empty($std_id)){
						echo "<span style='color:#e53d37'>Field must not be empty</span>";
					// }else if(empty($file_name)){
					// 	echo "<span class='error'>Please Select Any image.</span>";
					// }elseif($file_size>1048576){
					// 	echo "<span class='error'>Image size should be less then 1 MB</span>";
					// }elseif(in_array($file_ext, $permited)===false){
					// 	echo "<span class='error'>You can uploads only:-".implode(',', $permited)."</span>";
					}
					else{
						move_uploaded_file($file_temp, $uploaded_image);
						$update = $loginregister->updateUser($uid,$username,$name,$email,$website,$occupation,$phone,$uploaded_image,$std_id);
						if($update){
							echo "<span style='color:green'>Information Updated Successfully.</span>";
						}
					}

				}


				?>	
			</p>
			<?php 
				$result = $loginregister->getUserDetails($uid);
				foreach($result as $userdetails){
			?>
			<div class="login_reg">
				<form action="" method="post" name="reg" enctype="multipart/form-data">
					<table>
						<tr>
							<td>Student ID:</td>
							<td><input type="text" name="std_id" value="<?php echo $userdetails['std_id']?>"/></td>
						</tr>
						<tr>
							<td>Username:</td>
							<td><input type="text" name="username" value="<?php echo $userdetails['username']?>"/></td>
						</tr>
						<tr>
							<td>Name:</td>
							<td><input type="text" name="name" value="<?php echo $userdetails['name']?>"/></td>
						</tr>
						<tr>
							<td>Email:</td>
							<td><input type="text" name="email" value="<?php echo $userdetails['email']?>"/></td>
						</tr>
						
						<tr>
							<td>Address:</td>
							<td><input type="text" name="website" value="<?php echo $userdetails['website']?>"/></td>
						</tr>
						<tr>
							<td>Occupation:</td>
							<td><input type="text" name="occupation" value="<?php echo $userdetails['occupation']?>"/></td>
						</tr>
						<tr>
							<td>Phone:</td>
							<td><input type="text" name="phone" value="<?php echo $userdetails['phone']?>"/></td>
						</tr>
						<tr>
							<td>Select Image</td>
							<td><input type="FILE" name="image"  accept="imageimage/png, image/jpeg, image/jpg" />
							<img src="<?php echo $userdetails['image']?>" height="40px" width="50px" />
						</td>
						</tr>
						<tr>
							<td colspan="2">
								<input type="submit" name="update" value="Update"/>
								<input type="reset"  value="Reset"/>
							</td>
						</tr>
					</table>
				</form>
				<ul><li><a href="skill.php">Add Skill</a></li></</ul>
				
			</div>
			<?php }?>
			<div class="back"> 
				<a href="index.php"><img src="img/back.png"></a>
			</div>
			<?php include_once "inc/footer2.php"?>
		</div>
	</body>
</html>

