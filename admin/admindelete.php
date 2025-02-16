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

// Check if the delete button is clicked and if the ID is set in the request
if (isset($_POST['delete']) && isset($_POST['id'])) {
    $id = $_POST['id'];

    // SQL query to delete the record with the specified ID
    $sql = "DELETE FROM adminlogin WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

$conn->close();

// Redirect back to the display.php page
header("location: admindisplay.php");
?>
