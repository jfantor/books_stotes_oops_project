<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>books information</title>
    <link rel="stylesheet" href="css/singel_post.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">


<?php


session_start();
    include_once("header.php");
    include ("../model/database.php");
    $obj = new database();

    $post_id = $_GET['id'];
    $join ="JOIN subject ON books.sub_id = subject.sub_id JOIN university ON books.uni_id = university.uni_id
     JOIN user ON books.user_id = user.user_id JOIN category ON books.cat_id = category.cat_id JOIN department ON
     books.department=department.dep_id ";
    $col_name = "books.b_id,books.b_name,books.b_des,books.img_1,books.img_2,books.img_3,books.price,books.b_condition,
    books.sub_id,books.author,books.post_date,user.user_name,subject.sub_name,university.uni_name,category.cat_name,department.dep_name";
    $limit= null;
    $where = "books.b_id = {$post_id}";
    $obj->select('books',$col_name,$join,$where);
    $result = $obj->get_result();
    $result = $result[0];

    $where1 = "books.sub_id = {$result['sub_id']}";
    $order= "books.b_id";
    $obj->select('books',"books.b_id,books.img_1,books.b_name,books.author,books.price",null,$where1,$order);

    $side_info = $obj->get_result();

    // print_r($side_info);

?>


<div class="singel_post_information">
    <div class="container">


        <section class="singel_post_deteils" id = "singel_post_deteils">
            <div class="book_deteils_info">
                <div class="container">
                    <div class="row deteils_info_row">
                        <div class="col-md-9 col-lg-9 col-9">
                            <div class="containers">
                                <div class="row book_deteils_information">
                                    <div class="col-md-5 col-lg-5 col-5">
                                        <div class="full_size_img_info">
                                            <div class="full_img">
                                                <div class="w3-content w3-display-container">
                                                    <img class="mySlides" src="../uplode/<?php echo $result['img_1']; ?>" style="width:100%">
                                                    <img class="mySlides" src="../uplode/<?php echo $result['img_2']; ?>" style="width:100%">
                                                    <img class="mySlides" src="../uplode/<?php echo $result['img_3']; ?>" style="width:100%">

                                                    <button class="w3-button w3-black w3-display-left" onclick="plusDivs(-1)">&#10094;</button>
                                                    <button class="w3-button w3-black w3-display-right" onclick="plusDivs(1)">&#10095;</button>
                                                </div>
                                                <!-- <img src="../uplode/<?php //echo $result['img_1']; ?>" alt="post image"> -->
                                            </div>
                                        </div>
                                    </div>
                            
                                    <div class="col-md-7 col-lg-7 col-7">
                                        <div class="singel_information">
                                            <h3 class="book_name_info"><?php echo $result['b_name']; ?></h3>
                                            <p class="book_writer_name_info">by: <span><a href="#"><?php echo $result['author']; ?></a></span></p>
                                            <p class="book_writer_name_info">category : <span><a href="#"><?php echo $result['cat_name']; ?></a></span></p>
                                            <p class="book_writer_name_info"><i class="fa fa-user" aria-hidden="true"></i>: <span><a href="#"><?php  echo $result['user_name']; ?></a></span></p>
                                            <p class="book_writer_name_info">time of post : <span><a href="#"><?php 
                                                $db_date=$result['post_date'];
                                                $start_date = $db_date;  
                                                $date = strtotime($start_date);
                                                $date = strtotime("-3 month", $date);
                                                $finel_date =  date('Y-m-d', $date);
                                                echo $finel_date;
                                             ?></a></span></p>
                                            <p class="price_of_book ">tk. <span><?php echo $result['price']; ?></span></p>
                                            <a href="#" class = 'call_btn'><p class="call">call</p></a>
                                            <a href="#" class="chat_btn"><p class="chat">chat</p></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="chate_section_or_mail">
                            <div class="container email_con">
                            <i class="fa fa-times close_email" aria-hidden="true"></i>
                                <div class="contact_by_messanger">
                                    <a href="#">contact by messanger</a>
                                </div>
                                <div class="sand_email">
                                    <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
                                        <div class="email_input">
                                            <label for="email">email :</label>
                                            <input type="email" name="email_address" id="email_add" placeholder = "enter your email .">
                                        </div>
                                        <div class="subject">
                                            <label for="subject">subject :</label>
                                            <input type="text" name="email_subject" id="email_subject" placeholder = "subject of this mail">
                                        </div>
                                        <div class="email_conseft">
                                            <label for="conseft">consect :</label>
                                            <input type="text" name="email_cons" id="email_cons" placeholder = "email conseft">
                                        </div>
                                        <input type="submit" value="sand" name="save" class ="email_submit">
                                        
                                    </form>
                                    
                                </div>
                            </div>
                        </div>

                        <div class="col-3 col-md-3 col-lg-3">
                            <div class="side_bar_related_book">
                                <div class="side_bar_information">
                                    <h5 class="side_bar_title">related books</h5>
                                    <div class="side_bar_list">
                                        <div class="side_bar_list_item">
                                            <?php foreach($side_info as $side_row){ ?>
                                            <a href="singel_post.php?id=<?php echo $side_row['b_id']; ?>" >
                                                <div class="side_bar_book_img" id="side_bar_book_img">
                                                <img src="../uplode/<?php echo $side_row['img_1'] ?>" alt="books image" class="side_bar_book_img">
                                                </div>
                                                <div class="side_bar_books_des">
                                                    <p class="side_bar_books_name"><?php echo $side_row['b_name'] ?></p>
                                                    <p class="side_bar_writer_name"><?php echo $side_row['author'] ?></p>
                                                    <p class = "side_bar_book_price"><?php echo $side_row['price'] ?></p>
                                                </div>
                                            </a>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>

        </section>

    
        <section class="book_spacipucation">
            <div class="book_spacipication_section">
                <div class="book_spacipication_header">
                    <h2>book details & summary</h2>
                </div>
                <div class="book_informarion_section">
                    <div class="details_manu">
                        <ul>
                            <li id='book_info_tab' class = "active_manu">book</li>
                            <li id = 'book_des_tab'>description</li>
                        </ul>
                    </div>
                    <div class="book_des_table" id="book_des_table">
                        <table class="description_table">
                            <tr>
                                <td class="td_name">book title</td>
                                <td class="td-des"><?php echo $result['b_name']; ?></td>
                            </tr>
                            <tr>
                                <td class="td_name">Author</td>
                                <td class="td-des"><a href="#"><?php echo $result['author']; ?></a></td>
                            </tr>
                            <tr>
                                <td class="td_name">subject</td>
                                <td class="td-des"><a href="#"><?php echo $result['sub_name']; ?></a></td>
                            </tr>
                            <tr>
                                <td class="td_name">university</td>
                                <td class="td-des"><a href="#"><?php echo $result['uni_name']; ?></a></td>
                            </tr>
                            <tr>
                                <td class="td_name">condition</td>
                                <td class="td-des"><a href="#"><?php echo $result['b_condition']; ?></a></td>
                            </tr>

                        </table>
                    </div>
                    <div class="descrioption_of_book" id="description_of_book">
                        <p>
                            <?php echo $result['b_des']; ?>
                        </p>
                    </div>
                </div>
            </div>
        </section>
    </div>
 </div> 
 <script src="../controller/js/jquary.js"></script>
 <script>
var slideIndex = 1;
showDivs(slideIndex);

function plusDivs(n) {
  showDivs(slideIndex += n);
}

function showDivs(n) {
  var i;
  var x = document.getElementsByClassName("mySlides");
  if (n > x.length) {slideIndex = 1}
  if (n < 1) {slideIndex = x.length}
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";  
  }
  x[slideIndex-1].style.display = "block";  
}

    $(document).ready(function() {
        $('.chat_btn').click(function(){
            $('.chate_section_or_mail').show(800);
        });
        $('.close_email').click(function(){
            $('.chate_section_or_mail').hide(800);
        });
    });
</script>
<?php
// echo "savefghddfghdfghdfhdgdfghhfgrtthdfgsdfgdgsg";

// if(isset($_POST['save'])){
//     echo "savefghddfghdfghdfhdgdfghhfgrtthdfgsdfgdgsg";
// }

// $to      = 'jfantor2@gmail.com';
// $subject = 'the subject';
// $message = 'hello';
// $headers = 'From: jfantor3@gmail.com'       . "\r\n" .
//              'Reply-To: jfantor3@gmail.com' . "\r\n" .
//              'X-Mailer: PHP/' . phpversion();

// mail($to, $subject, $message, $headers);
include_once("footer.php");

?>