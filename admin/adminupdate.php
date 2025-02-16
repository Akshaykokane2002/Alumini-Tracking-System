<?php

        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "alumini";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

// Check if the update button is clicked and if the required fields are set in the request
if (isset($_POST['update']) && isset($_POST['id'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $contact = $_POST['contact'];
    $email = $_POST['email'];

    // Check if the image file is uploaded
    if (isset($_FILES["pic"]["name"])) {
        if (move_uploaded_file($_FILES["pic"]["tmp_name"], "myfile/" . $_FILES["pic"]["name"])) {
            $pic = $_FILES["pic"]["name"];
        } else {
            echo "Error moving uploaded file";
            exit;  // Exit the script if there's an issue with moving the file
        }
    } else {
        // If no image file is uploaded, set $pic to an empty string or the current value in the database
        $pic = ''; // You may want to retrieve the current value from the database here if needed
    }

    // Update the data in the database
    $sql = "UPDATE adminlogin SET name='$name', contact='$contact', email='$email', pic='$pic' WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        echo '<script>alert("Update successful"); window.location.href = "admindisplay.php";</script>';
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

$conn->close();
?>
