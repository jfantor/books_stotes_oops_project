<?php 
include('../controller/get_graph_valu.php');
session_start();
if($_SESSION["user_role"]!=1){
    header("Location: {$hostname}/view/profile.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/deshbord.css">
    <link rel="stylesheet" href="css/user_info.css">
    <link rel="stylesheet" href="css/update_user.css">
    <link rel="stylesheet" href="css/update_post.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>


<?php
include("header.php");


?>
<section class="deshbord" id="desbord">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-1 col-md-1">
                <div class="des_navigation_bar">
                    <div class="des_manu_bar">
                    <ul>
                        <li class ="desh_bord">
                            <a href="deshbord.php">
                            <i class="fa fa-chart-line"></i>
                            <label for="desbord">deshbord</label>
                            </a>
                        </li>
                        <li class ="user_info">
                            <i class="fa fa-address-card-o" aria-hidden="true"></i>
                            <label for="users">users info</label>
                        </li >
                        <li class ="all_posts">
                            <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                            <label for="users">posts</label>
                        </li>
                        <li class ="cetagory">
                            <i class="fa fa-th" aria-hidden="true"></i>

                            <label for="users">cetagory</label>
                        </li>
                        <li class ="university">
                            <i class="fa fa-graduation-cap" aria-hidden="true"></i>
                            <label for="users">university</label>
                        </li>
                        <li class ="department">
                            <i class="fa fa-sitemap" aria-hidden="true"></i>

                            <label for="users">department</label>
                        </li>
                        <li class ="subject">
                            <i class="fa fa-book" aria-hidden="true"></i>

                            <label for="users">subject</label>
                        </li>

                    </ul>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-11 col-md-11">
                <div class="container">
                    <div class="row des_section">

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
    <script src="../controller/js/jquary.js"></script> 
    <script src="../controller/js/min.js"></script>
    <script type="text/javascript">      
      $(document).ready(function() {
            var page_url = 'des_section.php';
            lode_des_data(page_url);
            function lode_des_data(page_url){
                $.ajax({
                    url: page_url ,
                    success: function(data) {
                        $('.des_section').html(data);
                    }
                }); 
            }
        
            $('.desh_bord').click(function() {
                lode_des_data(page_url);
            });
            var user_url = 'user_information.php';
            $('.user_info').click(function() {
                // console.log(user_url);
                lode_des_data(user_url);
            });

            var post_url = 'all_posts.php';
            $('.all_posts').click(function() {
                // console.log(user_url);
                lode_des_data(post_url);
            });

            var cat_url = 'cetagory.php';
            $('.cetagory').click(function() {
                // console.log(user_url);
                lode_des_data(cat_url);
            });
            var uni_url = 'university.php';
            $('.university').click(function() {
                // console.log(user_url);
                lode_des_data(uni_url);
            });
            var dep_url = 'department.php';
            $('.department').click(function() {
                // console.log(user_url);
                lode_des_data(dep_url);
            });

            var sub_url = 'subject.php';
            $('.subject').click(function() {
                // console.log(user_url);
                lode_des_data(sub_url);
            });     
      });   
      
      

    </script>





<?php
include("footer.php");
?>