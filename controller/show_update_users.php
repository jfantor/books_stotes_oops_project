<?php
include_once("../model/database.php");
session_start();

$obj = new database();

$obj->select("university","*");
$resul_u = $obj->get_result();
$uni = $resul_u;


$obj->select("subject","*");
$resul_sub = $obj->get_result();
$subjects = $resul_sub;

$obj->select("category","*");
$resul_cat = $obj->get_result();
$category = $resul_cat;

$obj->select("department","*");
$resul_dep = $obj->get_result();
$department = $resul_dep;

$user = $_POST['user_id'];
// echo $user;

$obj->select("user","*",null,"user.user_id = $user");
$result1 = $obj->get_result();
$users = $result1[0];
$col_name = "user.user_id,user.user_f_name,user.user_l_name, user.user_name, user.user_email ,user.user_pass,user.user_img,user.add_date";
$join ="";
if($users['sub_id'] != null){
    $col_name .= ",subject.sub_name";
}
if($users['uni_id'] != null){
    $col_name .= ",university.uni_name";
}
if($users['dep_id'] != null){
    $col_name .= ",department.dep_name";
}
if($users['semester'] != null){
    $col_name .= ",user.semester";
}
if($users['user_mobile'] != null){
    $col_name .= ",user.user_mobile";
}





if($users['sub_id'] != null){
    $join .= " JOIN subject ON user.sub_id = subject.sub_id ";
}
// echo $join;
if($users['uni_id'] != null){
    $join .= "JOIN university ON user.uni_id = university.uni_id ";
}
if($users['dep_id'] != null){
    $join .="JOIN department ON user.dep_id = department.dep_id";
    
}



// echo $join;
$where = "user.user_id = $user";
$obj->select('user',$col_name,$join,$where);
$result = $obj->get_result();
$result = $result[0];

if(empty($result['user_img'])){
    $img = "defult.jpg";
}else{
    $img = $result["user_img"];
}
if($users['uni_id'] != null){
    $universuty = $result['uni_name'];
    $uni_id = $users['uni_id'];
}else{ 
    $uni_id ='';
    $universuty ="select versity name ";
}
 if($users['semester'] != null){
    $semester_val = $users['semester'];
    $semester = $users['semester']." semester";
}else{ 
    $semester = "select semester ";
    $semester_val ="";
}
 if($users['dep_id'] != null){
    $depertment = $result['dep_name'];
    $dep_id = $users['dep_id'];
}else{ 
    $depertment = "select depertment ";
    $dep_id = '';
}
if($users['sub_id'] != null){
    $subject = $result['sub_name'];
    $sub_id = $users['sub_id'];
}else{ 
    $subject = "select subject name ";
    $sub_id = '';
}
if($users['user_role']==1){
    $role = "admin";
}else{
    $role ="user";
}
if($users['user_mobile'] != null){
    $phone = " value =".$result['user_mobile'];
    
}else{ 

    $phone = "placeholder='enter your phone number .'";
}

$output = '<div class="col-md-12 col-lg-12 col-12">
    <div class="updete_header">
        <div class="url_section">
            <h2>users</h2>
            <a href="#">profile >></a>
            <a href="#">desbord >></a>
            <a href="#">users information >></a>
        </div>
        <div class="outhor_section">
            <a href="#" class="add_users">add users</a>
        </div>
    </div>
