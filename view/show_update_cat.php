<?php

include "../model/database.php";

$obj = new database();

$cat_id = $_POST['cat_id'];

$obj->select("category","*",null,"cat_id = {$cat_id}");
$cat_info_up = $obj->get_result();
$cat_info_up = $cat_info_up[0];

echo '<div class="container">
    <div class="row">
        <div class="col-md-12 col-lg-12 col-12 ">
            <div class="cat_update">
                <h2>update cetagory</h2>
            </div>            
        </div>
        <div class="col-md-12 col-lg-12 col-12">
            <div class="cat_massage"></div>
            <div class="cat_up_info">
                <input type="hidden" name="cat_id" value="'.$cat_id.'" class="ceta_id">
                <label for="cetagory">cetagory name</label>
                <input type="text" name="cat_name" id="cat_name_up" value = "'.$cat_info_up['cat_name'].'">

                <input type="button" value="save" id ="cat_submit" class = "cat_summit">

            </div>
        </div>
    </div>
</div>


<script>
$(document).ready(function() {

    $(".cat_summit").click(function() {
        var cat_id = $(".ceta_id").val();
        var cat_name = $("#cat_name_up").val();
        var update = "save";
        console.log(cat_name);
        $.ajax({
            url: "../controller/update_insert_delet_cat.php",
            method: "POST",
            data: {
                update:update,
                cat_id: cat_id,
                cat_name: cat_name
            },
            success: function(data) {
                $(".cat_massage").html(data);
            }
        });
    });
});
</script>


';

?>