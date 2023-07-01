<?php
    include "../model/database.php";
    $obj = new database();
    // print_r ($_file);
    if(isset($_POST['save'])){
        $book_id = $_POST['books_id'];
        $img_1 = $_FILES['image_name1'];
        $img_2 = $_FILES['input_img_2'];
        $img_3 = $_FILES['input_img_3'];
        $b_type = $_POST["book_type"];
        $b_university = $_POST["university"];
        $b_department = $_POST["department"];
        $b_samester = $_POST["samester"];
        $b_subject = $_POST["subject"];
        $b_condition = $_POST["condition"];
        $b_author = $_POST["author"];
        $b_price = $_POST["price"];
        $b_name = $_POST["books_name"];
        $b_des = $_POST["books_des"];

        $value_set = ["b_name"=>$b_name,"b_des"=>$b_des,"author"=>$b_author,"cat_id"=>$b_type,"uni_id"=>$b_university,
        "department"=>$b_department,"semester"=>$b_samester,"sub_id"=>$b_subject];
        if($img_1['name'] != null){

            $obj->Img_Up('image_name1',"../uplode/");
            $result1 = $obj->Img();
            $file_name1 = $result1[0];
            $value_set['img_1']=$file_name1;
        }
        if($img_2['name'] != null){
            $obj->Img_Up('input_img_2',"../uplode/");
            $result1 = $obj->Img();
            $file_name1 = $result1[0];;
            $value_set['img_2']=$file_name1;
        }
        if($img_3['name'] != null){
            $obj->Img_Up('input_img_2',"../uplode/");
            $result1 = $obj->Img();
            $file_name1 = $result1[0];
            $value_set['img_3']=$file_name1;
        }
        if($b_condition != null){
            $value_set['b_condition']=$b_condition;
        }
        $obj->select("books","*",null,"b_id=$book_id");
        $result_all_post = $obj->get_result();
        $result_all_post = $result_all_post[0];


        if($obj->update('books',$value_set,"b_id=$book_id")){
            $sql="UPDATE subject set nop=nop - 1 where sub_id={$result_all_post['sub_id']}";
            if($obj->sql($sql)){
                $sql2="UPDATE subject set nop=nop + 1 where sub_id={$b_subject}";
                if($obj->sql($sql2)){
                    $sql3="UPDATE university set nop=nop - 1 where uni_id = {$result_all_post['uni_id']}";
                    if($obj->sql($sql3)){
                        $sql4="UPDATE university set nop=nop + 1 where uni_id = {$b_university}";
                        if($obj->sql($sql4)){
                            $sql5="UPDATE department set nop=nop - 1 where dep_id = {$result_all_post['department']}";
                            if($obj->sql($sql5)){
                                $sql6="UPDATE department set nop=nop + 1 where dep_id = {$b_department}";
                                if($obj->sql($sql6)){
                                    $sql7="UPDATE category set nop=nop - 1 where cat_id = {$result_all_post['cat_id']}";
                                    if($obj->sql($sql7)){
                                        $sql8="UPDATE category set nop=nop + 1 where cat_id = {$b_type}";
                                        if($obj->sql($sql8)){
                                            header("Location: ../view/singel_post.php?id=$book_id");
                                        } 
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }



?>