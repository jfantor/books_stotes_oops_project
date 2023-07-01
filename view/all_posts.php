<?php
// include "../controller/fach_table_data.php";
include "../model/database.php";
$obj = new database();

$col_name = "books.b_id,books.b_name,books.img_1,books.author,user.user_name";

$order = "books.user_id DESC";
$join = "JOIN user ON books.user_id = user.user_id ";
$obj->select("books",$col_name,$join,null,$order);
$t_result = $obj->get_result();

$num_user = COUNT($t_result);



$output = '<div class="container">
    <div class="row user_information_ajex">
        <div class="col-md-12 col-lg-12 col-12 ">
            <div class="url_section">
                <h2>posts</h2>
                <a href="#">profile >></a>
                <a href="#">desbord >></a>
                <a href="#">posts</a>
            </div>
            <div class="outhor_section">
                <a href="#" class="add_users">add post</a>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-12">
            <div class ="user_table_section">
                <div class="users_info_section">
                    <div class="total_users">
                        <p class="total_usrs">total post : <span>'.$num_user.'</span></p>
                    </div>
                    <div class="get_massage"></div>
                    <div class="search_user">
                        <span>search :</span>
                        <input type="text" class="form-control" id="search" placeholder="Search" name="search_value" method="post">
                        
                    </div>
                    <div class="get_alert"></div>
                </div>
                <div class="user_info_table">
                    <table class="user_table" id="post_table">
                        <tr>
                            <th>#</th>
                            <th>picture</th>
                            <th>books name</th>
                            <th>author</th>
                            <th>user name</th>
                            <th>edit & delete</th>
                        </tr>';
                        if($num_user > 0){
                            $sirial_num = 1;
                            foreach($t_result as $row){
                                if(empty($row['img_1'])){
                                    $img = "defult.jpg";
                                }else{
                                    $img = $row['img_1'];
                                }
                                
                                $output .= '    <tr>
                                
                                <td>'.$sirial_num.'</td>
                                <td><img src="../uplode/'.$img.'" alt="user img"></td>
                                <td>'.$row['b_name'].'</td>
                                <td>'.$row['author'].'</td>
                                <td>'.$row['user_name'].'</td>
                                <td><button class="users_id post_id" value = "'.$row["b_id"].'"><i class="fa fa-pen edit" ></i></button>&<button class="users_id post_id1" value = "'.$row["b_id"].'"><i class="fa fa-trash"></i></button></td>
                            </tr>';
                           $sirial_num ++;
                            } 
                        }
                        
                    
                        

$output .= '</table>
            </div>
            </div>
            </div>
            </div>
            </div>
            <script>
            $(document).ready(function() {

                $(".post_id").click(function() {
                    var post_id = $(this).val();
                    $.ajax({
                        url: "../view/show_update_post.php",
                        method: "POST",
                        data: {
    
                            post_id: post_id
                        },
                        success: function(data) {
                            $(".user_information_ajex").html(data);
                        }
                    });
                });
                
                $(".post_id1").click(function() {
                    var user_id = $(this).val();
                    $.ajax({
                        url: "../controller/delete_post.php",
                        method: "POST",
                        data: {
    
                            post_id: user_id
                        },
                        success: function(data) {
                            $(".get_alert").html(data);
                        }
                    });
                });
               
            });
        </script>
            ';
echo $output;


?>


