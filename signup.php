<?php
require 'config.php';
if(!empty($_SESSION["id"])){
    header("Location: index.php");
}
if(isset($_POST["submit"])){
    $name = $_POST["name"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirmpassword = $_POST["confirmpassword"];
    $duplicate = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$username' OR email = '$email'");
    if(mysqli_num_rows($duplicate)>0){
        echo
        "<script> alert('Username or Email has already been taken'); </script>";
    }
    else{
        if($password == $confirmpassword){
            $query = "INSERT INTO tb_user VALUES ('', '$name', '$username', '$email', '$password')";
            mysqli_query($conn, $query);
            echo
            "<script> alert('Account Sign up Complete!'); </script>";
        }
        else{
            echo
            "<script> alert('Password does not match!'); </script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up - meeps!</title>
    <link rel="stylesheet" href="../meeps/css/signup.css">
    <link rel="icon" type="image/png" href="../meeps/images/logo.png">
</head>
<body>
    <div class="rectangle"></div>
    <div class="meepsdotcom"> <img src="../meeps/images/meepsdotcomwhite.png"> </div>
    <div class="signup">
        <form class="" action="" method="post" autocomplete="off">
            <input type="text" name="name" id="name" placeholder="name" required value=""> <br><br>
            <input type="text" name="username" id="username" placeholder="username" required value=""> <br><br>
            <input type="text" name="email" id="email" placeholder="email" value=""> <br><br>
            <input type="password" name="password" id="password" placeholder="password" value=""> <br><br>
            <input type="password" name="confirmpassword" id="confirmpassword" placeholder="confirm password" required value=""> <br><br>
            <div class="submitbtn">
                <button type="submit" name="submit"> sign up </button>
            </div>
        </form>
    </div>
    <div class="promo"> <img src="../meeps/images/promolightblue.png"> </div>
    <br>
    <div class="signin">
        <a href="signin.php"> Sign in </a>
    </div>
    <div class="text">
        <p>Open existing account?</p>
    </div>
</body>
</html>