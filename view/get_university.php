<?php
include "../model/database.php";
$obj = new database();
$cat_id = $_POST['cat_id'];

$obj->select("university","*",null,"cat_id = {$cat_id}");
$resul_u = $obj->get_result();
    echo "<option value disabled selected>Select university</option>";
    foreach($resul_u as $row_con){ 
                echo '<option value=" '.$row_con['uni_id'].'">'. $row_con['uni_name'].'</option> ';
    } 
    
?> 
                    
