<?php
include "../model/database.php";

$obj = new database();

// update subject----------------------------------


if(isset($_POST['update'])){
    $sub_id_up = $_POST['sub_id'];

    $obj->select("subject","*",null,"sub_id = {$sub_id_up}");
    $sub_info_up = $obj->get_result();
    $sub_info_up = $sub_info_up[0];

    echo '<div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-12 col-12 ">
                <div class="cat_update">
                    <h2>update subject</h2>
                </div>            
            </div>
            <div class="col-md-12 col-lg-12 col-12">
                <div class="cat_massage"></div>
                <div class="cat_up_info">
                    <input type="hidden" name="sub_id" value="'.$sub_id_up.'" class="sub_id">
                    <label for="cetagory">subject name</label>
                    <input type="text" name="cat_name" id="cat_name_up" class = "sub_name_up_val" value = "'.$sub_info_up['sub_name'].'">

                    <input type="button" value="save" id ="cat_submit" class = "sub_summit">

                </div>
            </div>
        </div>
    </div>


    <script>
    $(document).ready(function() {

        $(".sub_summit").click(function() {
            var sub_id = $(".sub_id").val();
            var sub_name = $(".sub_name_up_val").val();
            var update = "save";
            $.ajax({
                url: "../controller/update_insert_delet_sub.php",
                method: "POST",
                data: {
                    update_sub:update,
                    sub_id_up: sub_id,
                    sub_name_up: sub_name
                },
                success: function(data) {
                    $(".cat_massage").html(data);
                }
            });
        });
    });
    </script>


    ';
}
if(isset($_POST['update_sub'])){
    $sub_id = $_POST['sub_id_up'];
    $sub_name = $_POST['sub_name_up'];
    $value = ["sub_name"=>$sub_name];

    $obj->select("subject","*",null,"sub_name = '{$sub_name}'");
    $sub_info_count = COUNT($obj->get_result()) ;
    
    if($sub_info_count > 0){
        echo "  <div class='error'>
                    <p>subject alrady exist .</p>
                </div>";
    }else{
        if($obj->update("subject",$value,"sub_id = {$sub_id}")){
            echo "
            <script src='../controller/js/jquary.js'></script>
            <script>
                $(document).ready(function() { 
                    $.ajax({
                        url: '../view/subject.php' ,
                        success: function(data) {
                            $('.des_section').html(data);
                        }
                    }); 
                }); 
            ";
        }else{
        echo "  <div class='error'>
                    <p> can't update subject .</p>
                </div>";
        }
    }

}

