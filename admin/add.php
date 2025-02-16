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

$name = $_POST['name'];
$email = $_POST['email'];
$contact = $_POST['contact'];
$batch = $_POST['batch'];
$org = $_POST['org'];
$deg = $_POST['deg'];

// Check if the "pic" key exists in the $_FILES array
if (isset($_FILES["pic"]) && $_FILES["pic"]["error"] == UPLOAD_ERR_OK) {
    // Move the uploaded file to the destination folder
    if (move_uploaded_file($_FILES["pic"]["tmp_name"], "myfile/" . $_FILES["pic"]["name"])) {
        $pic = $_FILES["pic"]["name"];
    } else {
        echo "Error moving uploaded file.";
        $conn->close();
        exit;
    }
} else {
    echo "Error uploading file. Make sure you selected a file.";
    $conn->close();
    exit;
}

$sql = "INSERT INTO data (name, email, contact, batch, pic,org,deg)
        VALUES ('$name','$email','$contact','$batch','$pic','$org','$deg')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
header ("location:display.php")
?>
