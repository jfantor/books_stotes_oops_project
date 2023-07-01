<?php
    include "../model/database.php";
    $obj = new database();
    // if(isset($_POST['login'])){
    if(empty($_POST['get_user_name']) || empty($_POST['get_user_pass'])){
        echo '<div class="alert alert-danger">All Fields must be entered.</div>';
        die();
    }else{
        $username =  $_POST['get_user_name'];
        $password = md5($_POST['get_user_pass']);

        $join =null;
        $col_name = "user_id, user_name,user_role,user_img";
        $limit= null;
        $order= null;
        $where = " user_name = '{$username}' AND user_pass= '{$password}'"; 

        $obj->select('user',$col_name,$join,$where);

        $result = $obj->get_result();

        if(COUNT($result) > 0){

        foreach($result as $row){

          session_start();
            $_SESSION["username"] = $row['user_name'];
            $_SESSION["user_id"] = $row['user_id'];
            $_SESSION["user_role"] = $row['user_role'];
            $_SESSION["user_pic"] = $row['user_img'];
            
          header("Location: {$hostname}/view/profile.php");
         
        }
        // header("Location: {$hostname}/view/profile.php");
        }else{
        
        // header("Location: {$hostname}/view/sign_up.php");
        echo "<div class='alert alert-danger alert-dismissible col-md-10 ml-4 mt-1'>
                Username and Password are not matched.
                <button class='close' type='submit' name='unset_session' data-dismiss='alert'>&times;</button>
            </div>";
    }
    }
    // }
?>