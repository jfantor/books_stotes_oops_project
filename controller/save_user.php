
<?php

include("../model/database.php");
$obj = new DataBase(); 
$massage = '';

if(isset($_POST['register'])){

    $fname =$_POST['fname'];
    $lname = $_POST['lname'];
    $user = $_POST['user_name'];
    $email =$_POST['email'];
    $password =$_POST['password'];

    $con_pass = $_POST['confirmPassword']; 
    $role ="user";
    $user_month = date("Y-m");
   


    $obj->select('user',"user_email",null,"user_email = '{$email}' OR user_name = '{$user}'");


    $result =  $obj->get_result();
    // echo $result;

    if(COUNT($result)> 0){
      $massage =  " UserEmail Or UserName already Exists.";
      return $massage;
      header("Location: {$hostname}/view/sign_up.php");
    }else{
        // $obj->Img_Up("fileToUpload","../uplode/");
        // $result = $obj->Img();
        // $file_name = $result[0];
        if($password == $con_pass){
            $password = md5($password);
            $value = ["user_f_name"=>$fname,"user_l_name"=>$lname,"user_name"=>$user,"user_email"=>$email,"user_pass"=>$password,"user_role"=>$role,"add_month"=>$user_month];
            
            if($obj->insert('user',$value)){
                if(isset($_SESSION)){
                    if($_SESSION['user_role'] == 1){
                        header("Location: {../view/deshbord.php}");
                    }else{
                        if(isset($_SESSION["username"])){
                            header("Location: {$hostname}/controller/profile.php");
                        }else{
                            // $username =  $_POST['username'];
                            // $password = md5($_POST['password']);
                
                            $join =null;
                            $col_name = "user_id, user_name, user_role,user_img";
                            $limit= null;
                            $order= null;
                            $where = " user_name = '{$user}' AND user_pass= '{$password}'"; 
                    
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
                            }
                        } 
                    }
                }else{
                    if(isset($_SESSION["username"])){
                    header("Location: {$hostname}/controller/profile.php");
                }else{
                    // $username =  $_POST['username'];
                    // $password = md5($_POST['password']);
        
                    $join =null;
                    $col_name = "user_id, user_name, user_role,user_img";
                    $limit= null;
                    $order= null;
                    $where = " user_name = '{$user}' AND user_pass= '{$password}'"; 
            
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
                    }
                }
                }
                
            }else{
                $massage = "Can't Insert User.";
                return $massage;
                header("Location: {$hostname}/view/sign_up.php");
            } 
        }else{
          $massage =  "password and conferm password not masd";
          return $massage;
          header("Location: {$hostname}/view/sign_up.php");
        }
    
    }
}
?>