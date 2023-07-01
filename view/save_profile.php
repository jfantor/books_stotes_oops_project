<?php

    include("../model/database.php");
    
    $obj = new DataBase();
    session_start();

  


    if(isset($_POST['save_name'])){
        $data = $_POST['name'];

        $obj->select('user',"user_name",null,"user_name = '{$data}'");
        $result = $obj->get_result();
        $value = ["user_name"=>$data];
        if(COUNT($result)> 0){
            echo "<p style='color:red;text-align:center;margin: 10px 0;'>UserEmail already Exists.</p>";
        }else{
            if ($obj->update('user',$value,"user_id={$_SESSION['user_id']}")){
                // redirect profile page
                header("location: {$hostname}/view/profile.php");
              }
        }
    }
    if(isset($_POST['email_btn'])){
        $data = $_POST['email'];
        $obj->select('user',"user_email",null,"user_email = '{$data}'");
        $result = $obj->get_result();
        $value = ["user_email"=>$data];
        if(COUNT($result)> 0){
            echo "<p style='color:red;text-align:center;margin: 10px 0;'>UserEmail already Exists.</p>";
        }else{
            if ($obj->update('user',$value,"user_id={$_SESSION['user_id']}")){
                // redirect profile page
                header("location: {$hostname}/view/profile.php");
              }
        }
    }
    if(isset($_POST['phone-btn'])){
        $data = $_POST['phone'];
        $value = ["user_mobile"=>$data];
        if ($obj->update('user',$value,"user_id={$_SESSION['user_id']}")){
            // redirect profile page
            header("location: {$hostname}/view/profile.php");
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
        // $data = $_POST['select_semester_name'];
        // $value = ["semester"=>$data];
        // if ($obj->update('user',$value,"user_id={$_SESSION['user_id']}")){
        //     // redirect profile page
        //     header("location: {$hostname}/view/profile.php");
        // }
        echo "oerho";
    }
    if(isset($_POST['sub_name'])){
        $data = $_POST['select_sub_name'];
        $value = ["sub_id"=>$data];
        if ($obj->update('user',$value,"user_id={$_SESSION['user_id']}")){
            // redirect profile page
            header("location: {$hostname}/view/profile.php");
        }
    }
    if(isset($_POST['pass'])){
        $pass_old = md5($_POST['u_pass_old']);
        $pass_new = md5($_POST['u_pass_new']);
        $pass_con = md5($_POST['u_pass_con']);
        $col = "pass";
        $where = " user_id = '{$_SESSION['user_id']}'"; 
        $obj->select('user','pass',null,"user_id = '{$_SESSION['user_id']}'");
        $result = $obj->get_result();

        if(COUNT($result) > 0){
            if($result['pass']=$pass_old){
                if($pass_new = $pass_con){
                $value = ["sub_id"=>$pass_con];
                if ($obj->update('user',$value,"user_id={$_SESSION['user_id']}")){
                    // redirect profile page
                    header("location: {$hostname}/view/profile.php");
                } 
            }
            }
           
        }

    }


?>