
<?php

include("show_user_data.php");
// include ("../view/index.php");
$display = new database();
// if(isset($_POST['get_value'])){
//     print_r($_POST['get_value']);
// }else{
//     echo "value not fount";
// }


// $display->sql($query);
// $result_s = $display->get_result();

// print_r($result_s);title LIKE '%".$search."%



if(isset($_POST["query"])){
     if(is_array($_POST["query"])){
        $get_array = $_POST["query"];
        $search = $get_array[1];
        // echo gettype($search);
        // print_r($search);
        $col_name = "books.b_id,books.b_name,books.price,books.img_1,books.b_des,books.author,category.cat_name,department.dep_name,university.uni_name,
        subject.sub_name";
        $join = "JOIN category ON books.cat_id = category.cat_id JOIN department ON books.department = department.dep_id JOIN subject ON books.sub_id =
        subject.sub_id JOIN university ON books.uni_id = university.uni_id";
        $where="books.b_name LIKE '%".$search."%' OR books.b_des LIKE '%".$search."%' OR books.author LIKE '%".$search."%'
        OR category.cat_name LIKE '%".$search."%' OR department.dep_name LIKE '%".$search."%' OR university.uni_name LIKE '%".$search."%'
        OR subject.sub_name LIKE '%".$search."%'";
        $limit =9;
        $order = "b_id DESC";
    }else{
    //   $query = "SELECT * FROM books ORDER BY b_id DESC";
    $col_name="*";
    $join = null;
    $where=null;
    $limit = 9;
    $order = "b_id DESC";
 }
}
 if(isset($_POST["query"])){
    if(is_array($_POST["query"])){
        $get_array = $_POST["query"];
        $page = $get_array[0];
    }else{
        $page = $_POST["query"]; 
    }

 }

   


// echo $_POST["query"];
 $display->select("books",$col_name,$join,$where,$order,$limit,$page);
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
 $obj->pagination_ajex('books',$join,$where,$limit,null,$page);
 
//  header("Location: {$hostname}/view/index.php");


?>