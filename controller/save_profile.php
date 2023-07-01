<?php

    include("../model/database.php");
    
    $obj = new DataBase();
    session_start();

  


    if(isset($_POST['update_name'])){
        $data = $_POST['user_name'];

        $obj->select('user',"user_name",null,"user_name = '{$data}'");
        $result = $obj->get_result();
        $value = ["user_name"=>$data];
        if(COUNT($result)> 0){
            echo '  <div class="error1 close1">
            <p> User Name already Exists.</p>
            <i class="fa fa-times close_error1" aria-hidden="true"></i>

            </div>
            <script src="../controller/js/jquary.js"></script>
            <script>
            $(document).ready(function() {
                $(".close_error1").click(function(){
                    $(".close1").hide(100);
                });
            });
            '; 
        }else{
            if ($obj->update('user',$value,"user_id={$_SESSION['user_id']}")){
                // redirect profile page
                header("location: {$hostname}/view/profile.php");
              }
        }
    }
    if(isset($_POST['update_email'])){
        $data = $_POST['user_email'];
        $obj->select('user',"user_email",null,"user_email = '{$data}'");
        $result = $obj->get_result();
        $value = ["user_email"=>$data];
        if(COUNT($result)> 0){
            echo '  <div class="error1">
            <p> UserEmail already Exists.</p>
            <i class="fa fa-times close_error" aria-hidden="true"></i>

            </div>
            <script src="../controller/js/jquary.js"></script>
            <script>
            $(document).ready(function() {
                $(".close_error").click(function(){
                    $(".error1").hide(100);
                });
            });
            '; 
           
        }else{
            if ($obj->update('user',$value,"user_id={$_SESSION['user_id']}")){
                // redirect profile page
                header("location: {$hostname}/view/profile.php");
              }
        }
    }
    if(isset($_POST['update_phone'])){
        $data = $_POST['user_phone'];
        $obj->select('user',"user_email",null,"user_mobile = '{$data}'");
        $result = $obj->get_result();
        $value = ["user_mobile"=>$data];
        if(COUNT($result)> 0){
            echo '  <div class="error1">
            <p> phone numver already Exists.</p>
            <i class="fa fa-times close_error" aria-hidden="true"></i>

            </div>
            <script src="../controller/js/jquary.js"></script>
            <script>
            $(document).ready(function() {
                $(".close_error").click(function(){
                    $(".error1").hide(100);
                });
            });
            '; 
           
        }else{
            if ($obj->update('user',$value,"user_id={$_SESSION['user_id']}")){
                // redirect profile page
                header("location: {$hostname}/view/profile.php");
            }
        }
    }
    if(isset($_POST['address'])){
        $data = $_POST['aria'];
        if(!empty($data)){
            $value = ["address_id"=>$data];
            if ($obj->update('user',$value,"user_id={$_SESSION['user_id']}")){
            // redirect profile page
            header("location: {$hostname}/view/profile.php");
            }
        }else{
            header("location: {$hostname}/view/profile.php");
            $value = ["address_id"=>null];
            if ($obj->update('user',$value,"user_id={$_SESSION['user_id']}")){
            // redirect profile page
            header("location: {$hostname}/view/profile.php");
            }
        }
        
        
    }
    if(isset($_POST['gender-btn'])){
        $data = $_POST['gender'];
        $value = ["gender"=>$data];
        if ($obj->update('user',$value,"user_id={$_SESSION['user_id']}")){
            // redirect profile page
            header("location: {$hostname}/view/profile.php");
        }
    }
    if(isset($_POST['dob-btn'])){
        $data = $_POST['dob'];
        $value = ["dob"=>$data];
        if ($obj->update('user',$value,"user_id={$_SESSION['user_id']}")){
            // redirect profile page
            header("location: {$hostname}/view/profile.php");
        }
    }
    if(isset($_POST['uni_name'])){
        $data = $_POST['select_uni_name'];
        $value = ["uni_id"=>$data];
        if ($obj->update('user',$value,"user_id={$_SESSION['user_id']}")){
            // redirect profile page
            header("location: {$hostname}/view/profile.php");
        }
    }
    if(isset($_POST['sem_name'])){
        $data = $_POST['select_semester_name'];
        $value = ["semester"=>$data];
        if ($obj->update('user',$value,"user_id={$_SESSION['user_id']}")){
            // redirect profile page
            header("location: {$hostname}/view/profile.php");
        }
    }
    if(isset($_POST['sub_name'])){
        $data = $_POST['select_sub_name'];
        $value = ["sub_id"=>$data];
        if ($obj->update('user',$value,"user_id={$_SESSION['user_id']}")){
            // redirect profile page
            header("location: {$hostname}/view/profile.php");
        }
    }
    if(isset($_POST['update_pass'])){
        $pass_old = md5($_POST['user_pass_old']);
        $pass_new = md5($_POST['user_pass_new']);
        $pass_con = md5($_POST['user_pass_con']);
        $col = "pass";
        $where = " user_id = '{$_SESSION['user_id']}'"; 
        $obj->select('user','user_pass',null,"user_id = '{$_SESSION['user_id']}'");
        $result = $obj->get_result();
        $result = $result[0];

        if(COUNT($result) > 0){
            if($result['user_pass']==$pass_old){
                if($pass_new == $pass_con){
                    $value = ["user_pass"=>$pass_con];
                    if ($obj->update('user',$value,"user_id={$_SESSION['user_id']}")){
                        // redirect profile page
                        header("location: {$hostname}/view/profile.php");
                    } 
                }else{
                    echo '  <div class="error1">
                    <p> your password is not mased .</p>
                    <i class="fa fa-times close_error" aria-hidden="true"></i>

                    </div>
                    <script src="../controller/js/jquary.js"></script>
                    <script>
                    $(document).ready(function() {
                        $(".close_error").click(function(){
                            console.log("eieoeooe");
                            $(".error1").hide(100);
                        });
                    });
                    '; 
                }
               
            }else{
                echo '  <div class="error1">
                <p> your password is in coruct .</p>
                <i class="fa fa-times close_error" aria-hidden="true"></i>

                </div>
                <script src="../controller/js/jquary.js"></script>
                <script>
                $(document).ready(function() {
                    $(".close_error").click(function(){
                        console.log("eieoeooe");
                        $(".error1").hide(100);
                    });
                });
                '; 
            }
           
        }

    }


?>
