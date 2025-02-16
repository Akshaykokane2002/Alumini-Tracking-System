<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles.css">
  <title>Stylish Side Navbar</title>
</head>
<body>

<div class="topnav">
  <div class="username">BVIMIT ALUMIN TRACKING</div>
  <div class="dropdown">
    <a href="logout.php">Logout</a>
  </div>
</div>

<div class="navbar">
  <!-- <button class="toggle-btn" onclick="toggleNavbar()">☰</button> -->
  <nav class="nav-list">
    <a href="home.html">Home</a>
    <a href="display.php">Alumini</a>
    <a href="adminreg.html">Admin</a>
    <a href="admindisplay.php">Admin display</a>
  </nav>
</div>

<div class="content">
<center>
      <h1>Alumin Details Form</h1>
<?php

$servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "alumini";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);


// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the edit button is clicked and if the ID is set in the request
if (isset($_POST['edit']) && isset($_POST['id'])) {
    $id = $_POST['id'];

    // Retrieve the existing data based on the ID
    $sql = "SELECT * FROM adminlogin WHERE id='$id'";
    $result = $conn->query($sql);

    // Check for errors in the SQL query
    if (!$result) {
        die("Error in the SQL query: " . $conn->error);
    }

    if ($result->num_rows > 0) {
        // Fetch the data
        $row = $result->fetch_assoc();
        $name = $row['name'];
        $contact = $row['contact'];
        $email = $row['email'];
        $pic = $row['pic'];

        // Display the form for editing
        ?>
      <form action="adminupdate.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <label for="name">Name:</label>
            <input type="text" name="name" value="<?php echo $name; ?>"><br>
            <label for="contact">Contact:</label>
            <input type="text" name="contact" value="<?php echo $contact; ?>"><br>
            <label for="email">Email:</label>
            <input type="text" name="email" value="<?php echo $email; ?>"><br>
            <label for="pic">Profile Pic:</label>
            <input type="file" name="pic" value="<?php echo $pic; ?>"><br>
            <input type="submit" name="update" value="Update">
        </form>

        <?php
    } else {
        echo "No record found with the specified ID";
    }
}

$conn->close();
?>
    </center>
</div>
</body>
</html>