// take parmetion for delete department-----------------------------
if(isset($_POST["sub_conferm"])){
    $sub_id= $_POST['d_sub_id'];
    $obj->select("books","*",null,"sub_id= $sub_id");
    $sub_post = $obj->get_result();
    $num_post = COUNT($sub_post);
    if($num_post > 0){
        $post_info = $sub_post[0];
    // print_r ($post_info);
    
        echo '  <div class="confermation">
                    <p>all '.$num_post.' posts of this subject must be deleted </p>
                    <input type="hidden" name="sub_id" class ="sub_id_valu" value = "'.$sub_id.'">
                    <button class="delet_con_sub">ok</button>
                    <i class="fa fa-times close close_sub" aria-hidden="true"></i>
            </div>
            <script>
            $(document).ready(function() {

                $(".delet_con_sub").click(function() {
                    var sub_id_del = $(".sub_id_valu").val();
                    $.ajax({
                        url: "../controller/update_insert_delet_sub.php",
                        method: "POST",
                        data: {
                            sub_id_del:sub_id_del
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
        </script>
            
            ';
    }else{
        echo '  <div class="confermation">
        <p>do you want to delete this university . </p>
        <input type="hidden" name="sub_id" class ="sub_id_valu" value = "'.$sub_id.'">
        <button class="delet_con_sub">ok</button>
        <i class="fa fa-times close close_sub" aria-hidden="true"></i>
        </div>
        <script>
        $(document).ready(function() {

            $(".delet_con_sub").click(function() {
                var sub_id_del = $(".sub_id_valu").val();
                $.ajax({
                    url: "../controller/update_insert_delet_sub.php",
                    method: "POST",
                    data: {
                        sub_id_del:sub_id_del
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
        </script>

        ';
    }

}
// delete department=====================

if(isset($_POST['sub_id_del'])){
    $sub_id_del = $_POST['sub_id_del'];
    $obj->select("books","*",null,"sub_id= $sub_id_del");
    $sub_post = $obj->get_result();
    
    // print_r ($uni_post);

    $num_post = COUNT($sub_post);
    if($num_post > 0){
        $uni_array = array();
        $dep_array = array();
        $user_array = array();
        $img_array =array();
        $cat_array = array();

        foreach($sub_post as $row){
            array_push($uni_array,$row['uni_id']);
            array_push($dep_array,$row['department']);
            array_push($user_array,$row['user_id']);
            array_push($cat_array,$row['cat_id']);
            array_push($img_array,$row['img_1']);
            array_push($img_array,$row['img_2']);
            array_push($img_array,$row['img_3']);

            
        }
        $post_info = $sub_post[0];
        if($obj->delete("books","sub_id= $sub_id_del")){
            foreach($img_array as $img){
                unlink("../uplode/".$img);
            }
                if($obj->delete("subject","sub_id= $sub_id_del")){


                    $count_valu_uni = array_count_values($uni_array);
                    $count_valu_dep = array_count_values($dep_array);
                    $count_valu_user = array_count_values($user_array);
                    $count_valu_cat = array_count_values($cat_array);

                    foreach($count_valu_cat as $key=>$value){
                        $sql="UPDATE category set nop=nop - $value where uni_id={$key}";
                        $obj->sql($sql);
                    }
                    foreach($count_valu_uni as $key=>$value){
                    $sql="UPDATE university set nop=nop - $value where uni_id={$key}";
                    $obj->sql($sql);
                    }
                    foreach($count_valu_dep as $key=>$value){
                        $sql="UPDATE department set nop=nop - $value where dep_id={$key}";
                        $obj->sql($sql);
                    }
                    foreach($count_valu_user as $key=>$value){
                        $sql="UPDATE user set nop=nop - $value where user_id={$key}";
                        $obj->sql($sql);
                    }
                    echo "
                    <script src='../controller/js/jquary.js'></script>
                    <script>
                        $(document).ready(function() { 
                            $.ajax({
                                url: '../view/subject.php' ,
                                success: function(data) {
                                    $('.des_section').html(data);
                                }
                            }); 
                        }); 
                    ";
                }
        }else{
            echo "  <div class='error'>
                <p> can't delete subject .</p>
            </div>";
        }
    }else{
        if( $obj->delete("subject","sub_id= $sub_id_del")){
            echo "
            <script src='../controller/js/jquary.js'></script>
            <script>
                $(document).ready(function() { 
                    $.ajax({
                        url: '../view/subject.php' ,
                        success: function(data) {
                            $('.des_section').html(data);
                        }
                    }); 
                }); 
            ";
        }else{
            echo "  <div class='error'>
            <p> can't delete subject .</p>
            </div>"; 
        }
       
    }
}
// add new subject in suject tabele==================================

if(isset($_POST['sub_insert'])){
    echo '<div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-12 col-12 ">
                <div class="cat_update">
                    <h2>add new subject</h2>
                </div>            
            </div>
            <div class="col-md-12 col-lg-12 col-12">
                <div class="cat_massage"></div>
                <div class="cat_up_info">
                    <label for="cetagory">subject name</label>
                    <input type="text" name="cat_name" id="cat_name_up" class = "sub_name_ins" placeholder="enter department name">
                    <input type="button" value="save" id ="cat_submit" class = "cat_summit sub_submit_insert">

                </div>
            </div>
        </div>
    </div>


    <script>
    $(document).ready(function() {

        $(".sub_submit_insert").click(function() {
            var sub_name = $(".sub_name_ins").val();
            var update = "save";
            $.ajax({
                url: "../controller/update_insert_delet_sub.php",
                method: "POST",
                data: {
                    ins_sub:update,
                    sub_name: sub_name
                },
                success: function(data) {
                    $(".cat_massage").html(data);
                }
            });
        });
    });
    </script>
    ';


}
if(isset($_POST['ins_sub'])){
    $sub_name = $_POST['sub_name'];
    $obj->select("subject","*",null,"sub_name = '{$sub_name}'");
    $get_sub_number = $obj->get_result();
    $num_sub = COUNT($get_sub_number);
    if($num_sub >0){
        echo "  <div class='error'>
        <p> subject alrady exist .</p>
        </div>"; 
    }else{
        $value = ["sub_name"=>$sub_name];

        if($obj->insert("subject",$value)){
            echo "
            <script src='../controller/js/jquary.js'></script>
            <script>
                $(document).ready(function() { 
                    $.ajax({
                        url: '../view/subject.php' ,
                        success: function(data) {
                            $('.des_section').html(data);
                        }
                    }); 
                }); 
            ";
        }else{
            echo "  <div class='error'>
            <p> can't added subject .</p>
            </div>"; 
        }    
    }
}

?>