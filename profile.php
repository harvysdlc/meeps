<?php
require 'config.php';
if(!empty($_SESSION["id"])){
    $id = $_SESSION["id"];
    $result = mysqli_query($conn, "SELECT * FROM tb_user WHERE id = '$id'");
    $row = mysqli_fetch_assoc($result);
}
else{
    header("Location: signin.php");
}

if (isset($_GET['id'])) {
    $userId = $_GET['id'];
    
    // Fetch user information from the database based on the ID
    $query = "SELECT * FROM tb_user WHERE id = '$userId'";
    $idresult = mysqli_query($conn, $query);
    
    if ($idresult && mysqli_num_rows($idresult) > 0) {
        $user = mysqli_fetch_assoc($idresult);
        
        // Display user profile information
        echo "<h1>{$user['name']}</h1>";
        echo "<p>Username: @{$user['username']}</p>";
        echo "<p>Email: {$user['email']}</p>";
        // Add more profile information as needed
    } else {
        echo "User not found";
    }
} else {
    echo "Invalid user ID";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - meeps!</title>
    <link rel="stylesheet" href="../meeps/css/profile.css">
    <link rel="icon" type="image/png" href="../meeps/images/logo.png">
</head>
<body>
    <div class="rectangle"> </div>
    <div class="navigation">
        <button onclick="window.location.href='../meeps/index.php'">Home</button>
        <button onclick="window.location.href='../meeps/search.php'">Search</button>
        <button onclick="window.location.href='../meeps/mutuals.php'">Mutuals</button>
        <button onclick="window.location.href='../meeps/beeps.php'">Beeps</button>
        <button onclick="window.location.href='../meeps/profile.php'">Profile</button>
    </div>
    <div class="logo">
        <img src="../meeps/images/logowhite.png">
    </div>
    <div class="welcome">
    <div class="user-info">
        <h2><?php echo $row["username"]; ?></h2>
        <div class="badge">
            <?php
            $sql = "SELECT Acctype FROM tb_user WHERE id = '$id'";
            $sqlresult = mysqli_query($conn, $sql);
            $sqldisplay = mysqli_fetch_assoc($sqlresult);
            $Acctype = $sqldisplay['Acctype'];

            if ($Acctype == "verified") {
                ?>
                <img src="../meeps/images/vbadge.png" alt="Verified Badge">
                <?php
            } else {
                ?>
                <img src="" alt="">
                <?php
            }
            ?>
        </div>
    </div>
</div>
    <div class="signout">
        <a href="signout.php"> Sign out </a>
    </div>
    <div class="triangle">
        <img src="../meeps/images/triangle.png">
    </div>
    <div class="grayrectangle"> 
        <div class="header">
            <img src="../meeps/images/upper.png">
        </div>
        <div class="pfp">
            <?php
            if($Acctype == "verified"){
            ?>
            <img src="../meeps/images/user-verified.jpg">
            <?php
            }
            else {
            ?>
            <img src="../meeps/images/user-normal.jpg">
            <?php
            }
            ?>
        </div>
        <div class="edit">
            <button onclick="window.location.href=''">Edit profile</button>
        </div>
        <div class="divider"></div>
    </div>
</body>
</html>