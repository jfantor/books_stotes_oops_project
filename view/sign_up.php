<?php
include ("../controller/save_user.php");
// include "../model/database.php";
// include_once("../controller/login.php");
// $obj = new database();
session_start();
// if (isset($_SESSION["username"])) {
//     header("Location: {$hostname}/view/profile.php");
// }

?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <!-- File CSS -->
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>Register user</title>
</head>

<body>

    <div class="container">
        <header class="header">
            <nav class="navbar navbar-expand-lg navbar-light py-3">
                <div class="container">

                    <a href="#" class="navbar-brand">
                        <p><span class ="books_text"><span class="f_logo">b</span>ook</span><span class="store_text"><span class="l_logo">s</span>tore</span></p>
                    </a>
                </div>
            </nav>
        </header>



        <div class="container">
            <div class="row py-5 mt-4 align-items-center">
                <!-- For Demo Purpose -->
                <div class="col-md-5 pr-lg-5 mb-5 mb-md-0">
                    <img src="../uplode/form_d9sh6m.svg" alt="" class="img-fluid mb-3 d-none d-md-block">
                    <h1>Welcome to book store</h1>
                    <p class="font-italic text-muted mb-0">Create a Register/Login books store .</p>
                    <p class="font-italic text-muted">Snippet By <a href="#" class="text-muted">
                            <u>Bootstrapious</u></a>
                    </p>
                </div>


                <div class="col-md-7 col-lg-6 ml-auto">
                    <div class="massage">
                        <?php
                            
                            echo $massage;
                        ?>
                    </div>
                    <!-- Registeration Form -->
                    <form id="register-form" method="Post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <div class="text-left w-100 mb-4 ml-3">
                            <p class="text-green h3 font-weight-bold text-uppercase">Create an Account</p>
        
                        </div>
                        <!-- <form action="../model/save_user.php" method="post"> -->
                            <div class="container">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <input type="text" name="fname" class="form-control" placeholder="First Name">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <input type="text" name="lname" class="form-control" placeholder="Last Name">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-lg-12 mb-3">
                                <input type="text" class="form-control" name="user_name" placeholder="Email User Name">
                            </div>
                            <div class="form-group col-lg-12 mb-3">
                                <input type="email" class="form-control" name="email" placeholder="Email address">
                            </div>
                            <div class="form-group col-lg-12 mb-3">
                                <input type="password" class="form-control" name="password" placeholder="Password">
                            </div>
                            <div class="form-group col-lg-12 mb-3">
                                <input type="password" class="form-control" name="confirmPassword" placeholder="Confirm Password">
                            </div>
                            <div class="form-group col-lg-12 mx-auto mb-0">
                                <input type="submit" name="register" class="btn btn-primary btn-block py-2 font-weight-bold" value="Create your account">
                            </div>
                        <!-- </form> -->
                        <?php
                        if (!isset($_SESSION["username"])) {
                            ?>
                        
                        <div class="form-group col-lg-12 mx-auto d-flex align-items-center my-4">
                            <div class="border-bottom w-100 ml-5"></div>
                            <span class="px-2 small text-muted font-weight-bold text-muted">OR</span>
                            <div class="border-bottom w-100 mr-5"></div>
                        </div>
                        <!-- Already Registered -->
                        <div class="text-center w-100">
                            <p class="text-muted font-weight-bold">Already Registered? <a href="loglin_form.php" id="login" class="text-primary ml-2">Login</a></p>
                        </div>
                        <?php
                            }
                        ?>
                    </form>



                    <!-- 
                    Login form -->



                </div>
            </div>
        </div>
    </div>
    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <!-- Option 2: jQuery, Popper.js, and Bootstrap JS
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    -->
    <script src="../controller/js/jquary.js"></script>
</body>

</html>

<?php
$obj = new DataBase(); 
$massage = '';

if(isset($_POST['register'])){

    $fname =$_POST['fname'];
    $lname = $_POST['lname'];
    $user = $_POST['user_name'];
    $email =$_POST['email'];
    $password =$_POST['password'];

    $con_pass = $_POST['confirmPassword']; 
    $role ="user";
   


    $obj->select('user',"user_email",null,"user_email = '{$email}' OR user_name = '{$user}'");


    $result =  $obj->get_result();
    // echo $result;

    if(COUNT($result)> 0){
      $massage =  " UserEmail Or UserName already Exists.";
      return $massage;
      header("Location: {$hostname}/view/sign_up.php");
    }else{
        // $obj->Img_Up("fileToUpload","../uplode/");
        // $result = $obj->Img();
        // $file_name = $result[0];
        if($password == $con_pass){
            $password = md5($password);
            $value = ["user_f_name"=>$fname,"user_l_name"=>$lname,"user_name"=>$user,"user_email"=>$email,"user_pass"=>$password,"user_role"=>$role];
            
            if($obj->insert('user',$value)){
                if(isset($_SESSION["username"])){
                    header("Location: {$hostname}/controller/profile.php");
                }else{
                    // $username =  $_POST['username'];
                    // $password = md5($_POST['password']);
        
                    $join =null;
                    $col_name = "user_id, user_name, user_role,user_img";
                    $limit= null;
                    $order= null;
                    $where = " user_name = '{$user}' AND user_pass= '{$password}'"; 
            
                    $obj->select('user',$col_name,$join,$where);
        
                    $result = $obj->get_result();
        
                    if(COUNT($result) > 0){
        
                        foreach($result as $row){
                        session_start();
                        $_SESSION["username"] = $row['user_name'];
                        $_SESSION["user_id"] = $row['user_id'];
                        $_SESSION["user_role"] = $row['user_role'];
                        $_SESSION["user_pic"] = $row['user_img'];
        
                        header("Location: {$hostname}/view/profile.php");
                        }
                    }
                }
            }else{
                $massage = "Can't Insert User.";
                return $massage;
                header("Location: {$hostname}/view/sign_up.php");
            } 
        }else{
          $massage =  "password and conferm password not masd";
          return $massage;
          header("Location: {$hostname}/view/sign_up.php");
        }
    
    }
}
?>