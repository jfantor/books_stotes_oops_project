<?php
include "../model/database.php";
$obj = new database();

$col_name = "user.user_id,user.user_name,user.user_email,user.user_role,user.user_img";

$order = "user_id DESC";
$obj->select("user",$col_name,null,null,$order);
$t_result = $obj->get_result();
$num_user = COUNT($t_result);





?>