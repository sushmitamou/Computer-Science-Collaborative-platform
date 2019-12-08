<div class="grid_2">
            <div class="box sidemenu">
                <div class="block" id="section-menu">
                    <ul class="section menu">
                       <li><a class="menuitem">Site Option</a>
                            <ul class="submenu">
                                <li><a href="titleslogan.php">Title & Slogan</a></li>
                                <li><a href="social.php">Social Media</a></li>
                                <li><a href="copyright.php">Copyright</a></li>
                                
                            </ul>
                        </li>
						
                         <li><a class="menuitem">Update Pages</a>
                            <ul class="submenu">
                                <li><a>About Us</a></li>
                                <li><a>Contact Us</a></li>
                            </ul>
                        </li>
                        <li><a class="menuitem">Category Option</a>
                            <ul class="submenu">
                                <li><a href="addcat.php">Add Category</a> </li>
                                <li><a href="catlist.php">Category List</a> </li>
                            </ul>
                        </li>
                        <li><a class="menuitem">Career Development</a>
                            <ul class="submenu">
                                <li><a href="addpost.php">Add Card</a> </li>
                                <li><a href="postlist.php">Card list for Career</a> </li>
                            </ul>
                        </li>
                        <li><a class="menuitem">Pending Posts</a>
                            <ul class="submenu">
                                <li><a href="pending-post.php">Pending Items For Blog
                                <?php 
                                    $query = "select * from tbl_blogpage where active='0' order by id desc";
                                    $msg = $db->select($query);
                                    if($msg){
                                        $count = mysqli_num_rows($msg);
                                        echo "(".$count.")";
                                    }
                                    else{
                                        echo "(0)";
                                    }
                                ?>
                                </a> </li>
                                <li><a href="pending-post2.php">Pending Items For Post</a> </li>
                                <li><a href="pending-post3.php">Pending Items For Alumni</a> </li>
                                
                            </ul>
                        </li>

                    </ul>
                </div>
            </div>
        </div>