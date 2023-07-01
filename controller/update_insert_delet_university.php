<?php
    include "../model/database.php";
    $obj = new database();
    if(isset($_POST['update'])){
        $uni_id = $_POST['uni_id'];
        $uni_name = $_POST['uni_name'];
        $cat_id = $_POST['cat_id'];

        $uni_value  = ["uni_name"=>$uni_name,"cat_id"=>$cat_id];

        $obj->select("university","*",null,"uni_name = '{$uni_name}' AND cat_id = '{$cat_id}'");
        $get_uni_number = $obj->get_result();
        $obj->select("university","*",null,"uni_id = '{$uni_id}'");
        $get_cei_info = $obj->get_result();
        $get_cei_info=$get_cei_info[0];
        $num_uni = COUNT($get_uni_number);
        if($num_uni >0){
            echo "  <div class='error'>
            <p> subject alrady exist .</p>
            </div>"; 
        }else{

            if($obj->update("university",$uni_value,"uni_id={$uni_id}")){
                $sql_del="UPDATE category set nov=nov - 1 where cat_id={$get_cei_info['cat_id']}";
                $obj->sql($sql_del);
                $sql_add="UPDATE category set nov=nov + 1 where cat_id={$cat_id}";
                $obj->sql($sql_add);
                echo "
                <script src='../controller/js/jquary.js'></script>
                <script>
                    $(document).ready(function() { 
                        $.ajax({
                            url: '../view/university.php' ,
                            success: function(data) {
                                $('.des_section').html(data);
                            }
                        }); 
                    }); 
                ";
            }else{
                echo "  <div class='error'>
                <p> can't update university .</p>
            </div>";
            }
        }
    }


    if(isset($_POST["uni_conferm"])){
        $uni_id= $_POST['uni_id'];
        $obj->select("books","*",null,"uni_id= $uni_id");
        $users_post = $obj->get_result();
        $num_post = COUNT($users_post);
        if($num_post > 0){
            $post_info = $users_post[0];
        // print_r ($post_info);
        
            echo '  <div class="confermation">
                        <p>all '.$num_post.' posts of this uniersity must be deleted </p>
                        <input type="hidden" name="user_id" class ="user_id_valu" value = "'.$uni_id.'">
                        <button class="delet_con_cat">ok</button>
                        <i class="fa fa-times close close_uni" aria-hidden="true"></i>
                </div>
                <script>
                $(document).ready(function() {
    
                    $(".delet_con_cat").click(function() {
                        var uni_id = $(".user_id_valu").val();
                        $.ajax({
                            url: "../controller/update_insert_delet_university.php",
                            method: "POST",
                            data: {
                                uni_id1:uni_id
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
            <input type="hidden" name="user_id" class ="user_id_valu" value = "'.$uni_id.'">
            <button class="delet_con_cat">ok</button>
            <i class="fa fa-times close close_uni" aria-hidden="true"></i>
            </div>
            <script>
            $(document).ready(function() {
    
                $(".delet_con_cat").click(function() {
                    var uni_id = $(".user_id_valu").val();
                    $.ajax({
                        url: "../controller/update_insert_delet_university.php",
                        method: "POST",
                        data: {
                            uni_id1:uni_id
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

// echo "hooo";
    if(isset($_POST['uni_id1'])){
        $uni_id = $_POST['uni_id1'];
        $obj->select("books","*",null,"uni_id= $uni_id");
        $uni_post = $obj->get_result();
        $obj->select("university","*",null,"uni_id= $uni_id");
        $uni_info = $obj->get_result();
        $uni_info = $uni_info[0];
        $uni_cat_id = $uni_info['cat_id'];
    
        $num_post = COUNT($uni_post);
        if($num_post > 0){
            $uni_array = array();
            $sub_array = array();
            $dep_array = array();
            $user_array = array();
            $img_array =array();
            $cat_array = array();

            foreach($uni_post as $row){
                array_push($uni_array,$row['uni_id']);
                array_push($sub_array,$row['sub_id']);
                array_push($dep_array,$row['department']);
                array_push($user_array,$row['user_id']);
                array_push($cat_array,$row['cat_id']);
                array_push($img_array,$row['img_1']);
                array_push($img_array,$row['img_2']);
                array_push($img_array,$row['img_3']);

                
            }
            $post_info = $uni_post[0];
            if($obj->delete("books","uni_id= $uni_id")){
                foreach($img_array as $img){
                    unlink("../uplode/".$img);
                }
                    if($obj->delete("university","uni_id= $uni_id")){
                        $sql_cat="UPDATE category set nov=nov - 1 where cat_id={$uni_cat_id}";
                        $obj->sql($sql_cat);

    
                        $count_valu_uni = array_count_values($uni_array);
                        $count_valu_dep = array_count_values($dep_array);
                        $count_valu_sub = array_count_values($sub_array);
                        $count_valu_user = array_count_values($user_array);
                        $count_valu_cat = array_count_values($cat_array);
                        
                        foreach($count_valu_cat as $key=>$value){
                            $sql="UPDATE category set nop=nop - $value where uni_id={$key}";
                            $obj->sql($sql);
                        }
                        foreach($count_valu_uni as $key=>$value){
                            $sql="UPDATE university set nop=nop - $value where uni_id={$key}";
                            $obj->sql($sql);
                            $obj->delete("books","uni_id= $key");
                        }
                        foreach($count_valu_dep as $key=>$value){
                            $sql="UPDATE department set nop=nop - $value where dep_id={$key}";
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
                        echo "
                        <script src='../controller/js/jquary.js'></script>
                        <script>
                            $(document).ready(function() { 
                                $.ajax({
                                    url: '../view/university.php' ,
                                    success: function(data) {
                                        $('.des_section').html(data);
                                    }
                                }); 
                            }); 
                        ";
                    }
            }else{
                echo "  <div class='error'>
                    <p> can't delete university .</p>
                </div>";
            }
        }else{
            if( $obj->delete("university","uni_id= $uni_id")){
                $sql_cat="UPDATE category set nov=nov - 1 where cat_id={$uni_cat_id}";
                $obj->sql($sql_cat);
                echo "
                <script src='../controller/js/jquary.js'></script>
                <script>
                    $(document).ready(function() { 
                        $.ajax({
                            url: '../view/university.php' ,
                            success: function(data) {
                                $('.des_section').html(data);
                            }
                        }); 
                    }); 
                ";
            }else{
                echo "  <div class='error'>
                <p> can't delete university .</p>
                </div>"; 
            }
           
        }
    }


    if(isset($_POST['uni_insert'])){
        $obj->select("category","*");
        $all_cetagory = $obj->get_result();
        $output = '<div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-12 col-12 ">
                    <div class="cat_update">
                        <h2>add new university</h2>
                    </div>            
                </div>
                <div class="col-md-12 col-lg-12 col-12">
                    <div class="uni_massage"></div>
                    <div class="uni_up_info">
                        <div class="row">
                            <div class="col-md-6 col-lg-6 col-sm-12">
                                <label for="cetagory">university name</label>
                                <input type="text" name="uni_name" id="uni_name_up" class = "uni_name_up" placeholder="enter cetagory name">
                            </div>
                            <div class="col-md-6 col-lg-6 col-sm-12">
                                <label for="cetagory">cetagory name</label>
                                <select name="cetagory" id="cetagory_id">
                                    <option value disabled selected>select cetagory</option>';
                                    foreach($all_cetagory as $row){
                                        $output .= '<option value="'.$row['cat_id'].'">'.$row['cat_name'].'</option>';
                                    }
                    $output.= '</select>
                            </div>
                        </div>


                        <input type="button" value="save" id ="cat_submit" class = "cat_summit uni_submit_insert">
    
                    </div>
                </div>
            </div>
        </div>
    
    
        <script>
        $(document).ready(function() {
    
            $(".uni_submit_insert").click(function() {
                var uni_name = $(".uni_name_up").val();
                var cat_id = $("#cetagory_id").val();
                var update = "save";
                $.ajax({
                    url: "../controller/update_insert_delet_university.php",
                    method: "POST",
                    data: {
                        ins:update,
                        uni_name: uni_name,
                        cat_id:cat_id
                    },
                    success: function(data) {
                        $(".uni_massage").html(data);
                    }
                });
            });
        });
        </script>
        ';
    
    echo $output;
    }
    if(isset($_POST["ins"])){
        $uni_name = $_POST['uni_name'];
        $cat_id = $_POST['cat_id'];
        $obj->select("university","*",null,"uni_name = '{$uni_name}'");
        $get_uni_number = $obj->get_result();
        $count_uni = COUNT($get_uni_number);
        if($count_uni > 0){
            echo "  <div class='error'>
            <p> uniniversity alrady exist .</p>
            </div>"; 
        }else{
            $value = ["uni_name"=>$uni_name,"cat_id"=>$cat_id];
    
            if($obj->insert("university",$value)){
                $sql="UPDATE category set nov=nov + 1 where cat_id={$cat_id}";
                $obj->sql($sql);
                echo "
                <script src='../controller/js/jquary.js'></script>
                <script>
                    $(document).ready(function() { 
                        $.ajax({
                            url: '../view/university.php' ,
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
