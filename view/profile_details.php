                <?php
                     include("../controller/save&update_profile.php");
                ?>
                <div class="get_message"></div>
                <div class="heading border-bottom pb-4">
                        <span class="heding-text">Personal Information</span>
                    </div>
                    <div class="user_name">
                        <div class="profile_info_name" id = "profile_info_name">
                            <p>name : <span><?php echo $result['user_name']; ?></span></p>
                            <button id="edit" class = 'edit' >Change Name</button>
                        </div>
                        <form action="#" method="post" class = "form_info_name" id="form_info_name">
                            <p>name : <input class='input input_name' type="text" name = 'name' value='<?php echo $result['user_name']; ?>' ></p>
                            <input type="button" value="save" name="save_name" class='save-btn unser_name_btn user_name' id="save-btn">
                        </form>
                    </div>


                   <div class="user-email">
                    <div class="profile_info_name" id = "profile_info_email">
                            <p>email : <span><?php echo $result['user_email'];  ?></span></p>
                            <button id="edit-email" class = 'edit'>Change email</button>
                        </div>
                        <form action="../controller/save_profile.php" method="post" class = "form_info_name" id="form_info_email">
                            <p>email : <input class='input input_email' type="text" name = 'email' value='<?php echo $result['user_email']; ?>' ></p>
                            <input type="button" value="save" name="email_btn" class='save-btn submit_email email' id="save-btn-email">
                        </form>
                   </div>
                    
                    <div class="user-email">
                        <div class="profile_info_name" id = "profile_info_phone">
                            <p>phone : <span><?php if($result['user_mobile'] != null){
                                    echo $result['user_mobile'];
                                }else{
                                        echo "enter your phone number";
                                }
                                ?></span></p>
                            <button id="edit-phone" class = 'edit'>Change phone</button>
                        </div>
                        <form action="#" method="post" class = "form_info_name" id="form_info_phone">
                            <p>phone : <input class='input input_phone' type="phone" name = 'phone'  <?php if($result['user_mobile'] != null){
                                    echo 'value = "'.$result['user_mobile'].'"';
                                }else{
                                        echo 'placeholder = "enter your phone number"';
                                        echo "enter your phone number";
                                }
                                ?>  ></p>
                            <input type="button" value="save" name="phone-btn" class='save-btn submit_phone email' id="save-btn-phone">
                        </form>
                    </div>
                    <hr>
                    <div class="user-university">
                        <div class="profile_info_name" id = "profile_info_university">
                            <p>university : <span><a>
                            <?php if($users['uni_id'] != null){
                                    echo $result['uni_name'];
                                }else{ 
                                    echo "select versity name ";
                                 }
                                ?>
                            </a></span></p>
                            <button id="edit-versity" class = 'edit'>Change versity name</button>
                        </div>
                        <form action="../controller/save_profile.php" method="post" class = "form_info_name" id="form_info_versity">
                                 <p>university :</p>
                                 <select name="select_uni_name" id="select_uni_name"  class="select_uni_name">
                                 <?php if($users['uni_id'] != null){
                                    echo '<option value="'. $result['uni_id'].'">'. $result['uni_name'].'</option>';
                                }else{ 
                                    echo "<option value disabled selected>Select state</option>";
                                 }
                                ?>
                                 
                                    <?php foreach($uni as $uni_row){ ?>
                                        <option value="<?php echo $uni_row['uni_id'];  ?>"><?php echo $uni_row['uni_name'];  ?></option>
                                    <?php  } ?>
                                 </select>
                            <input type="submit" value="save" name="uni_name" class='save-btn email select_input' id="save-btn-uni">
                        </form>
                    </div>
                    <div class="user-semester">
                        <div class="profile_info_name" id = "profile_info_semester">
                            <p>semester: <span><?php if($users['semester'] != null){
                                    echo $users['semester']." semester";
                                }else{ 
                                    echo "select semester ";
                                 }
                                ?></span></p>
                            <button id="edit-semester" class = 'edit'>Change semester</button>
                        </div>
                        <form action="../controller/save_profile.php" method="post" class = "form_info_name" id="form_info_semester">
                                <p>semester :</p>
                                 <select name="select_semester_name" id="select_semester_name" class="select_uni_name">
                                        <?php if($users['semester'] != null){
                                            echo '<option value="'. $users['semester'].'">'.$users['semester'].' semester</option>';
                                        }else{ 
                                            echo "<option value disabled selected>Select state</option>";
                                        }
                                        ?>
                                        <option value="1st">1st semester</option>
                                        <option value="2end">2end semester</option>
                                        <option value="3rd">3rd semester</option>
                                        <option value="4th">4th semester</option>
                                 </select>
                            <input type="submit" value="save" name="sem_name" class='save-btn semester select_input' id="save-btn-semester">
                        </form>
                    </div>

                    <div class="user-subject">
                        <div class="profile_info_name" id = "profile_info_subject">
                            <p>subject : <span><a>
                            <?php if($users['sub_id'] != null){
                                    echo $result['sub_name'];
                                }else{ 
                                    echo "select subject name ";
                                 }
                                ?>
                            </a></span></p>
                            <button id="edit-subject" class = 'edit'>Change subject name</button>
                        </div>
                        <form action="../controller/save_profile.php" method="post" class = "form_info_name" id="form_info_subject">
                                 <p>subject :</p>
                                 <select name="select_sub_name" id="select_sub_name"  class="select_uni_name">
                                 <?php if($users['sub_id'] != null){
                                    echo '<option value="'. $users['sub_id'].'">'.$result['sub_name'].'</option>';
                                }else{ 
                                    echo "<option value disabled selected>Select state</option>";
                                 }
                                ?>
                                    <?php foreach($subject as $uni_row){ ?>
                                        <option value="<?php echo $uni_row['sub_id'];  ?>"><?php echo $uni_row['sub_name'];  ?></option>
                                    <?php  } ?>
                                 </select>
                            <input type="submit" value="save" name="sub_name" class='save-btn email select_input' id="save-btn-sub">
                        </form>
                    </div>
                    <hr>

                    <div class="user_pass">
                        <div class="profile_info_name" id = "profile_info_pass">
                            <p>password : <span>******</span></p>
                            <button id="edit-pass" class = 'edit' >Change password</button>
                        </div>
                        <form action="#" method="post" class = "form_info_name" id="form_info_pass">
                            <p>old password : <input class='pass-input old' type="password" name = 'u_pass_old' placeholder='enter old password' ></p>
                            <p>new password : <input class='pass-input new' type="password" name = 'u_pass_new' placeholder='enter new password' ></p>
                            <p>conferm password : <input class='pass-input con' type="password" name = 'u_pass_con' placeholder='conferm your password' ></p>
                            <input type="button" value="save" name="pass" class='save-btn submit_pass' id="save-btn-pass">
                        </form>
                    </div>
    <script src="../controller/js/jquary.js"></script>
    <script>
    $(document).ready(function() {
        $('#edit').click(function(){
            $('#profile_info_name').hide(100);
            $('#form_info_name').show();
        });
        $('#edit-email').click(function(){
            $('#profile_info_email').hide(100);
            $('#form_info_email').show();
        });
        $('#edit-phone').click(function(){
            $('#profile_info_phone').hide(100);
            $('#form_info_phone').show();
        });
        $('#edit-address').click(function(){
            $('#profile_info_address').hide(100);
            $('#form_info_address').show();
        });

        $('#edit-gender').click(function(){
            $('#profile_info_gender').hide(100);
            $('#form_info_gender').show();
        });
        $('#edit-birth').click(function(){
            $('#profile_info_dob').hide(100);
            $('#form_info_birth').show();
        });
        $('#edit-versity').click(function(){
            $('#profile_info_university').hide(100);
            $('#form_info_versity').show();
        });
        $('#edit-semester').click(function(){
            $('#profile_info_semester').hide(100);
            $('#form_info_semester').show();
        });
        $('#edit-subject').click(function(){
            $('#profile_info_subject').hide(100);
            $('#form_info_subject').show();
        });
        $('#edit-pass').click(function(){
            $('#profile_info_pass').hide(100);
            $('#form_info_pass').show();
        });
        $(".unser_name_btn").click(function() {
            var user_name = $(".input_name").val();
            var update = "save";
            $.ajax({
                url: "../controller/save_profile.php",
                method: "POST",
                data: {
                    update_name:update,
                    user_name: user_name
                },
                success: function(data) {
                    $(".get_message").html(data);
                }
            });
            $('#profile_info_name').show();
            $('#form_info_name').hide(100);
        });
        $(".submit_phone").click(function() {
            var user_phone = $(".input_phone").val();
            var update = "save";
            $.ajax({
                url: "../controller/save_profile.php",
                method: "POST",
                data: {
                    update_phone:update,
                    user_phone: user_phone
                },
                success: function(data) {
                    $(".get_message").html(data);
                }
            });
            $('#profile_info_name').show();
            $('#form_info_name').hide(100);
        });
        $(".submit_email").click(function() {
            var user_email = $(".input_email").val();
            var update = "save";
            $.ajax({
                url: "../controller/save_profile.php",
                method: "POST",
                data: {
                    update_email:update,
                    user_email: user_email
                },
                success: function(data) {
                    $(".get_message").html(data);
                }
            });
            $('#profile_info_email').show();
            $('#form_info_email').hide(100);
        });
        $(".submit_pass").click(function() {
            var user_pass_old = $(".old").val();
            var user_pass_new = $(".new").val();
            var user_pass_con = $(".con").val();
            var update = "save";
            console.log(user_pass_old);
            $.ajax({
                url: "../controller/save_profile.php",
                method: "POST",
                data: {
                    update_pass:update,
                    user_pass_old: user_pass_old,
                    user_pass_new:user_pass_new,
                    user_pass_con:user_pass_con

                },
                success: function(data) {
                    $(".get_message").html(data);
                }
            });
            $('#profile_info_pass').show();
            $('#form_info_pass').hide(100);
        });

    });
    </script>