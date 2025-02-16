<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles.css">
  <title>Admin Display</title>
  <style>
    /* Add your styles here */
  </style>
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
      <h1>ADMIN Details Form</h1>

      <!-- Static Search Form -->
      <form method="get" action="admindisplay.php">
        <label for="search">Search:</label>
        <input type="text" name="search" id="search" placeholder="Enter name or batch">
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

      // Handle Static Search
      $search = isset($_GET['search']) ? $_GET['search'] : '';
      $sql = "SELECT * FROM adminlogin WHERE name LIKE '%$search%'";
      $result = $conn->query($sql);

      // Check for query execution errors
      if (!$result) {
          die("Query failed: " . $conn->error);
      }

      if ($result->num_rows > 0) {
          echo "<table><tr><th>ID</th><th>pic</th><th>Name</th><th>Contact</th><th>Email</th><th>Edit</th><th>Delete</th></tr>";

          // output data of each row
          while ($row = $result->fetch_assoc()) {
              $id = $row['id'];
              $name = $row['name'];
              $contact = $row['contact'];
              $email = $row['email'];
              $pic = $row['pic'];

              // Display the results
              echo "<tr>
              <td>$id</td>
              <td><img width='100' src='myfile/$pic' alt='Profile Pic'></td>
              <td>$name</td>
              <td>$contact</td>
              <td>$email</td>
              <td>
                  <form action='adminedit.php' method='post'>
                      <input type='hidden' name='id' value='$id'>
                      <input type='submit' name='edit' class='btn-success' value='EDIT'>
                  </form>
              </td>
              <td>
                  <form action='admindelete.php' method='post'>
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
