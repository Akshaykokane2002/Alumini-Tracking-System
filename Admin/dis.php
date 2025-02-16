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
  <div class="username">John Doe</div>
  <div class="dropdown">
    <button class="dropbtn">Options ▼</button>
    <div class="dropdown-content">
      <a href="#">Option 1</a>
      <a href="logout.php">Logout</a>
    </div>
  </div>
</div>

<div class="navbar">
  <button class="toggle-btn" onclick="toggleNavbar()">☰</button>
  <nav class="nav-list">
    <a href="home.html">Home</a>
    <a href="#">About</a>
    <a href="#">Services</a>
    <a href="#">Contact</a>
  </nav>
</div>

<div class="content">
    <center>
      <h1>Alumin Details Form</h1>

      <!-- Search Form -->
      <form action="" method="get">
        <label for="search">Search:</label>
        <input type="text" name="search" placeholder="Enter name or batch">
        <input type="submit" value="Search">
      </form>

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

        // Handle Search Query
        $search = isset($_GET['search']) ? $_GET['search'] : '';
        $sql = "SELECT * FROM data WHERE name LIKE '%$search%' OR batch LIKE '%$search%'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
          echo "<table><tr><th>ID</th><th>pic</th><th>Name</th><th>Batch</th><th>Contact</th><th>Email</th><th>Edit</th><th>Delete</th></tr>";

          // output data of each row
          while($row = $result->fetch_assoc()) {
            $id = $row['id'];
            $name = $row['name'];
            $batch = $row['batch'];
            $contact = $row['contact'];
            $email = $row['email'];
            $pic = $row['pic'];

            // Display the results
            echo "<tr>
              <td>$id</td>
              <td><img width='100' src='myfile/$pic' alt='Profile Pic'></td>
              <td>$name</td>
              <td>$batch</td>
              <td>$contact</td>
              <td>$email</td>
              <td>
                <form action='edit.php' method='post'>
                  <input type='hidden' name='id' value='$id'>
                  <input type='submit' name='edit' class='btn-success' value='EDIT'>
                </form>
              </td>
              <td>
                <form action='delete.php' method='post'>
                  <input type='hidden' name='id' value='$id'>
                  <input type='submit' name='delete' class='btn-danger' value='Delete'>
                </form>
              </td>
            </tr>";
          }
          echo "</table>";
        } else {
          echo "0 results";
        }

        $conn->close();
      ?>
    </center>
</div>

</body>
</html>
