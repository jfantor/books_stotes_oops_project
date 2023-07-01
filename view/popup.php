<?php
//  include("../controller/show_data.php");

 
 ?>

<div class="popup_section container " id="popup_section">
    <div class="popup_heading">
        <h3>add post</h3>
    </div>
    
    <form action="../controller/save_post.php" method="post" id="address_form" enctype="multipart/form-data">
    <p class="close-btn" id="close_post"><i class="fa fa-times" aria-hidden="true" id="close_address"></i></p>
        <div class="address_selection" id="address_selection">
            <div class="select_country col-md-6 col-lg-6">
                <div class="book_condition">
                    <h2 class = 'country_hading ' id="type_hading">book type</h2>
                    <div class="selects">
                        <select name="category" id="university" class=" division select cetagory_name"  required>
                                <option value disabled selected>select university</option>
                            <?php foreach($category as $row_con){ ?>
                                <option class='option_cat' value="<?php echo $row_con['cat_id'];?>"><?php echo $row_con['cat_name']; ?></option>
                            <?php } ?> 
                            
                        </select>
                    </div>
                </div>
                <?php
                    //if(isset($_POST['aria'])){?>
                <h2 class = 'country_hading'>university</h2>
                <select name="university" id="university" class=" division select university_select" required>
                    <option value disabled selected>select university</option>
                </select>

                <h2 class = 'country_hading'>depertment</h2>
                <select name="depertment" id="dep_name" class=" division select" required>
                    <option value disabled selected>select depertment</option>
                    <?php foreach($department as $row_con){ ?>
                        <option value="<?php echo $row_con['dep_id'];?>"><?php echo $row_con['dep_name']; ?></option>
                    <?php } ?> 
                    
                </select>

                


                <h2 class = 'country_hading'>samester</h2>
                <select name="select_semester_name" id="select_semester_name" class="division select" required>
                    <option value disabled selected>select semester</option>
                    <option value="1st">1st semester</option>
                    <option value="2end">2end semester</option>
                    <option value="3rd">3rd semester</option>
                    <option value="4th">4th semester</option>
                </select>

                

                <!-- <div class="add_country_section" id="add_subject_section">
                    <form action="#" method="post">
                        <p id="close_subject" class = "close_aria">close</p>
                        <label for="con_name">subject name :</label>
                        <input type="text" class='country_input' name="subject_name" placeholder="enter your subject">
                        <input type="submit" value="save" name="save_subject" id ="save_subject">
                    </form>
                </div> -->
            </div>

            <div class="select_country col-md-6 col-lg-6 col-6">

                 <h2 class = 'country_hading'>subject</h2>
                <select name="subject_id" id="subject_name" class=" division select" required>
                <option value disabled selected>select subject</option>
                    <?php foreach($subject as $row_con){ ?>
                        <option value="<?php echo $row_con['sub_id'];?>"><?php echo $row_con['sub_name']; ?></option>
                    <?php } ?> 
                    
                </select>

                <!-- <div class="add_country_section" id="add_language_section">
                    <form action="#" method="post">
                        <p id="close_language" class = "close_aria">close</p>
                        <label for="con_name">language name :</label>
                        <input type="text" class='country_input' name="language_name" placeholder="enter your language">
                        <input type="submit" value="save" name="save_language" id ="save_language">
                    </form>
                </div> -->

                <div class="book_condition">
                    <h2 class = 'country_hading ' id="con_hading">the condition</h2>
                    <div class="redio_group">
                        <div class="new-redio">
                            <input type="radio" name="condition" id="condition" value="new" required>
                            <label for="new">new</label>
                        </div>
                        <div class="old-redio">
                            <input type="radio" name="condition" id="condition"  value="old" required>
                            <label for="old">old</label>
                        </div>
                    </div>
                </div>

                <h2 class = 'country_hading ' id="book">author Name</h2>
                <input type="text" name="author" id="author_id" placeholder= "enter author namae">

                <!-- <div class="add_country_section" id="add_author_section">
                    <form action="#" method="post">
                        <p id="close_author" class = "close_aria">close</p>
                        <label for="con_name">author name :</label>
                        <input type="text" class='country_input' name="author_name" placeholder="enter author name">
                        <input type="date" name="auth_dob" id="auth_dob">
                        <textarea name="auth_des" id="auth_des" cols="3" rows="4"></textarea>
                        <input type="submit" value="save" name="save_auth" id ="save_auth">
                    </form>
                </div>
                 -->
                <h2 class = 'country_hading ' id="book">price</h2>
                <input type="number" name="price" class="price1" placeholder="enter price" required>
                <!-- <div class="price ">
                    <h2 class = 'price_hading'>price :</h2>
                    
                </div> -->


            </div>

            
            <input type="button" value="Next" name = "popup_data" class="popup_btn" id="address_next" required>
        <!-- </form> -->
        </div>

        <div class="book_info" id="book_info">
            <p class="info_back_btn" id="info_back_btn"><i class="fa fa-arrow-left" aria-hidden="true"></i></p>
        <!-- <form  action="save_post.php" method="POST" enctype="multipart/form-data"> -->
            <div class="inpupt_group">
                    <div class="form-group col-md-12 col-lg-12 book_details">
                        <label for="book_name" class = "book_info">book name</label>
                        <input type="text" name="book_name" class="form-control" autocomplete="off"  required>
                    </div>
                    <div class="form-group  col-md-12 col-lg-12 book_details">
                          <label for="exampleInputPassword1" class = "book_info"> book Description</label>
                          <textarea name="bookdesc" class="form-control" rows="5"  required ></textarea>
                    </div>

                    <div class="form-group col-md-4 col-lg-4 post_img">
                          <label for="exampleInputPassword1">Post image</label>
                          <input type="file" name="image_name1"  required>
                    </div>
                    <div class="form-group col-md-4 col-lg-4 post_img">
                          <label for="exampleInputPassword1">Post image</label>
                          <input type="file" name="image_name2"  required>
                    </div>
                    <div class="form-group col-md-4 col-lg-4 post_img">
                          <label for="exampleInputPassword1">Post image</label>
                          <input type="file" name="image_nam3"  required>
                    </div>





                   
            </div>
                    <input type="submit" name="save" class="btn btn-primary" value="save" id ='submit'  />
        </div>

        </form>
    
</div>
</div>
    <script src="../controller/js/jquary.js"></script>
    <script>
    $(document).ready(function() {
    
        $(".option_cat").click(function() {
            var cat_id = $(this).val();
            $.ajax({
                url: "get_university.php",
                method: "POST",
                data: {
                    cat_id:cat_id
                },
                success: function(data) {
                    $(".university_select").html(data);
                }
            });
        });
        
    });
    </script>