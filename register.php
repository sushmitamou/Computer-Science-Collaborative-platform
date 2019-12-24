<?php 
	include 'lib/Session.php';
	Session::checkLogin();

?>

<?php include 'config/config.php';?>
<?php include 'lib/database.php';?>
<?php include 'helpers/Format.php';?>


<?php
	$db = new Database();
	$fm = new Format();

?>
    <div class="grid_10">
		
        <div class="box round first grid">

        <div class="regi-form">
            <h2>Registration</h2>
            <div class="block copyblock"> 

            <?php
                if ($_SERVER['REQUEST_METHOD'] == 'POST')
                {
                    $user_id  = $fm->validation($_POST['user_id']);
                    $name     = $fm->validation($_POST['name']);
                    $password = $fm->validation(md5($_POST['password']));
                    $email    = $fm->validation($_POST['email']);
                    $role     = $fm->validation($_POST['role']);

                    $user_id  = mysqli_real_escape_string($db->link, $user_id);
                    $name 	  = mysqli_real_escape_string($db->link, $name);
                    $password = mysqli_real_escape_string($db->link, $password);
                    $email    = mysqli_real_escape_string($db->link, $email);
                    $role     = mysqli_real_escape_string($db->link, $role);

                    if (empty($user_id) || empty($name) || empty($password) || empty($role) || empty($email)) {
                        echo "<span class= 'error'>Field must not be empty !</span>";
                    }
                    else 
                    {

                        $mailquery = "select * from normal_user where email = '$email' limit 1";
                        $mailcheck= $db->select($mailquery);
                        if($mailcheck != false)
                        {
                            echo "<span class= 'error'>Email Already exist!</span>";
                        }
                        else
                        {
                            $query = "INSERT INTO normal_user(user_id, name, password, email, role) 
                            VALUES('$user_id', '$name', '$password', '$email', '$role')";
                            $catinsert = $db->insert($query);
                            if ($catinsert){
                                echo "<span class= 'success'>User Created successfully !</span>";
                            }
                            else{
                                echo "<span class= 'error'>User not Created !</span>";
                            }
                        }
                    }
                }    
            ?>
                 <form action="" method="post">
                    <table class="form">

                        <tr>
                            <td>
                                <label>User Id</label>
                            </td>
                            <td>
                                <input type="text" name="user_id" placeholder="Enter Name ..." class="medium" />
                            </td>
                        </tr>   					
                        <tr>
                            <td>
                                <label>Name</label>
                            </td>
                            <td>
                                <input type="text" name="name" placeholder="Enter Name ..." class="medium" />
                            </td>
                        </tr>
						<tr> 
                        <tr>
                            <td>
                                <label>Password</label>
                            </td>
                            <td>
                                <input type="text" name="password" placeholder="Enter Password..." 
                                class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Email</label>
                            </td>
                            <td>
                                <input type="text" name="email" placeholder="Enter Valid Email Address..." 
                                class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>User Role</label>
                            </td>
                            <td>
                                <select id="select" name="role">
                                    <option>Select User Role</option>
                                    <option value="1">Teacher</option>
                                    <option value="2">Alumni</option>
                                    <option value="3">Student</option>
                                </select>    
                            </td>
                        </tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Submit" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
                </div>
            </div>
        </div>
        
