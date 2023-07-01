<?php
include ("../model/database.php");
$obj = new database();
session_start();
if(isset($_POST['user_id'])){
    $user_id= $_POST['user_id'];
    $obj->select("books","*",null,"user_id= $user_id");
    $users_post = $obj->get_result();
    // $post_info = $users_post[0];
    // print_r ($post_info);
    $num_post = COUNT($users_post);

    if($num_post == 0){
        echo '   <div class="confermation">
        <p>do you want to delet this post . </p>
        <input type="hidden" name="user_id" class ="user_id_valu" value = "'.$user_id.'">
        <button class="delet_con">ok</button>
        <i class="fa fa-times close close_user" aria-hidden="true"></i>
        </div>
        <script>
            $(document).ready(function() {

                $(".delet_con").click(function() {
                    var user_id = $(".user_id_valu").val();
                    $.ajax({
                        url: "../controller/delete_users.php",
                        method: "POST",
                        data: {
                            user_id1:user_id
                        },
                        success: function(data) {
                            $(".get_massage").html(data);
                        }
                    });
                });
                $(".close").click(function() {
                    $(".confermation").hide(); 
                });
            
            });
        </script>';
    }else{
            echo '   <div class="confermation">
            <p>all '.$num_post.' posts of this user must be deleted </p>
            <input type="hidden" name="user_id" class ="user_id_valu" value = "'.$user_id.'">
            <button class="delet_con">ok</button>
            <i class="fa fa-times close close_user" aria-hidden="true"></i>
            </div>
            <script>
                $(document).ready(function() {

                    $(".delet_con").click(function() {
                        var user_id = $(".user_id_valu").val();
                        $.ajax({
                            url: "../controller/delete_users.php",
                            method: "POST",
                            data: {
                                user_id1:user_id
                            },
                            success: function(data) {
                                $(".get_massage").html(data);
                            }
                        });
                    });
                    $(".close").click(function() {
                        $(".confermation").hide(); 
                    });
                
                });
            </script>';
    }


  


}
if(isset($_POST['user_id1'])){
    $user_id1 =  $_POST['user_id1'];
    $obj->select("books","*",null,"user_id= $user_id1");
    $users_post = $obj->get_result();
    // $post_info = $users_post[0];
    // echo "<pre>";
    // print_r ($users_post);
    // echo "</pre>";

    $num_post = COUNT($users_post);


    if($_SESSION["user_id"] != $user_id1){
        if($obj->delete("books","user_id= $user_id1")){
            if($obj->delete("user","user_id= $user_id1")){
                $uni_array = array();
                $sub_array = array();
                $dep_array = array();
                $cat_array = array();
            

                
                foreach($users_post as $row){
                    array_push($uni_array,$row['uni_id']);
                    array_push($sub_array,$row['sub_id']);
                    array_push($dep_array,$row['department']);
                    array_push($cat_array,$row['cat_id']);

                    
                }

                $count_valu_uni = array_count_values($uni_array);
                $count_valu_dep = array_count_values($dep_array);
                $count_valu_sub = array_count_values($sub_array);
                $count_valu_cat = array_count_values($cat_array);

                foreach($count_valu_uni as $key=>$value){
                $sql="UPDATE university set nop=nop - $value where uni_id={$key}";
                $obj->sql($sql);
                }
                foreach($count_valu_dep as $key=>$value){
                    $sql="UPDATE department set nop=nop - $value where dep_id={$key}";
                    $obj->sql($sql);
                }

                foreach($count_valu_sub as $key=>$value){
                    $sql="UPDATE subject set nop=nop - $value where sub_id={$key}";
                    $obj->sql($sql);
                }

                foreach($count_valu_cat as $key=>$value){
                    $sql="UPDATE category set nop=nop - $value where cat_id={$key}";
                    $obj->sql($sql);
                }
                echo "
                <script src='../controller/js/jquary.js'></script>
                <script>
                    $(document).ready(function() { 
                        $.ajax({
                            url: '../view/user_information.php' ,
                            success: function(data) {
                                $('.des_section').html(data);
                            }
                        }); 
                    }); 
                ";
            }else{
                echo "  <div class='error'>
                    <p> can't delete User information .</p>
                </div>";
            }
        }else{
            echo "  <div class='error'>
                <p> can't delete Users posts .</p>
            </div>";
        } 
    }else{
        echo "  <div class='error'>
                    <p> can't delete your self .</p>
                </div>"; 
    }

}


?>