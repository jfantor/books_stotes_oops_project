
<?php
// include "../controller/fach_table_data.php";
include "../model/database.php";
$obj = new database();
$col_name = ("university.uni_id,university.uni_name,category.cat_name,university.nop,university.cat_id");
$join = ("JOIN category ON university.cat_id = category.cat_id");
$obj->select("university",$col_name,$join);
$cat_info = $obj->get_result();
$num_cat = COUNT($cat_info);



$output = '<div class="container">
    <div class="row user_information_ajex">
        <div class="col-md-12 col-lg-12 col-12 ">
            <div class="url_section">
                <h2>university</h2>
                <a href="#">profile >></a>
                <a href="#">desbord >></a>
                <a href="#">university</a>
            </div>
            <div class="outhor_section">
                <a href="#" class="add_users add_cetagory" >add university</a>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-12">
            <div class ="user_table_section">
                <div class="users_info_section">
                    <div class="total_users">
                        <p class="total_usrs">total university : <span>'.$num_cat.'</span></p>
                    </div>
                    <div class="get_massage"></div>
                    <div class="search_user">
                        <span>search :</span>
                        <input type="text" class="form-control" id="search" placeholder="Search" name="search_value" method="post">
                        
                    </div>
                    <div class="get_alert"></div>
                </div>
                <div class="user_info_table">
                    <table class="user_table" id="uni_table">
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
                                <td>'.$row['uni_name'].'</td>
                                <td>'.$row['cat_name'].'</td>
                                <td>'.$row['nop'].'</td>
                                <td><button class="users_id uni_id" value = "'.$row["uni_id"].'"><i class="fa fa-pen edit" ></i></button>&<button class="users_id post_id1" value = "'.$row["uni_id"].'"><i class="fa fa-trash"></i></button></td>
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

                $(".uni_id").click(function() {
                    var uni_id = $(this).val();
                    var ceta_id2 = $("#dsjfojforeo").val();
                    console.log(ceta_id2);
                    $.ajax({
                        url: "../view/show_update_university.php",
                        method: "POST",
                        data: {
    
                            uni_id: uni_id,
                            ceta_id:ceta_id2
                        },
                        success: function(data) {
                            $(".user_information_ajex").html(data);
                        }
                    });
                });
                
                $(".post_id1").click(function() {
                    var uni_id = $(this).val();
                    var cat_conferm = "conferm";
                    $.ajax({
                        url: "../controller/update_insert_delet_university.php",
                        method: "POST",
                        data: {
                            uni_conferm:cat_conferm,
                            uni_id: uni_id
                        },
                        success: function(data) {
                            $(".get_massage").html(data);
                        }
                    });
                });
                $(".add_cetagory").click(function() {
                    var add_uni = "conferm";
                    $.ajax({
                        url: "../controller/update_insert_delet_university.php",
                        method: "POST",
                        data: {
                            uni_insert:add_uni
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


