<?php
require 'config.php';
if(!empty($_SESSION["id"])){
    header("Location: index.php");
}
if(isset($_POST["submit"])){
    $usernameoremail = $_POST["usernameoremail"];
    $password = $_POST["password"];
    $result = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$usernameoremail' OR email = '$usernameoremail'");
    $row = mysqli_fetch_assoc($result);
    if(mysqli_num_rows($result) > 0){
        if($password == $row["password"]){
            $_SESSION["signin"] = true;
            $_SESSION["id"] = $row["id"];
            header("Location: index.php");
        }
        else{
            echo
            "<script> alert('Wrong Password!'); </script>";
        }
    }

    else{
        echo
            "<script> alert('Account Not Found'); </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in - meeps!</title>
    <link rel="stylesheet" href="../meeps/css/signin.css"> 
    <link rel="icon" type="image/png" href="../meeps/images/logo.png">
</head>
<body>
    <div class="rectangle"></div>
    <div class="logo"> <img src="../meeps/images/logo.png"> </div>
    <div class="meepsdotcom"> <img src="../meeps/images/meepsdotcom.png"> </div>
    <div class="signin">
    <form class="" action="" method="post" autocomplete="off">
        <label for="usernameoremail"> Username or Email: </label>
        <input type="text" name="usernameoremail" id="usernameoremail" required value=""> <br>
        <label for="password"> Password: </label>
        <input type="text" name="password" id="password" required value=""> <br>
        <button type="submit" name="submit"> Sign in </button>
    </form>
    </div>
    <div class="promo"> <img src="../meeps/images/promowhite.png"> </div>
    <br>
    <div class="signup">
    <a href="signup.php"> Sign up </a>
    </div>
</body>
</html>