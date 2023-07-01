
<?php
// include "../controller/fach_table_data.php";
include "../model/database.php";
$obj = new database();

$obj->select("category","*");
$cat_info = $obj->get_result();
$num_cat = COUNT($cat_info);



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
                <a href="#" class="add_users add_cetagory" >add cetagory</a>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-12">
            <div class ="user_table_section">
                <div class="users_info_section">
                    <div class="total_users">
                        <p class="total_usrs">total cetagory : <span>'.$num_cat.'</span></p>
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
                            <th>cetagory name</th>
                            <th>number or versity</th>
                            <th>numver of post</th>
                            <th>edit & delete</th>
                        </tr>';
                        if($num_cat > 0){
                            $sirial_num = 1;
                            foreach($cat_info as $row){
                                
                                $output .= '    <tr>
                                
                                <td>'.$sirial_num.'</td>
                                <td>'.$row['cat_name'].'</td>
                                <td>'.$row['nov'].'</td>
                                <td>'.$row['nop'].'</td>
                                <td><button class="users_id post_id4" value = "'.$row["cat_id"].'"><i class="fa fa-pen edit" ></i></button>&<button class="users_id post_id1" value = "'.$row["cat_id"].'"><i class="fa fa-trash"></i></button></td>
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

                $(".post_id4").click(function() {
                    var post_id = $(this).val();
                    $.ajax({
                        url: "../view/show_update_cat.php",
                        method: "POST",
                        data: {
    
                            cat_id: post_id
                        },
                        success: function(data) {
                            $(".user_information_ajex").html(data);
                        }
                    });
                });
                
                $(".post_id1").click(function() {
                    var post_id = $(this).val();
                    var cat_conferm = "conferm";
                    $.ajax({
                        url: "../controller/update_insert_delet_cat.php",
                        method: "POST",
                        data: {
                            cat_conferm:cat_conferm,
                            cat_id: post_id
                        },
                        success: function(data) {
                            $(".get_massage").html(data);
                        }
                    });
                });
                $(".add_cetagory").click(function() {
                    var cat_conferm = "conferm";
                    $.ajax({
                        url: "../controller/update_insert_delet_cat.php",
                        method: "POST",
                        data: {
                            cat_insert:cat_conferm
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


