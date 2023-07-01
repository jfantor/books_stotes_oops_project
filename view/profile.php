<?php
 
 include("../controller/save&update_profile.php");
// session_start();
 
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/profile.css">
    <link rel="stylesheet" href="css/popup.css">
    <link rel="stylesheet" href="css/users_post.css">

    <?php
        include_once("header.php");
    ?>

    <section class = "profile_section">
        <div class="container profile_con">
            <div class="col-md-3 col-lg-3">
                <div class="profile-name">
                    <div class="sidebar__info_img"> <?php //echo $_SESSION["user_pic"]; echo $_SESSION["users_id"]; ?>
                        <img class="img-fluid rounded-circle" src="<?php echo $hostname;?>/uplode/<?php if(empty($_SESSION["user_pic"])){
                                        echo "defult.jpg";
                                    }else{
                                        echo $_SESSION["user_pic"];
                                    } ?>" alt="" width="50px">

                    </div>
                    <div class="sidebar__info">
                        <p>Hello,</p>
                        <h3><?php echo $_SESSION["username"] ; ?></h3>
                    </div>
                </div>
                <div class="side_bar_manu">
                    <ul class = "ul_manu">
                        <li class = "account my_profile"><a href="#">my account</a></li>
                        <hr>
                        <li class = "account my_post"><a href="#">my post</a></li>
                        <hr>
                        <li class = "account" id="open_post"><a href="#">add post</a></li>
                        <hr>
                        <?php if($_SESSION['user_role'] == 1){?>
                        <li class = "account deshbord_open"><a href="deshbord.php">deshbord</a></li>
                        <hr>
                        <?php } ?>
                        
                        <li class = "account"><a href="../controller/logout.php">log out</a></li>

                    </ul>
                </div>
            </div>
            <div class="col-md-9 col-lg-9">
                <div class="profile-info">




                </div>
            </div>
        </div>
    </section>
    <div class="popup_box" id="popup_box">
        <?php
            include_once('popup.php');
        ?>
    </div>
    <script src="../controller/js/jquary.js"></script>
    <script>
        $(document).ready(function() {
            var update = "save";
            $.ajax({
                    url: "profile_details.php",
                    method: "POST",
                    data: {
                        ins:update
                    },
                    success: function(data) {
                        $(".profile-info").html(data);
                    }
                });
            $(".my_profile").click(function() {
                var update = "save";
                $.ajax({
                    url: "profile_details.php",
                    method: "POST",
                    data: {
                        ins:update
                    },
                    success: function(data) {
                        $(".profile-info").html(data);
                    }
                });
            });
            $(".my_post").click(function() {
                var update = "save";
                console.log(update);
                $.ajax({
                    url: "user_post.php",
                    method: "POST",
                    data: {
                        ins:update
                    },
                    success: function(data) {
                        $(".profile-info").html(data);
                    }
                });
            });
        });
        </script>

<?php include_once("footer.php");?>