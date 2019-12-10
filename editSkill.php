
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
					<li><a href="home.php">Home</a></li>
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
            <?php
				if($_SERVER["REQUEST_METHOD"]=="POST"){
					$user_id = $_POST['user_id'];
					$name = $_POST['name'];
					$percentage = $_POST['percentage'];
					$skill_id = $_POST['id'];
					if(empty($user_id) or empty($name) or empty($percentage)){
						echo "<span style='color:#e53d37'>Field must not be empty</span>";
					}
					else{
						$add = $loginregister->updateSkill($user_id,$name,$percentage,$skill_id);
						if($add){
							echo "<span style='color:green'>Skill Added Successfully.</span>";
						}
					}

				}


                ?>	
                <?php 
                if(isset($_GET['id'])){
                   $skill_id =  $_GET['id'];
                }
				$result = $loginregister->getSkillDetails($skill_id);
				foreach($result as $skilldetails){
			?>
            <div class="login_reg">
				<form action="" method="post" name="reg" enctype="multipart/form-data">
					<table>
						<tr>
							<td>Name</td>
							<td><input type="text" name="name" placeholder="Enter skill Name" value="<?php echo $skilldetails['name'];?>"></td>
						</tr>
						<tr>
							<td>Percentage:</td>
							<td> <input type="number" name="percentage" placeholder="Enter Pecentage" value="<?php echo $skilldetails['percentage'];?>"></td>
						</tr>
                        <input type="hidden" name="user_id" value="<?php echo $uid;?>">
                        <input type="hidden" name="id" value="<?php echo $skilldetails['id'];?>">
						<tr>
							<td colspan="2">
								<input type="submit" name="update" value="Update Skill"/>
							</td>
						</tr>
					</table>
				</form>
            </div>
            <?php } ?>
        

        <p class="user">Skill List</p>
			<table class="style_table" style="text-align:center">
				<tr>
					<th>Serial</th>
					<th>Name</th>
					<th>Percentage</th>
					<th>Action</th>
				</tr>
				<?php 
				$i = 0;
					$allSkill = $loginregister->getALlSkill();
					foreach ($allSkill as  $value) {
						$i++;
					
		    		?>
				<tr>
					<td><?php echo $i;?></td>
					<td><?php echo $value['name'];?></td>
					<td><?php echo $value['percentage']."%"; ?></td>
					<td>
					
                    <?php if($value['user_id'] == $uid){?>
                        <a href="editSkill.php?id=<?php echo $value['id'];?>">Edit </a>
						<a href="delete.php?skill_id=<?php echo $value['id']?>">| Delete</a>
						<?php } ?>
					</td>
				</tr>
				<?php }?>
			</table>
			<?php include_once "inc/footer2.php"?>
		</div>
	</body>
</html>

