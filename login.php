<?php
$host = "localhost";
$db = "libraria";
$user = "root";
$pass = "";

// Establish a connection to the MySQL database
// Establish a connection to the MySQL database
$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Capture username and password input
$username = $_POST['username'];
$password = $_POST['password'];

// SQL query to check for a matching user in the database
$sql = "SELECT * FROM users WHERE username = ? AND password = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $username, $password);
$stmt->execute();

$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Verify user credentials
if ($user) {
    // Distinguish between admin and regular users based on the "user_type" column
    if ($user['user_type'] == 'admin') {
        header("Location: Admin.php");
        // Redirect to admin page or do something else
    } else {
        header("Location: user.html");
        // Redirect to user page or do something else
    }
} else {
    // If no match, display an "Invalid username or password" message
    echo "Invalid username or password";
}

$conn->close();

