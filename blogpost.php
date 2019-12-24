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
	<?php include "inc/sidebar.php";?>
		<div class="maincontent clear">
			<div class="about">

			<?php
				$query = "select * from tbl_blogpage where id=$id";
				$post= $db->select($query);
			    if($post){
			    while ($result = $post->fetch_assoc()){
			?>

				<h2><?php echo $result['title']; ?></h2>
				<img src="<?php echo $result['image']; ?>" alt="post image"/>
				<?php echo $result['body']; ?>


				<!-- Comment -->
	<div id="disqus_thread"></div>
	<script>

/**
*  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
*  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/
/*
var disqus_config = function () {
this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
};
*/
(function() { // DON'T EDIT BELOW THIS LINE
var d = document, s = d.createElement('script');
s.src = 'https://mouli.disqus.com/embed.js';
s.setAttribute('data-timestamp', +new Date());
(d.head || d.body).appendChild(s);
})();
</script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
<!-- Comment -->
			

				<!--
				<div class="relatedpost clear">
					<h2>Related articles</h2>

					

					<a href="blogpost.php?id=<?php echo $result['id']; ?>">
						<img src="admin/post1.jpg" alt="post image"/>
					</a>
					<?php }} else{echo "No related post available !! "; }?>	
				</div>
				-->
				
	        </div>
		</div>
		
		<?php include "inc/footer.php"; ?>