<?php
include_once('../model/database.php');
$obj = new DataBase(); 


if(isset($_POST['save'])){

    $obj->Img_Up('image_name1',"../uplode/");
    $result1 = $obj->Img();
    $file_name1 = $result1[0];

    $obj->Img_Up('image_name2',"../uplode/");
    $result2f = $obj->Img();
    $file_name2 = $result2f[0];

    $obj->Img_Up('image_nam3',"../uplode/");
    $result3f = $obj->Img();
    $file_name3 = $result3f[0];

  session_start();
  $category = $_POST['category'];
  $uversity_id = $_POST['university'];
  $depertment = $_POST['depertment'];
  $semester = $_POST['select_semester_name'];
  $subject = $_POST['subject_id'];
  $condition = $_POST['condition'];
  $author = $_POST['author'];
  $book_name = $_POST['book_name'];
  $book_des = $_POST['bookdesc'];
  $price = $_POST['price'];

  $start_date = date("Y-m-d");  
  $date = strtotime($start_date);
  $date = strtotime("+3 month", $date);
  $finel_date =  date('Y-m-d', $date);

  $post_month = date("Y-m");

  $value = ["b_name"=>$book_name,"b_des"=>$book_des,"author"=>$author,"cat_id"=>$category,
  "sub_id"=>$subject,"uni_id"=>$uversity_id,"user_id"=>$_SESSION["user_id"],"department "=>$depertment,'price '=>$price,
  "img_1"=>$file_name1,"img_2"=>$file_name2,"img_3"=>$file_name3,"semester "=>$semester ,"b_condition"=>$condition,"post_date"=>$finel_date,"post_month"=>$post_month ];


  if($obj->insert('books',$value)){
    $sql="UPDATE subject set nop=nop + 1 where sub_id={$subject}";
    if ($obj->sql($sql)){
      $sql1="UPDATE user set nop=nop + 1 where user_id={$_SESSION["user_id"]}";
      if($obj->sql($sql1)){
        $sql2="UPDATE department set nop=nop + 1 where dep_id={$depertment}";
        if($obj->sql($sql2)){
          $sql3="UPDATE university set nop=nop + 1 where uni_id={$uversity_id}";
          if($obj->sql($sql3)){
            $sql4="UPDATE category set nop=nop + 1 where cat_id={$category}";
            if($obj->sql($sql4)){
                // redirect profile page
                header("location: {$hostname}/view/profile.php");
            }
          }
        }      
      }
    }

  }

}else{
  echo "cant post";
}
  
 echo "<pre>";
    print_r($value);
  echo "</pre>";
// echo "ojrof";



//     // header("location: {$hostname}/view/profile.php");
// }



 ?>