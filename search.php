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

if(isset($_POST['searchbutton'])){
    $search = $_POST['search'];
}

else if(!isset($_POST['searchbutton'])){
    $search = '';
}

$searchquery = mysqli_query($conn, "SELECT * FROM tb_user WHERE username LIKE '%$search%'"); 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search - meeps!</title>
    <link rel="stylesheet" href="../meeps/css/search.css">
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
        <h2> <?php echo $row["username"]; ?> </h2>
    </div>
    <div class="signout">
        <a href="signout.php"> Sign out </a>
    </div>
    <div class="triangle">
        <img src="../meeps/images/triangle.png">
    </div>
    <div class="grayrectangle"> </div>
    <div class="searchbar">
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>"> 
        <input type="text" name="search"> 
        <button type="submit" name="searchbutton">Search</button>
        </form>
        <h4>Result</h4>
    </div>
    <div class="results">
        <p> <?php 
        if(isset($_POST['searchbutton'])){
            $searchresult = mysqli_query($conn, $searchquery);
            echo '<table>';
            while($tables = mysqli_fetch_assoc($searchresult)){
                echo '<tr>';
                echo '<td>';
                echo $tables['username'];
                echo '</td>';
                echo '<td>';
                echo $table['name'];
                echo '</td>';
                echo '</tr>';
            }
        }
        echo '</table>';?> </p>
    </div>
</body>
</html>