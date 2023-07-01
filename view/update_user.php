
<?php

//fetch_data.php

include ("../model/database.php");

$display = new database();

if(isset($_POST["action"]))
{
//   print_r ($_POST["university"]);
//   echo $_POST["maximum_price"];
 $query = "
  SELECT * FROM books WHERE all_condition = 0  
 ";
//  if(isset($_POST["minimum_price"], $_POST["maximum_price"]) && !empty($_POST["minimum_price"]) && !empty($_POST["maximum_price"]))
//  {
//   $query .= "
//    AND product_price BETWEEN '".$_POST["minimum_price"]."' AND '".$_POST["maximum_price"]."'
//   ";
//  }
 if(isset($_POST["university"]))
 {
  $university_filter = implode("','", $_POST["university"]);
  $query .= "
  AND uni_id IN('".$university_filter."')
  ";
 }
 if(isset($_POST["department"]))
 {
  $dep_filter = implode("','", $_POST["department"]);
  $query .= "
   AND department IN('".$dep_filter."')
  ";
 }
 if(isset($_POST["subject"]))
 {
  $sub_filter = implode("','", $_POST["subject"]);
  $query .= "
   AND sub_id IN('".$sub_filter."')
  ";
 }
 if(isset($_POST["radio"])){
    // $redio = $_POST['radio'];
    // $query .= "
    // AND b_condition ='{".$redio."}')
    // ";
    if($_POST['radio']== "new" OR $_POST['radio']=="old"){
         $redio = $_POST['radio'];
        $query .= "
        AND b_condition ='{$redio}'
        ";
    }elseif($_POST["radio"]=="Hight_Price"){
        $query .= "ORDER BY price DESC";
    }else{
        $query .= "ORDER BY price ASC";
    }

 
 }
//  echo $query;

 $display->sql($query);
 $result = $display->get_result();

 $total_row = COUNT($result);
 $output = '';
 if($total_row > 0)
 {
  foreach($result as $row)
  {
   
   $output .= '<div class="col-md-4 col-lg-4 col-6">
                    <div class="singel_post">
                        <a href="singel_post.php?id='.$row["b_id"] .'">
                            <div class="post_ing">
                                <img src="../uplode/'. $row["img_1"] .'" alt="post image">
                            </div>
                            <div class="singel_book_info">
                                <p class="s_book_name">'.  $row["b_name"] .'</p>
                                <p class="s_writer_name">'. $row["author"].'</p>
                                <p class= "s_book_price">tk. ' . $row["price"].'</p>
                            </div>
                        </a>
                    </div>
            </div>';
  }
 }
 else
 {
  $output = '<h3>No Data Found</h3>';
 }
 echo $output;
}


?>