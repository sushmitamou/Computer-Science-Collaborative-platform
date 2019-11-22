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
								<th width="5%">Category</th>
								<th width="10%">Post Title</th>
								<th width="30%">Description</th>
								<th width="10%">Image</th>
								<th width="15%">Author</th>
								<th width="10%">Tags</th>
								<th width="10%">Date</th>
								<th width="5%">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$query = "SELECT * FROM tbl_post ORDER BY id DESC ";
								$post = $db->select($query);
								if($post){
									$i=0;
									while($result = $post->fetch_assoc()){
									$i++;
							?>
								<tr class="odd gradeX">
									<td><?php echo $i; ?></td>
									<td><?php echo $result['cat'];?></td>	
									<td><a href="<?php echo $result['id']; ?>"><?php echo $result['title'];?></a></td>
									<td><?php echo $fm->textShorten($result['body'], 50); ?></td>
									<td><img src="<?php echo $result['image'];?>" height="40px" width="60px"></td>
									<td><?php echo $result['author'];?></td>	
									<td><?php echo $result['tags'];?></td>					
									<td><?php echo $fm->formatDate($result['date']); ?></td>
									<td>
										<a onclick="return confirm('Are you sure to approve !');" 
										href="approve2.php?approvepostid=<?php echo $result['id']; ?>">Approve</a>
									</td>
								</tr>
							<?php	} }?>
							
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
