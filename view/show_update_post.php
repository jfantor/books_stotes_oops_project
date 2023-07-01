<?php
    include "../controller/save&update_profile.php";
    // include "../model/database.php";
    $obj = new database();
    if(isset($_POST['post_id'])){

    }
    $book_id = $_POST['post_id'];

    $col_name = "books.b_id,books.b_name,books.b_des,books.author,books.semester,category.cat_name,university.uni_name,department.dep_name,subject.sub_name,user.user_name,books.img_1,books.img_2,books.img_3,books.b_condition,books.price,books.uni_id,books.sub_id,books.department,books.cat_id";
    $join = "JOIN category ON books.cat_id = category.cat_id JOIN university ON books.uni_id = university.uni_id JOIN department ON books.department= department.dep_id JOIN subject ON books.sub_id = subject.sub_id JOIN user ON books.user_id = user.user_id";
    $obj->select("books",$col_name,$join,"b_id = {$book_id}");
    $post_result = $obj->get_result();
    $post_info = $post_result[0];
    $img_1 = $post_info['img_1'];
    $img_2 = $post_info['img_2'];
    $img_3 = $post_info['img_3'];
    $cack1 = '';
    $cack2 = '';
    if($post_info["b_condition"] == "new"){
        $cack1 = "checked";
    }
    if($post_info["b_condition"] == "old"){
        $cack2 = "checked";
    }
    if(isset($_POST['condition'])){
        if($b_condition != null){
            $cack1 ='';
            $cack2='';
        }
    }
    
    // print_r ($post_result);
   $outpot = '
    <div class="update_post_section">
        <form action="../controller/save_update_post.php" method="post" id="update_post_form" enctype="multipart/form-data">
        <input type="hidden" name="books_id" value='.$post_info['b_id'].'>
            <div class="container">
                <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12 postHeader">
                            <h3>post by : '.$post_info['user_name'].'</h3>
                        </div>

                        <div class="col-md-5 col-lg-5 col-sm-12 img_container">
                            <div class="img_1_section img_section">
                                <div class="display_img">
                                    <img src="../uplode/'.$img_1.'" alt="post img">
                                </div>
                                <div class="input_img">
                                    <label for="select_img">select 1st image  </label>
                                    
                                    <input type="file" name="image_name1"  >
                                </div>
                            </div>
                            <div class="img_2_section img_section">
                                <div class="display_img">
                                    <img src="../uplode/'.$img_2.'" alt="post img" >
                                </div>
                                <div class="input_img">
                                    <label for="select_img">select 2nd image  </label>
                                    <input type="file" name="input_img_2" id="input_img_2">
                                </div>
                            </div>
                            <div class="img_2_section img_section">
                                <div class="display_img">
                                    <img src="../uplode/'.$img_3.'" alt="post img">
                                </div>
                                <div class="input_img">
                                    <label for="select_img">select 3rd image  </label>
                                    <input type="file" name="input_img_3" id="input_img_2" >
                                </div>
                            </div>
                        </div>
                        <div class="col-md-7 col-lg-7 col-sm-12">    
                            <div class="data_input_container">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-6 col-lg-6 col-12 book_type col_6_section">
                                            <label for="book_type">type of books </label>
                                            <select name="book_type" id="book_type">
                                                <option value="'.$post_info['cat_id'].'">'.$post_info['cat_name'].'</option>';
                                                foreach($category as $row){
                                                    $outpot .= '<option value="'.$row['cat_id'].'">'.$row['cat_name'].'</option>';
                                                }

                                        $outpot .=   ' </select>
                                        </div>
                                        <div class="col-md-6 col-lg-6 col-12 university col_6_section ">
                                            <label for="book_type">university </label>
                                            <select name="university" id="university">
                                                <option value="'.$post_info['uni_id'].'">'.$post_info['uni_name'].'</option>';
                                                foreach($uni as $row){
                                                    $outpot .= '<option value="'.$row['uni_id'].'">'.$row['uni_name'].'</option>';
                                                }

                                        $outpot .=   '
                                            </select>
                                        </div>
                                        <div class="col-md-6 col-lg-6 col-12 department col_6_section">
                                            <label for="book_type">department </label>
                                            <select name="department" id="department">
                                                <option value="'.$post_info['department'].'">'.$post_info['dep_name'].'</option>';
                                                foreach($department as $row){
                                                    $outpot .= '<option value="'.$row['dep_id'].'">'.$row['dep_name'].'</option>';
                                                }

                                        $outpot .=   '
                                            </select>
                                        </div>
                                        <div class="col-md-6 col-lg-6 col-12 samester col_6_section">
                                            <label for="book_type">samester </label>
                                            <select name="samester" id="samester">
                                                <option value="'.$post_info['semester'].'">'.$post_info['semester'].'</option>
                                                <option value="1 st">1 st semester</option>
                                                <option value="2 nd">2 nd semester</option>
                                                <option value="3 rd">3 rd semester</option>
                                                <option value="4 th">4 th semester</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 col-lg-6 col-12 subject col_6_section">
                                            <label for="book_type">subjects </label>
                                            <select name="subject" id="subject">
                                                <option value="'.$post_info['sub_id'].'">'.$post_info['sub_name'].'</option>';
                                                foreach($subject as $row){
                                                    $outpot .= '<option value="'.$row['sub_id'].'">'.$row['sub_name'].'</option>';
                                                }

                                        $outpot .=   '
                                            </select>
                                        </div>
                                        <div class="col-md-6 col-lg-6 col-12 condition col_6_section">
                                            <label for="book_type">the condition :</label>
                                            <div class="redio_input">
                                                <div class="new_condition">
                                                    <label for="new">new : </label>
                                                    <input type="radio" name="condition" id="new" class="new_input" value = "new" '.$cack1.'>
                                                </div>
                                                <div class="new_condition">
                                                    <label for="new">old : </label>
                                                    <input type="radio" name="condition" id="old" class="old_input" value = "old" '.$cack2.'>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-md-6 col-lg-6 col-sm-12 author_section col_6_section">
                                            <label for="author_name"> auhor</label>
                                            <input type="text" name="author" id="author" class="author" value="'.$post_info['author'].'">
                                        </div>
                                        <div class="col-md-6 col-lg-6 col-sm-12 col_6_section post_price">
                                            <label for="author_name"> price</label>
                                            <input type="number" name="price" id="price" class="price" value = "'.$post_info['price'].'">
                                        </div>
                                        <div class="col-md-12 col-lg-12 col-sm-12 book_name col_12_section">
                                            <label for="book_name">book name  </label>
                                            <input type="text" name="books_name" id="book_name_input" value = "'.$post_info['b_name'].'">
                                        </div>
                                        <div class="col-md-12 col-lg-12 col-sm-12 desctiption_section col_12_section">
                                            <label for="book_description">books desctiption  </label>
                                            <input type="text" name="books_des" id="book_des_input" value = "'.$post_info['b_des'].'">
                                            
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    
                    <div class="submit">
                        <input type="submit" value="save" name="save">
                    </div>
                </div>
            </div>
        </form>
    </div>

    
    ';
echo $outpot;

?>



