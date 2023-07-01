
<?php
include "../model/database.php";
$obj = new database();

if(isset($_POST['post_id'])){
    $post_id = $_POST['post_id'];
    
    echo '
        <div class="confermation">
                        <p>do you want to delete this post </p>
                        <button class="delet_con_cat access_btn" value = "'.$post_id.'">ok</button>
                        <i class="fa fa-times close" aria-hidden="true"></i>
                </div>
        <script src="../controller/js/jquary.js"></script>
        <script>
            $(document).ready(function() {                
                $(".access_btn").click(function() {
                    
                    var post_id = $(this).val();
                   
                    $.ajax({
                        url: "../controller/delete_post.php",
                        method: "POST",
                        data: {

                            posts_id: post_id
                        },
                        success: function(data) {
                            $(".get_massage").html(data);
                        }
                    });

                    $.ajax({
                        url: "../view/all_posts.php" ,
                        success: function(data) {
                            $(".des_section").html(data);
                        }
                    }); 
                    
                });

                $(".access_btn").click(function() {
                    $(".confermation").hide(); 
                 
                });
                $(".close").click(function() {
                    $(".confermation").hide(); 
                });
            
            });

        </script>
        ';
}


if(isset($_POST['posts_id'])){
    $post_id = $_POST['posts_id'];

    $obj->select("books","*",null,"b_id = {$post_id}");
    $post_info = $obj->get_result();
    $post_info = $post_info[0];
    // print_r ($post_info);
    if($obj->delete("books","b_id={$post_id}")){
        $sql="UPDATE subject set nop=nop - 1 where sub_id={$post_info['sub_id']}";
        unlink("../uplode/".$post_info['img_1']);
        unlink("../uplode/".$post_info['img_2']);
        unlink("../uplode/".$post_info['img_3']);
        if ($obj->sql($sql)){
          $sql1="UPDATE user set nop=nop - 1 where user_id={$post_info['user_id']}";
          if($obj->sql($sql1)){
            $sql2="UPDATE department set nop=nop - 1 where dep_id={$post_info['department']}";
            if($obj->sql($sql2)){
              $sql3="UPDATE university set nop=nop - 1 where uni_id={$post_info['uni_id']}";
              if($obj->sql($sql3)){
                $sql4="UPDATE category set nop=nop - 1 where cat_id={$post_info['cat_id']}";
                if($obj->sql($sql4)){
                    echo " <div class='success'>
                                <p>User information update successfully .</p>
                           </div>";
                }
              }
            }      
          }
        }
    }else{
        echo "  <div class='error'>
            <p> can't update User information .</p>
        </div>";
    }
    

}


?>