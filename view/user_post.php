
<?php 
 session_start();
 include("../model/database.php");

 $obj = new database();

 $where1 = "books.user_id = {$_SESSION["user_id"]}";
 $order= "books.b_id";
 $join1 = null;
 $obj->select('books',"books.b_id,books.img_1,books.b_name,books.author,books.price",$join1,$where1,$order);

 $my_post = $obj->get_result();

 
 ?>
            <div class="profile-info profile_info_singel" id="my_post">
                    <div class="heading border-bottom pb-4">
                        <span class="heding-text">my post</span>
                    </div>
                    <div class="my_post_section">
                        <div class="row">
                        <?php foreach($my_post as $row){?>
                            <div class="col-md-4 col-4 col-lg-4">
                                <div class="my_singel_post" id="my_singel_post">
                                    <a href="singel_post.php?id=<?php echo $row['b_id']; ?>">
                                        <div class="my_singel_post_img">
                                            <img src="../uplode/<?php echo $row['img_1'] ;?>" alt="my post image">
                                        </div>
                                        <div class="my_post_details">
                                            <p class="my_book_name"><?php echo $row['b_name'] ;?></p>
                                            <p class = "my_book_writer_name">by : <a href="#"><?php echo $row['author'] ;?></a></p>
                                            <p class="my_book_price">tk. <span><?php echo $row['price'] ;?></span></p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        <?php } ?>    
                        </div>
                    </div>
                </div>