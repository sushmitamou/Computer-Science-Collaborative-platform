
<?php include 'inc/header.php';?>


<div class="container">
        <div class="panel panel-default">
            <div class="panel-heading" >
                <h2 style="color:black;">Career Development</h2>

            </div>

            <div class="panel-body">
		
		
            <?php	
                $query = "select * from tbl_careerpage";
                $post= $db->select($query);
                if($post){
                while ($result = $post->fetch_assoc()){
            ?>
            
                <div class="row" style="float:left;">
                    <div class="col-4-lg ml-3" style="float:left;">

                        <div class="card" style="width:21rem; margin-left:25px; float:left;">
                            <h2><?php $i; ?></h2>
                               <img class= "card-img" src="admin/<?php echo $result['image']; ?>"/> 
                                <div class="card-body">
                                    <h4 class="card-title"><?php echo $result['title']; ?> </h4>
                                    <p class="card-text">
                                        <?php
                                            if(strlen($result['body']) > 200) {
                                                echo substr($result['body'], 0, 100)." ..."; 
                                            }  else {
                                                echo $result['body'];
                                            }
                                        ?> 
                                    </p>
                                    <a href="<?php echo "post.php?id=". $result['id']; ?>"
                                    class="btn btn-primary" style="float:right;">Read more</a>
                                </div>
                        </div>
                    </div>    
                </div>

           
            <?php } ?>    
    </div>


            
 <!-- end while loop -->

<!--pagination-->

        <?php } else { header("Location:404.php");} ?>	
</div>
 

		<?php include "inc/footer.php"; ?>