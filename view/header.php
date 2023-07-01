    <?php
// echo $_SERVER['REQUEST_URI'];
    ?>
    <!-- <script src="https://kit.fontawesome.com/7e33635ca3.js" crossorigin="anonymous"></script> -->
    <link rel="stylesheet" href="css/header.css">
        <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <script src="https://kit.fontawesome.com/7e33635ca3.js" crossorigin="anonymous"></script>
    </head>
    <body><?php

    ?>
    <header class="section-header">

        <section class="header-main border-bottom py-2">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-sm-5">
                        <a href="index.php" class="brand-wrap">
                            <img class="logo" src="../uplode/logo2.png">
                        </a> <!-- brand-wrap.// -->
                    </div>
                    <div class="col-lg-7 col-sm-12">
                        <form action="#" class="search  ms-5">
                            <div class="input-group" id="input_serch">
                                <?php $url = $_SERVER['REQUEST_URI'];
                                    $crent_url = substr($url, -35,-7);
                                    if($url=="/books_store/view/index.php"){
                                   
                                    ?>
                                    <input type="text" class="form-control" id="search_button" placeholder="Search" name="search_value" method="post">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary search_but" type="submit" name="search_btn">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </div>
                                <?php } ?>    
                            </div>
                            <input type="hidden" class="get_val" name="get-id" value="<?php 
                            if(isset($_GET['page'])){
                                echo ($_GET['page']);
                            }else{
                                echo 1;
                            }
                            ?>">
                        </form> <!-- search-wrap .end// -->
                    </div> <!-- col.// -->
                    <div class="col-lg-2 col-sm-6 col-12">
                        <div class="d-flex sign_up">
                            <div class="user_info">
                            <?php if(isset($_SESSION["username"])){ ?>
                            <div class="user_profile">
                                <a href="profile.php">
                                    <img src="../uplode/<?php if(empty($_SESSION["user_pic"])){
                                        echo "defult.jpg";
                                    }else{
                                        echo $_SESSION["user_pic"];
                                    } ?>" alt="profile_pictur">
                                    <p><?php echo $_SESSION['username'] ?></p>

                                </a>
                                
                            </div>
                        <?php
                       }else{ ?>
                        <a href="loglin_form.php"><h4>sign in</h4></a>

                        <?php } ?>
                            </div>
                        </div>
                        <!-- widgets-wrap.// -->
                    </div> <!-- col.// -->
                </div> <!-- row.// -->
            </div> <!-- container.// -->
        </section> <!-- header-main .// -->
    </header>