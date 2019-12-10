<?php
session_start();
require_once "functions.php";
$loginregister = new LoginRegister();

$uid   = $_SESSION['uid'];
$uname = $_SESSION['uname'];
if(isset($_REQUEST ['id'])){
$id = $_REQUEST ['id'];
}else{
	header("location:index.php");
	exit();
}
if(!$loginregister->getSession()){
	header('location:login.php');
	exit();
}

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>All user Profile</title>
		<link rel="stylesheet" type="text/css" href="style2.css">
		<link rel="stylesheet" type="text/css" href="style1.css">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
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
			<p class="login_msg">
				
			</p>
			<h2 class='user'>Welcome <?php echo $uname; ?></h2>
			<p class="userlist">Profile of:<?php $loginregister->getUsername($id)?></p>

			</div>

		
			<?php 
			$getuser = $loginregister->getUserById($id);
			foreach($getuser as $value){	
			?>
			
				





		<div class="profile-card">
		<div class="image-container">
			<img src="<?php echo $value['image']?>" style="width: 100%">
			<div class="title">
				<h2><?php echo $value['username']?></h2>
			</div>
		</div>

		<div class="main-container">
			<P><i class="fa fa-briefcase info"></i><?php echo $value['occupation']?></P>
			<P><i class="fa fa-home info"></i><?php echo $value['website']?></P>
			<P><i class="fa fa-envelope info"></i><?php echo $value['email']?></P>
			<P><i class="fa fa-phone info"></i><?php echo $value['phone']?></P>
			<hr>
			<p><b><i class="fa fa-asterisk info"></i>Skills</b></p>
			
			<?php
				$allSkill = $loginregister->getALlSkill($value['id']);
				foreach ($allSkill as  $value) {?>
			<p><?php echo $value['name'];?></p>
			<div class="skill-bar">
				<div class="progress-bar" style="width:<?php echo $value['percentage'];?>%"><?php echo $value['percentage'];?>%</div>
			</div>
				<?php }?>		

		</div>

		<?php if($value['id'] == $uid){?>
				<tr>
					<td>Update Profile</td>
					<td><a href="updateprofile.php?id=<?php echo $value['id']?>">Edit profile</a></td>

				</tr>
				<?php }}?>
				
				<div></div>


			<div class="back"> 

				<a href="index.php"><img src="img/back.png"></a>
			</div>
			
			


			<?php include_once "inc/footer2.php"?>
		</div>
		
		</body>
</html>