</div>
<div class="col-md-12 col-lg-12 col-12">
    <div class="row">
        <div class="col-md-5 col-lg-4 col-sm-12">
            <div class="up_user_info_1">
                <div class="user_img">
                    <img src="../uplode/'. $img.'" alt="user img">
                </div>
                <div class="user_info_name">
                    <h3>'.$result['user_name'].'</h3>
                </div>
                <div class="user_info_sub">
                    <p class = "up_user_email"><span>user email :</span> '.$result['user_email'].'</p>
                    <p class="join_date"><span>date of Join :</span>'.$result['add_date'].'</p>
                </div>
            </div>
            <div class="get_massage">
            </div>
            
        </div>
        <div class="col-md-7 col-lg-8 col-12">
            <div class="up_info_section">
                <div class="up_info_section_header">
                    <h1>user information</h1>
                   <hr>
                </div>
                <div class="up_info_details">
                    <form action="#" method="post">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-12 input_div">
                                <label for="f_name">first name :</label>
                                <input type="text" name="f_name" id="fname" class="name" value = "'.$result['user_f_name'].'">
                            </div>
                            <div class="col-lg-6 col-md-6 col-12 input_div">
                                <label for="f_name">last name :</label>
                                <input type="text" name="l_name" id="lname" class="name" value ="'.$result['user_l_name'].'">
                            </div>
                            <div class="col-lg-12 col-md-12 col-12 input_div">
                                <label for="email">user name :</label>
                                <input type="text" name="user_name" id="user_name" value ="'.$result['user_name'].'">
                            </div>
                            <div class="col-lg-12 col-md-12 col-12 input_div">
                                <label for="email">email :</label>
                                <input type="email" name="email" id="email" value ="'.$result['user_email'].'">
                            </div>
                            <div class="col-lg-12 col-md-12 col-12 input_div" ">
                                <label for="phone">mobile :</label>
                                <input type="text" name="phone" id="phone" '.$phone.'>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12 input_div">
                                <label for="university">university :</label>
                                <select name="university" id="uniersity">
                                    <option value="'.$uni_id .'" selected="">'.$universuty.'</option>';
                                    foreach($uni as $row){
                                        $output .= '<option value="'.$row['uni_id'].'">'.$row['uni_name'].'</option>';
                                    }
                               $output .=' </select>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12 input_div">
                                <label for="department">department :</label>
                                <select name="department" id="department">
                                    <option value="'.$dep_id.'" selected="" >'.$depertment.'</option>';
                                    foreach($department as $row){
                                        $output .= '<option value="'.$row['dep_id'].'">'.$row['dep_name'].'</option>';
                                    }
                               $output .='
                                </select>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12 input_div">
                                <label for="semester">semester :</label>
                                <select name="semester" id="semester">
                                    <option value="'.$semester_val.'"  selected="">'.$semester.'</option>
                                    <option value="1st">1st semester</option>
                                    <option value="2nd">2nd semester</option>
                                    <option value="3rd">3rd semester</option>
                                    <option value="4th">4th semester</option>
                                </select>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12 input_div">
                                <label for="subject">subject :</label>
                                <select name="subject" id="subject">
                                    <option value="'.$sub_id.'" selected="">'.$subject.'</option>';
                                    foreach($subjects as $row){
                                        $output .= '<option value="'.$row['sub_id'].'">'.$row['sub_name'].'</option>';
                                    }
                               $output .='
                                </select>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12 input_div">
                                <label for="user_role">user role :</label>
                                <select name="user_role" id="user_role">
                                    <option value="'.$users['user_role'].'" disabled="" >'.$role.'</option>
                                    <option value="1">admin</option>
                                    <option value="0">user</option>
                                </select>
                                <input type="hidden" name="user_id" id="u_id" class="name" value = "'.$result['user_id'].'">
                            </div>

                            <div class="col-lg-12 col-md-12 col-12 input_div">
                            
                                <p id="save_up"  class="name" >save</p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
$(document).ready(function() {

    $("#save_up").click(function() {
        var user_id = $("#u_id").val();
        var fname = $("#fname").val();
        var lname = $("#lname").val();
        var u_name = $("#user_name").val();
        var email = $("#email").val();
        var phone = $("#phone").val();
        var university = $("#uniersity").val();
        var department = $("#department").val();
        var semester = $("#semester").val();
        var subject = $("#subject").val();
        var user_role = $("#user_role").val();
        var save = "save";
        // console.log(university);
        $.ajax({
            url: "../controller/update_users.php",
            method: "POST",
            data: {
                user_id:user_id,
                fname : fname,
                lname : lname,
                u_name : u_name,
                email:email,
                phone:phone,
                university:university,
                department:department,
                semester:semester,
                subject:subject,
                user_role :user_role,
                save:save

            },
            success: function(data) {
                $(".get_massage").html(data);
            }
        });
    });
   
});
</script>

';

echo $output;
?>

