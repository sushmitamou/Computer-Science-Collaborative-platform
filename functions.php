
<?php
require "config2.php";
class LoginRegister{
	public function __construct(){
		$database = new DatabaseConnection();
	}
	public function updateSkill($user_id,$name,$percentage,$skill_id){
		global $pdo;
			$query = $pdo->prepare("UPDATE tbl_skill SET user_id=?, name=?, percentage=? WHERE id=?");
			$query->execute(array($user_id,$name,$percentage,$skill_id));
			return true;
	}
	public function getSkillDetails($skill_id){
		global $pdo;
		$query = $pdo->prepare("SELECT * FROM tbl_skill WHERE id=? ");
		$query->execute(array($skill_id));
		return $query->fetchALL(PDO::FETCH_ASSOC);
	}
	public function addSkill($user_id,$name,$percentage){
		global $pdo;
		$query = $pdo->prepare("INSERT INTO tbl_skill(user_id,name,percentage) VALUES(?,?,?)");
			$query->execute(array($user_id,$name,$percentage));
			return true; 
	}
	public function deleteUserSkill($id){
		global $pdo;
		$query = $pdo->prepare("DELETE  FROM tbl_skill WHERE id=?");
		$query->execute(array($id));
		return $query->fetchALL(PDO::FETCH_ASSOC);
	}
	public function getALlSkill($user_id){
		global $pdo;
		$query = $pdo->prepare("SELECT * FROM tbl_skill WHERE user_id = ?");
		$query->execute(array($user_id));
		return $query->fetchALL(PDO::FETCH_ASSOC);
	}
	public function  searchUser($keyword){
		global $pdo;

		$query = "SELECT * FROM users WHERE occupation LIKE ?";
			$params = array("%$keyword%");
			$stmt = $pdo->prepare($query);
			$stmt->execute($params);
			return $results = $stmt->fetchALL(PDO::FETCH_ASSOC);	

	}
	public function registerUser($username,$password,$email,$name,$std_id){
		global $pdo;

		$query = $pdo->prepare("SELECT id FROM users WHERE username = ? OR email =? OR std_id =?");
		$query->execute(array($username,$email,$std_id));
		$num = $query->rowCount();

		$query = $pdo->prepare("SELECT std_id FROM tbl_student_id WHERE std_id = ?");
		$query->execute(array($std_id));
		$row = $query->rowCount();

		if($num != 1 and $row>=1){
			$query = $pdo->prepare("INSERT INTO users(username,password,email,name,std_id) VALUES(?,?,?,?,?)");
			$query->execute(array($username,$password,$email,$name,$std_id));
			return print "<span style='color:green'>Registration successfully compleated</span>";
			return true; 
		}elseif($row!=1){
			return print "<span style='color:#e53d37'>Student Id not listed.</span>";
		}else{
			return print "<span style='color:#e53d37'>Username/Email/Student ID already used.</span>";
		}
	}
	public function loginUser($email,$password){
		global $pdo;
		$query = $pdo->prepare("SELECT id,username FROM users WHERE email = ? AND password = ?");
		$query->execute(array($email,$password));
		$userdata = $query->fetch();

		$num = $query->rowCount();
		if($num==1){
			session_start();
			$_SESSION['login'] = true;
			$_SESSION['uid'] = $userdata['id'];
			$_SESSION['uname'] = $userdata['username'];
			$_SESSION['login_msg'] = 'Login Successfully...';
			return true;
		}
		else{
			return false;
		}

	}

	


	public function getAllusers(){
		global $pdo;
		$query = $pdo->prepare("SELECT * FROM users ORDER BY id DESC");
		$query->execute();
		return $query->fetchALL(PDO::FETCH_ASSOC);

	}
	public function getSession(){
			return @$_SESSION['login'];
		}
		public function getUsername($id){
			global $pdo;
			$query = $pdo->prepare("SELECT name FROM users WHERE id=?");
			$query->execute(array($id));
			$result = $query->fetch();
			echo $result['name'];
		}
		public function getUserById($id){
			global $pdo;
			$query = $pdo->prepare("SELECT * FROM users WHERE id=?");
			$query->execute(array($id));
			return $result = $query->fetchALL(PDO::FETCH_ASSOC);
		}
		public function updateUser($uid,$username,$name,$email,$website,$occupation,$phone,$image,$std_id){
			global $pdo;
			$query = $pdo->prepare("UPDATE users SET username=?, name=?, email=?, website=?,occupation=?, phone=?,image=?,std_id=? WHERE id=?");
			$query->execute(array($username,$name,$email,$website,$occupation,$phone,$image,$std_id,$uid));
			return true;
		}
		public function getUserDetails($uid){
			global $pdo;
			$query = $pdo->prepare("SELECT * FROM users WHERE id=?");
			$query->execute(array($uid));
			return $query->fetchALL(PDO::FETCH_ASSOC);
		}
		public function updatePassword($uid,$old_pass,$new_pass,$confirm_new){
			global $pdo;
			$query = $pdo->prepare("SELECT id FROM users WHERE password = ?");
			$query->execute(array($old_pass));
			$num = $query->rowCount();

			if($num!=1){
				return print("<span style='color:#e53d37'>Old password not exist</span>");
			}else{
				$query = $pdo->prepare("UPDATE users SET password=? WHERE id=?");
				$query->execute(array($new_pass,$uid));
				return print("<span style='color:green'>Password Changed Successfully</span>");
			}
		}

			public function ForgetPassword($email,$new_pass,$confirm_new){
			global $pdo;
			$query = $pdo->prepare("SELECT * FROM users WHERE email = ?");
			$query->execute(array($email));
			$num = $query->rowCount();

			if($num!=1){
				return print("<span style='color:#e53d37'>Email ID not exist</span>");
			}else{
				$query = $pdo->prepare("UPDATE users SET password=? WHERE email=?");
				$query->execute(array($new_pass,$email));
				return print("<span style='color:green'>Password Changed Successfully</span>");
			}
		}

		public function logoutUser(){
			$_SESSION['login'] = false;
			unset($_SESSION['uid']);
			unset($_SESSION['uname']);
			session_destroy();

}
}
