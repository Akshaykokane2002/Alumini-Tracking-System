<?php
session_start();

$message = "";
$maxAttempts = 3;
$lockoutDuration = 300; // 5 minutes in seconds

if (!isset($_SESSION['login_attempts'])) {
    $_SESSION['login_attempts'] = 0;
}

if (!isset($_SESSION['last_attempt_time'])) {
    $_SESSION['last_attempt_time'] = 0;
}

if ($_SESSION['login_attempts'] >= $maxAttempts) {
    $currentTime = time();
    $lockoutTime = $_SESSION['last_attempt_time'] + $lockoutDuration;

    if ($currentTime < $lockoutTime) {
        $remainingTime = $lockoutTime - $currentTime;
        $message = "Account locked. Too many login attempts. Please try again after " . gmdate("i:s", $remainingTime) . ".";
        echo "<script>
                alert('$message');
                window.location.href = 'index.html';
             </script>";
        exit();
    } else {
        // Reset attempts after lockout duration
        $_SESSION['login_attempts'] = 0;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "alumini";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die('Could not connect to the database server: ' . $conn->connect_error);
    }

    $uname = mysqli_real_escape_string($conn, $_POST["uname"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM adminlogin WHERE uname = ? AND password = ?");
    $stmt->bind_param("ss", $uname, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        $_SESSION["uname"] = $row["uname"];
        $_SESSION["password"] = $row["password"];

        // Reset login attempts on successful login
        $_SESSION['login_attempts'] = 0;

        header("Location: home.html");
        exit();
    } else {
        $_SESSION['login_attempts']++;
        $_SESSION['last_attempt_time'] = time();
        $remainingAttempts = $maxAttempts - $_SESSION['login_attempts'];
        $message = "Invalid Username or Password! Remaining attempts: $remainingAttempts";
        echo "<script>
                alert('$message');
                window.location.href = 'index.html';
             </script>";
    }

    $stmt->close();
    $conn->close();
}
?>
