<?php
//require 'config.php';
if(!empty($_SESSION["id"])){
    $id = $_SESSION["id"];
    $result = mysqli_query($conn, "SELECT * FROM tb_user WHERE id = '$id'");
    $row = mysqli_fetch_assoc($result);
}
else{
    header("Location: signin.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>meeps!</title>
    <link rel="stylesheet" href="../meeps/css/index.css">
    <link rel="icon" type="image/png" href="../meeps/images/logo.png">
</head>
<body>
    <h2> Welcome <?php echo $row["name"]; ?> </h2>
    <a href="signout.php"> Sign out </a>
</body>
</html>