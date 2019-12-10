
<?php
session_start();
require_once "functions.php";
$loginregister = new LoginRegister();

$uid   = $_SESSION['uid'];
$uname = $_SESSION['uname'];
if(!$loginregister->getSession()){
	header('location:login.php');
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
					<li><a href="index2.php">Home</a></li>
					<li><a href="index.php">User List</a></li>
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
				<?php
					if(isset($_SESSION['login_msg'])){
						echo $_SESSION['login_msg'];
						unset($_SESSION['login_msg']);
					}
				?>
			</p>
			<h2 class='user'>Welcome <?php echo $uname; ?></h2>
			<p class="userlist">All User List.</p>
			<div class="search" style="margin-left: 386px;
    margin-bottom: 20px;">
		   <?php
				
				if(isset($_GET['search'])){
					$search = $_GET['search'];
					
					if(empty($search)){
						echo "<span style='color:#e53d37'>Field must not be empty</span>";
					}
					else{
						$register = $loginregister->searchUser($search);
						
					}
				
				}
					


				?>
				<form action="search2.php" method="get">
				<input type="text" name="search" placeholder="Please enter occopation">
				<button type="submit">Search</button>

			</form>
			</div>
			<table class="style_table">
				<tr>
					<th>Serial</th>
					<th>Name</th>
					<th>Profile</th>
				</tr>
				<?php 
				$i = 0;
					$alluser = $loginregister->getAllusers();
					foreach ($alluser as  $value) {
						$i++;
					
				?>
				<tr>
					<td><?php echo $i;?></td>
					<td><?php echo $value['name'];?></td>
					<td>
						<a href="userprofile.php?id=<?php echo $value['id'];?>">View </a>
						<?php if($value['id'] == $uid){?>
						<a href="updateprofile.php?id=<?php echo $value['id']?>">| Edit</a>
						<?php } ?>
					</td>
				</tr>
				<?php }?>
			</table>
			<?php include_once "inc/footer2.php"?>
		</div>
	</body>
</html>

