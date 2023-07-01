<?php
include "../model/database.php";
$obj = new database();
if(isset($_POST['save'])){
    $user_id =$_POST['user_id'];
    $f_name = $_POST["fname"];
    $lname = $_POST["lname"];
    $u_name = $_POST["u_name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $university = $_POST["university"];
    $department = $_POST["department"];
    $semester = $_POST["semester"];
    $subject = $_POST["subject"];
    $user_role = $_POST["user_role"];
    // $img = $_POST["img"];
    // $img_name = substr($img,12);
    

    // $obj->Img_Up($img_name,"../uplode/");
    // $result = $obj->Img();
    // $file_name = $result[0];

    $value = ["user_f_name"=>$f_name,"user_l_name"=>$lname,"user_name"=>$u_name,"user_email"=>$email,"user_mobile"=>$phone,"uni_id "=>$university,"dep_id "=>$department,"sub_id "=>$subject,"semester "=>$semester
    ,"user_role "=>$user_role];

    if($obj->update('user',$value,"user_id=$user_id")){
        echo " <div class='success'>
            <p>User information update successfully .</p>
        </div>";
    }else{
        echo "  <div class='error'>
            <p> can't update User information .</p>
        </div>";
    }


}

?>