<?php include "inc/header.php";?>


<div class="contentsection contemplete clear">

		<div class="maincontent clear">
		<!--pagination-->
		<?php
			$per_page = 3;
			if (isset($_GET["page"])){
				$page = $_GET["page"];
			}

			else{
				$page=1;
			}
			$start_from = ($page-1)*$per_page;
		?>
		<!--pagination-->
		<?php	
			$query = "select * from alumnus_feedback where active=1 order by id desc limit $start_from, $per_page";
			$post= $db->select($query);
			if($post){
			while ($result = $post->fetch_assoc()){
		?>

			<div class="samepost clear">
				<a href="#"><img src="<?php echo $result['image']; ?>" alt="post image"/></a>

				<h4><?php echo $fm->formatDate($result['date']);?>, By <a href="#"><?php echo $result['author'];?></a></h4>

					<?php echo $fm->textShorten($result['body']); ?>

				<div class="readmore clear">
					<a href="blogpost.php?id=<?php echo $result['id']; ?>">Read More</a>
				</div>
			</div>
	
<?php } ?> <!-- end while loop -->

<!--pagination-->
<?php 
	$query = "select * from alumnus_feedback";
	$result = $db->select($query);
	$total_rows = mysqli_num_rows($result);
	$total_pages = ceil($total_rows/$per_page);			

	echo "<span class='pagination'><a href='alumnus-feedback.php?page=1'>".'First Page'."</a>"; 

	for($i=1; $i<=$total_pages; $i++){
		echo "<a href='alumnus-feedback.php?page=".$i."'>$i</a>";
	}

	echo "<a href='alumnus-feedback.php?page=$total_pages'>".'Last Page'."</a></span>"
?>
<!--pagination-->
        <?php } else { header("Location:404.php");} ?>	
		</div>

		
		
		<?php include "inc/footer.php"; ?>
