<?php

include "../model/database.php";

$obj = new database();

$uni_id = $_POST['uni_id'];

$col_name = ("university.uni_id,university.uni_name,category.cat_name,university.nop,university.cat_id");
$join = ("JOIN category ON university.cat_id = category.cat_id");
$obj->select("university",$col_name,$join,"uni_id = {$uni_id}");
$uni_info = $obj->get_result();
$uni_info = $uni_info[0];

$obj->select("category","*");
$all_cetagory = $obj->get_result();

$output = '<div class="container">
    <div class="row">
        <div class="col-md-12 col-lg-12 col-12 ">
            <div class="cat_update">
                <h2>update university</h2>
            </div>            
        </div>
        <div class="col-md-12 col-lg-12 col-12">
            <div class="uni_massage"></div>
            <div class="uni_up_info">
                <div class="row">
                    <div class="col-md-6 col-lg-6 col-sm-12">
                        <label for="cetagory">university name</label>
                        <input type="text" name="uni_name" id="uni_name_up" class = "uni_name_up" value = "'.$uni_info['uni_name'].'">
                    </div>
                    <div class="col-md-6 col-lg-6 col-sm-12">
                        <label for="cetagory">cetagory name</label>
                        <select name="cetagory" id="cetagory_id">
                        <option value="'.$uni_info['cat_id'].'" selected>'.$uni_info['cat_name'].'</option>';
                        foreach($all_cetagory as $row){
                            $output .= '<option value="'.$row['cat_id'].'">'.$row['cat_name'].'</option>';
                        }
        $output.= ' </select>
                    </div>
                </div>

            <input type="hidden" name="cat_id" value="'.$uni_id.'" class="ver_id">
            <input type="button" value="save" id ="cat_submit" class = "cat_summit cat_submits">

            </div>
        </div>
    </div>
</div>


<script>
$(document).ready(function() {

    $(".cat_submits").click(function() {
        var uni_id = $(".ver_id").val();
        var uni_name = $("#uni_name_up").val();
        var cat_id = $("#cetagory_id").val();
        var update = "save";
        console.log(uni_name);
        $.ajax({
            url: "../controller/update_insert_delet_university.php",
            method: "POST",
            data: {
                update:update,
                uni_id: uni_id,
                uni_name: uni_name,
                cat_id:cat_id
            },
            success: function(data) {
                $(".uni_massage").html(data);
            }
        });
    });
});
</script>


';
echo $output;
?>
