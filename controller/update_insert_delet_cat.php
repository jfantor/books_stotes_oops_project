<?php
include "../model/database.php";
$obj = new database();
session_start();
if(isset($_POST['get_message'])){
    echo "<div class='success'>
    <p>cetagory update successfully .</p>
</div>";
}

if(isset($_POST['update'])){
    $cat_id = $_POST['cat_id'];
    $cat_name = $_POST['cat_name'];
    $cat_value  = ["cat_name"=>$cat_name];
    $obj->select("category","cat_name",null,"cat_name = '{$cat_name}'");
    $cat_ins = $obj->get_result();
    $cat_num =COUNT($cat_ins) ;
    // print_r ($cat_ins);


    if($cat_num > 0){
        echo "  <div class='error'>
        <p> cetagory alradey exist .</p>
        </div>"; 
    }else{
        if($obj->update("category",$cat_value,"cat_id={$cat_id}")){
            echo "
                <script src='../controller/js/jquary.js'></script>
                <script>
                    $(document).ready(function() { 
                        $.ajax({
                            url: '../view/cetagory.php' ,
                            success: function(data) {
                                $('.des_section').html(data);
                            }
                        });
                        $.ajax({
                            url: '../controller/update_insert_delet_cat.php' ,
                            method: 'POST',
                            data: {
                                get_message:get_message
                            },
                            success: function(data) {
                                $('.get_massage').html(data);
                            }
                        }); 
                    });    
                ";
        }else{
            echo "  <div class='error'>
            <p> can't update cetagory .</p>
        </div>";
        }
    }

}
// echo "fggfd";
if(isset($_POST["cat_conferm"])){
    $cat_id= $_POST['cat_id'];
    $obj->select("books","*",null,"cat_id= $cat_id");
    $users_post = $obj->get_result();
    $num_post = COUNT($users_post);
    if($num_post > 0){
        $post_info = $users_post[0];
    // print_r ($post_info);
    
        echo '  <div class="confermation">
                    <p>all '.$num_post.' posts and university of this cetagory must be deleted </p>
                    <input type="hidden" name="user_id" class ="user_id_valu" value = "'.$cat_id.'">
                    <button class="delet_con_cat">ok</button>
                    <i class="fa fa-times close close_cat" aria-hidden="true"></i>
            </div>
            <script>
            $(document).ready(function() {

                $(".delet_con_cat").click(function() {
                    var cat_id = $(".user_id_valu").val();
                    $.ajax({
                        url: "../controller/update_insert_delet_cat.php",
                        method: "POST",
                        data: {
                            cat_id1:cat_id
                        },
                        success: function(data) {
                            $(".get_massage").html(data);
                        }
                    });
                    $(".close").click(function() {
                        $(".confermation").hide(); 
                    });
                });
            
            });
        </script>
            
            ';
    }else{
        echo '  <div class="confermation">
        <p>do you want to delete this cetagory . </p>
        <input type="hidden" name="user_id" class ="user_id_valu" value = "'.$cat_id.'">
        <button class="delet_con_cat">ok</button>
        <i class="fa fa-times close close_cat" aria-hidden="true"></i>
        </div>
        <script>
        $(document).ready(function() {

            $(".delet_con_cat").click(function() {
                var cat_id = $(".user_id_valu").val();
                $.ajax({
                    url: "../controller/update_insert_delet_cat.php",
                    method: "POST",
                    data: {
                        cat_id1:cat_id
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

if(isset($_POST['cat_id1'])){
    $cat_id_delet = $_POST['cat_id1'];
    $obj->select("books","*",null,"cat_id= $cat_id_delet");
    $users_post = $obj->get_result();
    $num_post = COUNT($users_post);
    $uni_array = array();
    $sub_array = array();
    $dep_array = array();
    $img_array = array();
    if($num_post > 0){
        foreach($users_post as $row){
            array_push($uni_array,$row['uni_id']);
            array_push($sub_array,$row['sub_id']);
            array_push($dep_array,$row['department']);
            array_push($img_array,$row['img_1']);
            array_push($img_array,$row['img_2']);
            array_push($img_array,$row['img_3']);


            
        }
    }

    $obj->select("university","*",null,"cat_id= $cat_id_delet");
    $cat_uni = $obj->get_result();
    $num_uni = COUNT($cat_uni);

    $uni_array1 = array();
    $count_valu_uni1 = array_count_values($uni_array1);
    if($num_uni > 0){
        foreach($cat_uni as $row){
            array_push($uni_array1,$row['uni_id']);

            
        }
    }

    $obj->select("user","*",null,"user_id = {$_SESSION["user_id"]}");
    $user_information = $obj->get_result();
    $user_information = $user_information[0];
    $user_uni_id = $user_information['uni_id'];
    if(in_array($user_uni_id, $uni_array1)){
        echo "  <div class='error'>
        <p>you are in this cetagory thats why you can't delete this cetagory .</p>
        </div>"; 
    }else{
        if($num_post > 0){
            $post_info = $users_post[0];
            if($obj->delete("books","cat_id= $cat_id_delet")){
                foreach($img_array as $img){
                    unlink("../uplode/".$img);
                }

                if($obj->delete("category","cat_id= $cat_id_delet")){
                    if($obj->delete("university","cat_id= $cat_id_delet")){
                        if($num_uni > 0){
                            foreach($count_valu_uni1 as $key=>$value){
                                $obj->delete("user","uni_id= $key");
                            }
                        }
                        $count_valu_uni = array_count_values($uni_array);
                        $count_valu_dep = array_count_values($dep_array);
                        $count_valu_sub = array_count_values($sub_array);

                        foreach($count_valu_uni as $key=>$value){
                        $sql="UPDATE university set nop=nop - $value where uni_id={$key}";
                        $obj->sql($sql);
                        $obj->delete("books","uni_id= $key");
                        $obj->delete("user","uni_id= $key");
                        }
                        foreach($count_valu_dep as $key=>$value){
                            $sql="UPDATE department set nop=nop - $value where dep_id={$key}";
                            $obj->sql($sql);
                        }

                        foreach($count_valu_sub as $key=>$value){
                            $sql="UPDATE subject set nop=nop - $value where sub_id={$key}";
                            $obj->sql($sql);
                        }
                        echo " <div class='success'>
                                <p>cetagory delete successfully .</p>
                            </div> 
                            <script src='../controller/js/jquary.js'></script>
                            <script>
                                $(document).ready(function() { 
                                    $.ajax({
                                        url: '../view/cetagory.php' ,
                                        success: function(data) {
                                            $('.des_section').html(data);
                                        }
                                    }); 
                                }); ";
                    }

                }else{
                    echo "  <div class='error'>
                        <p> can't delete cetagory .</p>
                    </div>";
                }
            }else{
                echo "  <div class='error'>
                    <p> can't delete cetagory .</p>
                </div>";
            }
        }else{
            if($num_uni >0 ){
                    if($obj->delete("university","cat_id= $cat_id_delet")){
                        foreach($count_valu_uni1 as $key=>$value){
                            $obj->delete("user","uni_id= $key");
                        }
                        if($obj->delete("category","cat_id= $cat_id_delet")){
                            echo " <div class='success'>
                                <p>cetagory delete successfully .</p>
                            </div>
                            <script src='../controller/js/jquary.js'></script>
                            <script>
                                $(document).ready(function() { 
                                    $.ajax({
                                        url: '../view/cetagory.php' ,
                                        success: function(data) {
                                            $('.des_section').html(data);
                                        }
                                    }); 
                                }); 
                            ";
                        }else{
                            echo "  <div class='error'>
                            <p> can't delete cetagory .</p>
                            </div>"; 
                        }
                    }
                    
           
            }else{
                if( $obj->delete("category","cat_id= $cat_id_delet")){
                    echo " <div class='success'>
                                <p>cetagory delete successfully .</p>
                             </div>
                             <script src='../controller/js/jquary.js'></script>
                             <script>
                                 $(document).ready(function() { 
                                     $.ajax({
                                         url: '../view/cetagory.php' ,
                                         success: function(data) {
                                             $('.des_section').html(data);
                                         }
                                     }); 
                                 }); 
                             ";
                }else{
                    echo "  <div class='error'>
                                <p> can't delete cetagory .</p>
                             </div>"; 
            }
            }

        
        }
    }



   

 
}
if(isset($_POST['cat_insert'])){
    echo '<div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-12 col-12 ">
                <div class="cat_update">
                    <h2>add new cetagory</h2>
                </div>            
            </div>
            <div class="col-md-12 col-lg-12 col-12">
                <div class="cat_massage"></div>
                <div class="cat_up_info">
                    <label for="cetagory">cetagory name</label>
                    <input type="text" name="cat_name" id="cat_name_up" placeholder="enter cetagory name">
                    <input type="button" value="save" id ="cat_submit" class = "cat_summit cat_submit_insert">

                </div>
            </div>
        </div>
    </div>


    <script>
    $(document).ready(function() {

        $(".cat_submit_insert").click(function() {
            var cat_name = $("#cat_name_up").val();
            var update = "save";
            console.log(cat_name);
            $.ajax({
                url: "../controller/update_insert_delet_cat.php",
                method: "POST",
                data: {
                    ins:update,
                    cat_name: cat_name
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
if(isset($_POST["ins"])){
    $cat_name = $_POST['cat_name'];
    $value = ["cat_name"=>$cat_name];
    $obj->select("category","cat_name",null,"cat_name = '{$cat_name}'");
    $cat_ins = $obj->get_result();
    $cat_num =COUNT($cat_ins) ;
    // print_r ($cat_ins);


    if($cat_num > 0){
        echo "  <div class='error'>
        <p> cetagory alradey exist .</p>
        </div>"; 
    }else{

        if($obj->insert("category",$value)){
            echo " <div class='success'>
                        <p>cetagory added successfully .</p>
                    </div>
                    <script src='../controller/js/jquary.js'></script>
                    <script>
                        $(document).ready(function() { 
                            $.ajax({
                                url: '../view/cetagory.php' ,
                                success: function(data) {
                                    $('.des_section').html(data);
                                }
                            }); 
                        }); 
                    ";
        }else{
            echo "  <div class='error'>
            <p> can't added cetagory .</p>
            </div>"; 
        }
    }



}
?>