<?php
include "../model/database.php";

$obj = new database();

// update department----------------------------------


if(isset($_POST['update'])){
    $dep_id = $_POST['dep_id'];

    $obj->select("department","*",null,"dep_id = {$dep_id}");
    $dep_info_up = $obj->get_result();
    $dep_info_up = $dep_info_up[0];

    echo '<div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-12 col-12 ">
                <div class="cat_update">
                    <h2>update department</h2>
                </div>            
            </div>
            <div class="col-md-12 col-lg-12 col-12">
                <div class="cat_massage"></div>
                <div class="cat_up_info">
                    <input type="hidden" name="cat_id" value="'.$dep_id.'" class="depart_id">
                    <label for="cetagory">department name</label>
                    <input type="text" name="cat_name" id="cat_name_up" class = "dep_name_up_val" value = "'.$dep_info_up['dep_name'].'">

                    <input type="button" value="save" id ="cat_submit" class = "dep_summit">

                </div>
            </div>
        </div>
    </div>


    <script>
    $(document).ready(function() {

        $(".dep_summit").click(function() {
            var dep_id = $(".depart_id").val();
            var dep_name = $(".dep_name_up_val").val();
            var update = "save";
            console.log(dep_name);
            $.ajax({
                url: "../controller/update_insert_delet_dep.php",
                method: "POST",
                data: {
                    update_dep:update,
                    dep_id: dep_id,
                    dep_name: dep_name
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
if(isset($_POST['update_dep'])){
    $dep_id = $_POST['dep_id'];
    $dep_name = $_POST['dep_name'];
    $value = ["dep_name"=>$dep_name];
    $obj->select("department","dep_name",null,"dep_name = '{$dep_name}'");
    $dep_ins = $obj->get_result();
    $dep_num =COUNT($dep_ins) ;
    // print_r ($cat_ins);


    if($dep_num > 0){
        echo "  <div class='error'>
        <p> cetagory alradey exist .</p>
        </div>"; 
    }else{
        if($obj->update("department",$value,"dep_id = {$dep_id}")){
            echo "
                <script src='../controller/js/jquary.js'></script>
                <script>
                    $(document).ready(function() { 
                        $.ajax({
                            url: '../view/department.php' ,
                            success: function(data) {
                                $('.des_section').html(data);
                            }
                        }); 
                    }); 
                ";
        }else{
        echo "  <div class='error'>
                    <p> can't update department .</p>
                </div>";
        }
    }
}
// take parmetion for delete department-----------------------------
if(isset($_POST["dep_conferm"])){
    $dep_id= $_POST['d_dep_id'];
    $obj->select("books","*",null,"department= $dep_id");
    $dep_post = $obj->get_result();
    $num_post = COUNT($dep_post);
    if($num_post > 0){
        $post_info = $dep_post[0];
    // print_r ($post_info);
    
        echo '  <div class="confermation">
                    <p>all '.$num_post.' posts of this uniersity must be deleted </p>
                    <input type="hidden" name="user_id" class ="user_id_valu" value = "'.$dep_id.'">
                    <button class="delet_con_cat">ok</button>
                    <i class="fa fa-times close close_div" aria-hidden="true"></i>
            </div>
            <script>
            $(document).ready(function() {

                $(".delet_con_cat").click(function() {
                    var depart_id = $(".user_id_valu").val();
                    $.ajax({
                        url: "../controller/update_insert_delet_dep.php",
                        method: "POST",
                        data: {
                            depart_id:depart_id
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
        <input type="hidden" name="user_id" class ="user_id_valu" value = "'.$dep_id.'">
        <button class="delet_con_cat">ok</button>
        <i class="fa fa-times close close_div" aria-hidden="true"></i>
        </div>
        <script>
        $(document).ready(function() {

            $(".delet_con_cat").click(function() {
                var depart_id = $(".user_id_valu").val();
                $.ajax({
                    url: "../controller/update_insert_delet_dep.php",
                    method: "POST",
                    data: {
                        depart_id:depart_id
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

if(isset($_POST['depart_id'])){
    $depart_id = $_POST['depart_id'];
    $obj->select("books","*",null,"department= $depart_id");
    $dep_post = $obj->get_result();

    
    // print_r ($uni_post);

    $num_post = COUNT($dep_post);
    if($num_post > 0){
        $uni_array = array();
        $sub_array = array();
        $user_array = array();
        $img_array = array();
        $cat_array = array();
    
        foreach($dep_post as $row){
            array_push($uni_array,$row['uni_id']);
            array_push($sub_array,$row['sub_id']);
            array_push($user_array,$row['user_id']);
            array_push($cat_array,$row['cat_id']);
            array_push($img_array,$row['img_1']);
            array_push($img_array,$row['img_2']);
            array_push($img_array,$row['img_3']);
    
            
        }
        $post_info = $dep_post[0];
        if($obj->delete("books","department= $depart_id")){
            foreach($img_array as $img){
                unlink("../uplode/".$img);
            }
                if($obj->delete("department","dep_id= $depart_id")){


                    $count_valu_uni = array_count_values($uni_array);
                    $count_valu_sub = array_count_values($sub_array);
                    $count_valu_user = array_count_values($user_array);
                    $count_valu_cat = array_count_values($cat_array);

                    foreach($count_valu_uni as $key=>$value){
                    $sql="UPDATE university set nop=nop - $value where uni_id={$key}";
                    $obj->sql($sql);
                    }
                    foreach($count_valu_cat as $key=>$value){
                        $sql="UPDATE category set nop=nop - $value where uni_id={$key}";
                        $obj->sql($sql);
                        }
                    foreach($count_valu_sub as $key=>$value){
                        $sql="UPDATE subject set nop=nop - $value where sub_id={$key}";
                        $obj->sql($sql);
                    }
                    foreach($count_valu_user as $key=>$value){
                        $sql="UPDATE user set nop=nop - $value where user_id={$key}";
                        $obj->sql($sql);
                    }
                    echo "<script src='../controller/js/jquary.js'></script>
                    <script>
                        $(document).ready(function() { 
                            $.ajax({
                                url: '../view/department.php' ,
                                success: function(data) {
                                    $('.des_section').html(data);
                                }
                            }); 
                        });";
                }
        }else{
            echo "  <div class='error'>
                <p> can't delete department .</p>
            </div>";
        }
    }else{
        if( $obj->delete("department","dep_id= $depart_id")){
            echo "<script src='../controller/js/jquary.js'></script>
            <script>
                $(document).ready(function() { 
                    $.ajax({
                        url: '../view/department.php' ,
                        success: function(data) {
                            $('.des_section').html(data);
                        }
                    }); 
                });";
        }else{
            echo "  <div class='error'>
            <p> can't delete department .</p>
            </div>"; 
        }
       
    }
}
// add new department=========================================
if(isset($_POST['dep_insert'])){
    echo '<div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-12 col-12 ">
                <div class="cat_update">
                    <h2>add new department</h2>
                </div>            
            </div>
            <div class="col-md-12 col-lg-12 col-12">
                <div class="cat_massage"></div>
                <div class="cat_up_info">
                    <label for="cetagory">department name</label>
                    <input type="text" name="cat_name" id="cat_name_up" class = "dep_name_ins" placeholder="enter department name">
                    <input type="button" value="save" id ="cat_submit" class = "cat_summit dep_submit_insert">

                </div>
            </div>
        </div>
    </div>


    <script>
    $(document).ready(function() {

        $(".dep_submit_insert").click(function() {
            var dep_name = $(".dep_name_ins").val();
            var update = "save";
            $.ajax({
                url: "../controller/update_insert_delet_dep.php",
                method: "POST",
                data: {
                    ins_dep:update,
                    dep_name: dep_name
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
if(isset($_POST['ins_dep'])){
    $dep_name = $_POST['dep_name'];
    $obj->select("department","*",null,"dep_name = '{$dep_name}'");
    $get_dep_number = $obj->get_result();
    $num_dep = COUNT($get_dep_number);
    if($num_dep >0){
        echo "  <div class='error'>
        <p> department alrady exist .</p>
        </div>"; 
    }else{
        $value = ["dep_name"=>$dep_name];

        if($obj->insert("department",$value)){
            echo "<script src='../controller/js/jquary.js'></script>
                    <script>
                        $(document).ready(function() { 
                            $.ajax({
                                url: '../view/department.php' ,
                                success: function(data) {
                                    $('.des_section').html(data);
                                }
                            }); 
                        });";
        }else{
            echo "  <div class='error'>
            <p> can't added department .</p>
            </div>"; 
        }    
    }
}

?>