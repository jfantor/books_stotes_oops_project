
<?php
// include "../controller/fach_table_data.php";
include "../model/database.php";
$obj = new database();

$obj->select("subject","*");
$sub_info = $obj->get_result();
$num_dep = COUNT($sub_info );



$output = '<div class="container">
    <div class="row user_information_ajex">
        <div class="col-md-12 col-lg-12 col-12 ">
            <div class="url_section">
                <h2>subject</h2>
                <a href="#">profile >></a>
                <a href="#">desbord >></a>
                <a href="#">subject</a>
            </div>
            <div class="outhor_section">
                <a href="#" class="add_users add_subject" >add subject</a>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-12">
            <div class ="user_table_section">
                <div class="users_info_section">
                    <div class="total_users">
                        <p class="total_usrs">total subject : <span>'.$num_dep.'</span></p>
                    </div>
                    <div class="get_massage"></div>
                    <div class="search_user">
                        <span>search :</span>
                        <input type="text" class="form-control" id="search" placeholder="Search" name="search_value" method="post">
                        
                    </div>
                    <div class="get_alert"></div>
                </div>
                <div class="user_info_table">
                    <table class="user_table" id="cat_table">
                        <tr>
                            <th>#</th>
                            <th>subject name</th>
                            <th>numver of post</th>
                            <th>edit & delete</th>
                        </tr>';
                        if($num_dep > 0){
                            $sirial_num = 1;
                            foreach($sub_info as $row){
                                
                                $output .= '    <tr>
                                
                                <td>'.$sirial_num.'</td>
                                <td>'.$row['sub_name'].'</td>
                                <td>'.$row['nop'].'</td>
                                <td><button class="users_id edit_sub" value = "'.$row["sub_id"].'"><i class="fa fa-pen edit" ></i></button>&<button class="users_id delete_sub" value = "'.$row["sub_id"].'"><i class="fa fa-trash"></i></button></td>
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

                $(".edit_sub").click(function() {
                    var sub_id = $(this).val();
                    var update = "update";
                    $.ajax({
                        url: "../controller/update_insert_delet_sub.php",
                        method: "POST",
                        data: {
    
                            sub_id: sub_id,
                            update:update
                        },
                        success: function(data) {
                            $(".user_information_ajex").html(data);
                        }
                    });
                });
                
                $(".delete_sub").click(function() {
                    var d_sub_id = $(this).val();
                    var sub_conferm = "conferm";
                    $.ajax({
                        url: "../controller/update_insert_delet_sub.php",
                        method: "POST",
                        data: {
                            sub_conferm:sub_conferm,
                            d_sub_id: d_sub_id
                        },
                        success: function(data) {
                            $(".get_massage").html(data);
                        }
                    });
                });
                $(".add_subject").click(function() {
                    var sub_conferm = "conferm";
                    $.ajax({
                        url: "../controller/update_insert_delet_sub.php",
                        method: "POST",
                        data: {
                            sub_insert:sub_conferm
                        },
                        success: function(data) {
                            $(".user_information_ajex").html(data);
                        }
                    });
                });
               
            });
        </script>
            ';
echo $output;


?>


