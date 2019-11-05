<?php include "inc/header.php";?>

<?php 
	if(!isset($_GET['id']) || $_GET['id'] == NULL){
		header("Location: 404.php");
	}
	else{
		$id = $_GET['id'];
	}
?>

	<div class="contentsection contemplete clear">
	<?php include "inc/sidebar.php"; ?>
		<div class="maincontent clear">
			<div class="about">

				<?php
					$query = "select * from tbl_careerpage where id=$id";
					$post= $db->select($query);
					if($post){
					while ($result = $post->fetch_assoc()){
				?>

					<h2><?php echo $result['title']; ?></h2>
					<img src="admin/<?php echo $result['image']; ?>" alt="post image"/>
					<?php echo $result['body']; ?>
				<?php } }?>
				
	        </div>
		</div>

		
		
		<?php include "inc/footer.php"; ?>