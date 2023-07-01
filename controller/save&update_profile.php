<?php
include_once("../model/database.php");
session_start();

$obj = new database();

$user = $_SESSION["user_id"];
$obj->select("user","*",null,"user.user_id = $user");
$result1 = $obj->get_result();
$users = $result1[0];

// echo "<pre>";
// print_r ($users);
// echo "</pre>";
// fetch data from university tabale



$obj->select("subject","*");
$resul_sub = $obj->get_result();
$subject = $resul_sub;

$obj->select("category","*");
$resul_cat = $obj->get_result();
$category = $resul_cat;

$obj->select("department","*");
$resul_dep = $obj->get_result();
$department = $resul_dep;

$obj->select("university","*");
$uni = $obj->get_result();

// echo "<pre>";
// print_r ($subject);
// echo "</pre>";

// $col_name = "user.user_id, user.user_name, user.user_email,user.user_mobile ,user.dob ,user.pass,user.year,user.date";
// $join ="subject ON user.sub_id = subject.sub_id ";

$col_name = "user.user_id, user.user_name, user.user_email,user.user_mobile ,user.user_pass,user.semester";
if($users['sub_id'] != null){
    $col_name .= ",subject.sub_name";
}
if($users['uni_id'] != null){
    $col_name .= ",university.uni_name,university.uni_id";
}




$join ="";
if($users['sub_id'] != null){
    $join .= " JOIN subject ON user.sub_id = subject.sub_id ";
}
// echo $join;
if($users['uni_id'] != null){
    $join .= "JOIN university ON user.uni_id = university.uni_id ";
}


// echo $join;
$where = "user.user_id = $user";
$obj->select('user',$col_name,$join,$where);
$result = $obj->get_result();
$result = $result[0];

?>