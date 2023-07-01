<?php
    include_once("../model/database.php");
    session_start();

    $obj = new database();
    $obj->select("university","*",null,null,"nop DESC");
    $result1 = $obj->get_result();
    $display = $result1;
// $order= "books.b_id DESC";
    $obj->select("department","*",null,null,"nop DESC");
    $result1 = $obj->get_result();
    $display1 = $result1;

    $obj->select("subject","*",null,null,"nop DESC");
    $result1 = $obj->get_result();
    $display2 = $result1;
?>