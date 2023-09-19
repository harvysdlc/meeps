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
    $results = mysqli_query($conn, $query);
    
    if ($results && mysqli_num_rows($results) > 0) {
        $user = mysqli_fetch_assoc($results);
        
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
        <?php
        $searchresult = array();
        if (isset($_POST['searchbutton'])) {
            $search = $_POST['search'];
            $searchquery = mysqli_query($conn, "SELECT * FROM tb_user WHERE name LIKE '%$search%'");

            // Check if there are any results
            if (mysqli_num_rows($searchquery) > 0) {
                while ($row = mysqli_fetch_assoc($searchquery)) {
                    $searchresult[] = $row; // Store each result in the array
                }

                // Display the results
                foreach ($searchresult as $result) {
                    // Create a clickable link to the user's profile page
                    echo "<p>● <a href='profile.php?id={$result["id"]}'>{$result["name"]} (@{$result['username']})</a></p>";
                }
            } else {
                echo '<p><b>No results found!</b></p>';
            }
        } else {
            $search = '';
        }
        ?>
    </div>
</body>
</html>