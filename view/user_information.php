<?php
include "../controller/fach_table_data.php";


$output = '<div class="container">
    <div class="row user_information_ajex">
        <div class="col-md-12 col-lg-12 col-12 ">
            <div class="url_section">
                <h2>users</h2>
                <a href="#">profile >></a>
                <a href="#">desbord >></a>
                <a href="#">users information >></a>
            </div>
            <div class="outhor_section">
                <a href="sign_up.php" class="add_users">add users</a>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-12">
            <div class ="user_table_section">
                <div class="users_info_section">
                    <div class="total_users">
                        <p class="total_usrs">total User : <span>'.$num_user.'</span></p>
                    </div>
                    <div class="get_massage"></div>
                    <div class="search_user">
                        <span>search :</span>
                        <input type="text" class="form-control" id="search" placeholder="Search" name="search_value" method="post">
                        
                    </div>
                </div>
                <div class="user_info_table">
                    <table class="user_table">
                        <tr>
                            <th>#</th>
                            <th>picture</th>
                            <th>user name</th>
                            <th>user email</th>
                            <th>user role</th>
                            <th>edit & delete</th>
                        </tr>';
                        if($num_user > 0){
                            $sirial_num = 1;
                            foreach($t_result as $row){
                                if($row['user_role'] == 1){
                                    $role = "admin";
                                }else{
                                    $role = "user";
                                }
                                if(empty($row['user_img'])){
                                    $img = "defult.jpg";
                                }else{
                                    $img = $row['user_img'];
                                }
                                
                                $output .= '    <tr>
                                
                                <td>'.$sirial_num.'</td>
                                <td><img src="../uplode/'.$img.'" alt="user img"></td>
                                <td>'.$row['user_name'].'</td>
                                <td>'.$row['user_email'].'</td>
                                <td>'.$role.'</td>
                                <td><button class="users_id users_id1" value = "'.$row["user_id"].'"><i class="fa fa-pen edit" ></i></button>&<button class="users_id users_id2" value = "'.$row["user_id"].'"><i class="fa fa-trash"></i></button></td>
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

                $(".users_id1").click(function() {
                    var user_id = $(this).val();
                    $.ajax({
                        url: "../controller/show_update_users.php",
                        method: "POST",
                        data: {
    
                            user_id: user_id
                        },
                        success: function(data) {
                            $(".user_information_ajex").html(data);
                        }
                    });
                });
                
                $(".users_id2").click(function() {
                    var user_id = $(this).val();
                    $.ajax({
                        url: "../controller/delete_users.php",
                        method: "POST",
                        data: {
    
                            user_id: user_id
                        },
                        success: function(data) {
                            $(".get_massage").html(data);
                        }
                    });
                });
               
            });
        </script>
            ';
echo $output;


?>


