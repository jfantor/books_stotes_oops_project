
<?php

//fetch_data.php

include ("../model/database.php");

$display = new database();



if(isset($_POST["action"])){
    $col_name = "*";
    $join = null;
    $order = null;
    $limit = 9;
    $page = 1;
    if(isset($_POST['page_id'])){
        $page = $_POST['page_id'];
    }


    $query = " all_condition = 0  
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
        if($_POST['radio']== "new" OR $_POST['radio']=="old"){
            $redio = $_POST['radio'];
            $query .= "
            AND b_condition ='{$redio}'
            ";
        }elseif($_POST["radio"]=="Hight_Price"){
            $order = " price DESC";
        }else{
            $order= " price ASC";
        }

    
    }
    //  echo $query;
    $display->select("books",$col_name,$join,$query,$order,$limit,$page);
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
                        
                </div>

                
                
                
                
                <script src="../controller/js/jquary.js"></script>
                        <script>
                            $(document).ready(function() { 
                                get_ajex ="2";
                                $(".pagination li button").click(function() {
                                    var get_ajex = $(this).val();
                                    $.ajax({
                                        url: "../controller/fetch_data.php",
                                        method: "POST",
                                        data: {
                                            get_ajex2: get_ajex
                    
                                        },
                                        success: function(data) {
                                            $(".s_book_ajex").html(data);
                                        }
                                    });
                                });
                        
                            });
                        </script>    
                
                ';
    }
    }
    else
    {
    $output = '<h3>No Data Found</h3>';
    }
    echo $output;
    $display->pagination_ajex('books',$join,$query,$limit,null,$page);
}


?>