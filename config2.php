<?php
class DatabaseConnection{
	public function __construct(){
		global $pdo;
		try{
			$pdo = new PDO("mysql:host=localhost;dbname=final_year_project","root","");
		}catch(PDOException $e){
			exit("Database Error");
		}
	}
	

}

?>