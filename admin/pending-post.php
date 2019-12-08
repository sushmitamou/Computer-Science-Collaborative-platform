<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Post List</h2>
                <div class="block">  
                    <table class="data display datatable" id="example">
						<thead>
							<tr>
								<th width="5%">No</th>
								<th width="15%">Post Title</th>
								<th width="40%">Description</th>
								<th width="10%">Image</th>
								<th width="10%">Author</th>
								<th width="10%">Date</th>
								<th width="10%">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$query = "SELECT * FROM tbl_blogpage where active='0' ORDER BY id DESC ";
								$post = $db->select($query);
								if($post){
									$i=0;
									while($result = $post->fetch_assoc()){
									$i++;
							?>
								<tr class="odd gradeX">
									<td><?php echo $i; ?></td>
									<td><a href="editpost.php?editpostid=<?php echo $result['id']; ?>"><?php echo $result['title'];?></a></td>
									<td><?php echo $fm->textShorten($result['body'], 50); ?></td>
									<td><img src="<?php echo $result['image'];?>" height="40px" width="60px"></td>
									<td><?php echo $result['author'];?></td>					
									<td><?php echo $fm->formatDate($result['date']); ?></td>
									<td>
									<a onclick="return confirm('Are you sure to approve !');" 
							         href="approve.php?approvepostid=<?php echo $result['id']; ?>">Approve</a>
								</tr>
							<?php	} }?>
							
						</tbody>
					</table>
				</div>
            </div>

			<div class="box round first grid">
                <h2>Seen Post</h2>
				<?php
					if(isset($_GET['delid'])){
						$delid = $_GET['delid'];
						$delquery = "delete from tbl_blogpage where id = '$delid'";
						$deldata = $db->delete($delquery);
						if ($deldata){
							echo "<span class= 'success'>Message deleted successfully !</span>";
						}
						else{
							echo "<span class= 'error'>Message not deleted !</span>";
						}
					}
				?>
            	<div class="block">        
				<table class="data display datatable" id="example">
					<thead>
					<tr>
						<th width="5%">No</th>
						<th width="15%">Post Title</th>
						<th width="40%">Description</th>
						<th width="10%">Image</th>
						<th width="10%">Author</th>
						<th width="10%">Date</th>
						<th width="10%">Action</th>
					</tr>
					</thead>
					<tbody>
						<?php
							$query = "select * from tbl_blogpage where active='1' order by id desc";
							$msg = $db->select($query);
							if($msg){
								$i = 0;
								while($result = $msg->fetch_assoc()){
								$i++;
						?>
						<tr class="odd gradeX">
									<td><?php echo $i; ?></td>
									<td><a href="editpost.php?editpostid=<?php echo $result['id']; ?>"><?php echo $result['title'];?></a></td>
									<td><?php echo $fm->textShorten($result['body'], 50); ?></td>
									<td><img src="<?php echo $result['image'];?>" height="40px" width="60px"></td>
									<td><?php echo $result['author'];?></td>					
									<td><?php echo $fm->formatDate($result['date']); ?></td>
							<td>
							    <a href="viewmsg.php?msgid=<?php echo $result['id']; ?>">View</a> 
								||
								<a onclick="return confirm('Are yiu sure to delete !');" 
								href="?delid=<?php echo $result['id']; ?>">Delete</a>
							</td>
						</tr>
						<?php }}?>
					</tbody>
				</table>
               </div>
            </div>

        </div>

	<script type="text/javascript">
        $(document).ready(function () {
            setupLeftMenu();
            $('.datatable').dataTable();
			setSidebarHeight();
        });
    </script>
   <?php include 'inc/footer.php'; ?>
