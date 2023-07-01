<?php
// include "../model/database.php";
include('../controller/get_graph_valu.php');
$obj= new database();

$obj->select("user","*");
$num_user = COUNT($obj->get_result());
$obj->select("user","*",null,"user_role = 1");
$num_admin = COUNT($obj->get_result());

$obj->select("books","*");
$num_post = COUNT($obj->get_result());
$carunt_date =  date("Y-m-d");
$newDate = date('Y-m-d', strtotime($carunt_date. ' + 3 months')); 

$obj->select("books","*",null,"post_date = '$newDate'");
$num_today_post = COUNT($obj->get_result());


?>

<div class="col-lg-3 col-md-3 col-sm-6">
    <div class="information_dtls user_info_des">
        <i class="fa fa-id-card"></i>
        <div class="information_text">
            <h2>users information</h2>
            <p class="total_users">total users : <span><?php echo $num_user; ?></span></p>
            <p class="admin">admin : <span><?php echo $num_admin; ?></span></p>
        </div>
    </div>
</div>
<div class="col-lg-3 col-md-3 col-sm-6">
    <div class="information_dtls all_posts">
    <i class="fa fa-newspaper"></i>
        <div class="information_text">
            <h2>posts details</h2>
            <p class="total_users">total post : <span><?php echo $num_post; ?></span></p>
            <p class="admin">today post : <span><?php echo $num_today_post; ?></span></p>
        </div>
    </div>
</div>
<div class="col-lg-3 col-md-3 col-sm-6">
    <div class="information_dtls">
        <i class="fa fa-id-card"></i>
        <div class="information_text">
            <h2>users information</h2>
            <p class="total_users">total users : <span>300</span></p>
            <p class="admin">admin : <span>5</span></p>
        </div>
    </div>
</div>
<div class="col-lg-3 col-md-3 col-sm-6">
    <div class="information_dtls">
        <i class="fa fa-id-card"></i>
        <div class="information_text">
            <h2>users information</h2>
            <p class="total_users">total users : <span>300</span></p>
            <p class="admin">admin : <span>5</span></p>
        </div>
    </div>
</div>
<div class="col-kg-12 col-md-12 col-12">
    <div class="graph">
        <div class="graph_header">
            <h4>user and post information graph</h4>
        </div>
        <canvas id="myChart" style="width:100%;max-width:70vw"></canvas>
    </div>
    <div class="graph_indicator">
        <div class="graph_user">
            <p>user : <span class="graph_user_span"></span></p>
        </div>
        <div class="graph_user">
            <p>post : <span class="graph_post_span"></span></p>
        </div>
    </div>
    

</div>

<script>

$(document).ready(function() {

            function lode_des_data(page_url){
                $.ajax({
                    url: page_url ,
                    success: function(data) {
                        $('.des_section').html(data);
                    }
                }); 
            }
            var user_url = 'user_information.php';
            $('.user_info_des').click(function() {
                lode_des_data(user_url);
            });

            var post_url = 'all_posts.php';
            $('.all_posts').click(function() {
                lode_des_data(post_url);
            });
          
            
      });
        var xValues = ['January','February','March','April','May','June','July','August','September','October','November','December'];

        new Chart("myChart", {
        type: "bar",
        data: {
            labels: xValues,
            datasets: [{ 
            data: [<?php echo $num_post1 ;?>,<?php echo $num_post2 ;?>,<?php echo $num_post3 ;?>,<?php echo $num_post4 ;?>,<?php echo $num_post5 ;?>,<?php echo $num_post6 ;?>,<?php echo $num_post7 ;?>,<?php echo $num_post8 ;?>,<?php echo $num_post9 ;?>,<?php echo $num_post10 ;?>,<?php echo $num_post11 ;?>,<?php echo $num_post12 ;?>],
            backgroundColor: "green"
            }, { 
            data: [<?php echo $num_users ;?>,<?php echo $num_users2 ;?>,<?php echo $num_users3 ;?>,<?php echo $num_users4 ;?>,<?php echo $num_users5 ;?>,<?php echo $num_users6 ;?>,<?php echo $num_users7 ;?>,<?php echo $num_users8 ;?>,<?php echo $num_users9 ;?>,<?php echo $num_users10 ;?>,<?php echo $num_users11 ;?>,<?php echo $num_users12 ;?>],
            backgroundColor: "blue"
            }]
        },
        options: {
            legend: {display: false}
        }
        });
</script>