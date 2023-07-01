<?php

    include('../controller/show_user_data.php');
    // session_start();
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>E-Commerce</title>
    <link rel="stylesheet" href="css/index.css">
    <style>
        .img-s {
            opacity: 0;
            transition: 0.3s;
        }

        .card:hover .img-s {
            opacity: 1;
        }
    </style>
    <?php
        include_once("header.php");
    ?>

    <main class="mt-5 home_page">
    <!-- <div class="s_book_ajex"></div> -->
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-5 col-lg-3  p-3">
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button " type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    University
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show " aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <?php
                                    if (count($display)) {
                                        $events = array();
                                        foreach ($display as $row) {
                                    ?>
                                            <div class="list-group-item checkbox">
                                                <label><input type="checkbox" class="common_selector university" value="<?php echo $row['uni_id']; ?>"> <?php echo $row['uni_name']; ?> <span>(<?php echo $row['nop']; ?>)</span></label>
                                            </div>
                                    <?php
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Department
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <?php
                                    if (count($display1)) {
                                        $events = array();
                                        sort($events);
                                        foreach ($display1 as $row) {
 
                                    ?>
                                            <div class="list-group-item checkbox">
                                                <label><input type="checkbox" class="common_selector department" value="<?php echo $row["dep_id"]?>"> <?php echo ucfirst($row["dep_name"]) ?><span>(<?php echo $row["nop"] ?>)</span></label>
                                            </div>
                                    <?php
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    Subject
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <?php
                                    if (count($display2)) {
                                        $events = array();
                                        sort($events);
                                        foreach ($display2 as $row) {
                                            $events[] = $row['sub_name'];
                                    ?>
                                            <div class="list-group-item checkbox">
                                                <label><input type="checkbox" class="common_selector subject" value="<?php echo $row['sub_id'] ?>"> <?php echo ucfirst($row['sub_name']) ?><span>(<?php echo $row['nop'] ?>)</span></label>
                                            </div>
                                    <?php
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse4" aria-expanded="false" aria-controls="collapseThree">
                                    More Filter
                                </button>
                            </h2>
                            <div id="collapse4" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="form-check">
                                        <input class="form-check-input radio common_selector" name="flexRadioDefault" id="flexRadioDefault1" type="radio" value="old">
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            Old Product
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input radio common_selector" type="radio" name="flexRadioDefault" id="flexRadioDefault2" value="new">
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            New Product
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input radio common_selector" type="radio" name="flexRadioDefault" id="flexRadioDefault2" value="Hight_Price">
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            Hight Price
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input radio common_selector" type="radio" name="flexRadioDefault" id="flexRadioDefault2" value="Low_Price">
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            Low Price
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-7 col-lg-9  p-3">
                    <div class="container  mb-5">
                        <div class="row">
                            <div class="col-md-7 offset-md-3">
                                <div class="d-flex">
                                    <hr class="my-auto flex-grow-1">
                                    <div class="px-3 text-uppercase fs-2">ALL PRODUCT</div>
                                    <hr class="my-auto flex-grow-1">
                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="container">
                        <div class="row filter_data">
                            
                            <?php
                            if (isset($display) && !empty($display)) {
                                foreach ($display as $row) {
                            ?>

                            <?php
                                }
                            }
                            ?>
                        </div>
                    </div>

            </div>
        </div>
    </main>



    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <script src="../controller/js/jquary.js"></script>
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
    -->
    <script>
        var get_id = $(".get_val").val();
        var page_id1 = '' ;


        $(document).ready(function() {
        //     $(document).on("click","#pagination_ajex li button",function(e){
        //     e.preventDefault();
        //     var page_id = $(this).attr("id");
        //     filter_data();
        // });
        
            $(document).on("click","#pagination_ajex li button",function(e){
                e.preventDefault();
                var page_id = $(this).attr("id");
                filter_data(page_id);
            });
            $('input[type="radio"]').click(function() {
                var value = $(this).val();
                
                

                    
            });
            

            filter_data();
            var sherch_val = '';
            const data_array = [ get_id,sherch_val];
            load_data(get_id);

            function filter_data(page_id) {
                var action = 'fetch_data';
                var university = get_filter('university');
                var department = get_filter('department');
                var subject = get_filter('subject');
                var radio = get_redio('radio');

                $.ajax({
                    url: "../controller/fetch_data.php",
                    method: "POST",
                    data: {
                        action: action,
                        get_page: get_id,
                        university: university,
                        department: department,
                        subject: subject,
                        radio:radio,
                        page_id:page_id
                    },
                    success: function(data) {
                        $('.filter_data').html(data);
                    }
                });
            }

            function get_filter(class_name) {
                var filter = [];
                $('.' + class_name + ':checked').each(function() {
                    filter.push($(this).val());
                });
                return filter;
            }
            function get_redio(class_name) {
                var filter = '';
                $('.' + class_name + ':checked').each(function() {
                    filter = $(this).val();
                });
                return filter;
            }


            function load_data(data_array) {
                $.ajax({
                    url: "../controller/fetch.php",
                    method: "POST",
                    data: {

                        query: data_array
                    },
                    success: function(data) {
                        $('.filter_data').html(data);
                    }
                });
            }

            $('#search_button').keyup(function() {
                var search = $(this).val();
                sherch_val = search;
                const data_array = [ get_id,sherch_val];
                if (sherch_val != '') {
                    load_data(data_array);
                } else {
                    load_data(data_array);
                }
            });
            $('.common_selector').click(function() {
                filter_data();
            });
            var get_s_valu = $("#search_button").val();
            $(".search_but").click(function(){
                const data_array1 = [ get_id,get_s_valu];
                load_data(data_array);
                header("Location: {$hostname}/view/login.php");
            })

           

        });
    </script>

</body>

</html>