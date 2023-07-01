<?php

include("../model/database.php");

$obj = new database();
$date="'2023-01'";
$i_date = 'jan';
$obj->select("books","post_date",null,"post_month = $date");
$all_post1 = $obj->get_result();
$num_post1 = COUNT($all_post1);

$date2="'2023-02'";
$i_date2 = '2023/02';
$obj->select("books","post_date",null,"post_month = $date2");
$all_post2 = $obj->get_result();
$num_post2 = COUNT($all_post2);

$date3="'2023-03'";
$i_date3 = '2023/03';
$obj->select("books","post_date",null,"post_month = $date3");
$all_post3 = $obj->get_result();
$num_post3 = COUNT($all_post3);

$date4="'2023-04'";
$i_date4 = '2023/04';
$obj->select("books","post_date",null,"post_month = $date4");
$all_post4 = $obj->get_result();
$num_post4 = COUNT($all_post4);

$date5="'2023-05'";
$i_date5 = '2023/05';
$obj->select("books","post_date",null,"post_month = $date5");
$all_post5 = $obj->get_result();
$num_post5 = COUNT($all_post5);

$date6="'2023-06'";
$i_date6 = '2023/06';
$obj->select("books","post_date",null,"post_month = $date6");
$all_post6 = $obj->get_result();
$num_post6 = COUNT($all_post6);


$date7="'2023-07'";
$i_date7 = '2023/07';
$obj->select("books","post_date",null,"post_month = $date7");
$all_post7 = $obj->get_result();
$num_post7 = COUNT($all_post7);


$date8="'2023-08'";
$i_date8 = '2023/08';
$obj->select("books","post_date",null,"post_month = $date8");
$all_post8 = $obj->get_result();
$num_post8 = COUNT($all_post8);

$date9="'2023-09'";
$i_date9 = '2023/09';
$obj->select("books","post_date",null,"post_month = $date9");
$all_post9 = $obj->get_result();
$num_post9 = COUNT($all_post9);

$date10="'2023-10'";
$i_date10 = '2023/10';
$obj->select("books","post_date",null,"post_month = $date10");
$all_post10 = $obj->get_result();
$num_post10 = COUNT($all_post10);

$date11="'2023-11'";
$i_date11 = '2023/11';
$obj->select("books","post_date",null,"post_month = $date11");
$all_post11 = $obj->get_result();
$num_post11 = COUNT($all_post9);

$date12="'2023-12'";
$i_date12 = '2023/12';
$obj->select("books","post_date",null,"post_month = $date12");
$all_post12 = $obj->get_result();
$num_post12 = COUNT($all_post12);




$obj->select("user","add_date",null,"add_month = $date");
$all_users = $obj->get_result();
$num_users = COUNT($all_users);

$obj->select("user","add_date",null,"add_month = $date2");
$all_users2 = $obj->get_result();
$num_users2 = COUNT($all_users2);

$obj->select("user","add_date",null,"add_month = $date3");
$all_users3 = $obj->get_result();
$num_users3 = COUNT($all_users3);

$obj->select("user","add_date",null,"add_month = $date4");
$all_users4 = $obj->get_result();
$num_users4 = COUNT($all_users4);

$obj->select("user","add_date",null,"add_month = $date5");
$all_users5 = $obj->get_result();
$num_users5= COUNT($all_users5);

$obj->select("user","add_date",null,"add_month = $date6");
$all_users6 = $obj->get_result();
$num_users6 = COUNT($all_users6);

$obj->select("user","add_date",null,"add_month = $date7");
$all_users7 = $obj->get_result();
$num_users7 = COUNT($all_users7);

$obj->select("user","add_date",null,"add_month = $date8");
$all_users8 = $obj->get_result();
$num_users8 = COUNT($all_users8);

$obj->select("user","add_date",null,"add_month = $date9");
$all_users9 = $obj->get_result();
$num_users9 = COUNT($all_users9);

$obj->select("user","add_date",null,"add_month = $date9");
$all_users9 = $obj->get_result();
$num_users9 = COUNT($all_users9);

$obj->select("user","add_date",null,"add_month = $date10");
$all_users10 = $obj->get_result();
$num_users10 = COUNT($all_users10);

$obj->select("user","add_date",null,"add_month = $date11");
$all_users11 = $obj->get_result();
$num_users11 = COUNT($all_users11);


$obj->select("user","add_date",null,"add_month = $date12");
$all_users12 = $obj->get_result();
$num_users12 = COUNT($all_users12);



?>