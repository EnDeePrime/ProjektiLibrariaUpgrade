<?php
$host = "localhost";
$db = "libraria";
$user = "root";
$pass = "";

// Establish a connection to the MySQL database
$connection = new mysqli($host, $user, $pass, $db);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET["id"])) {
    // GET method - retrieve the book ID from the URL parameters
    $id = $_GET["id"];

    // Delete the book from the books table
    $sql_delete_staff = "DELETE FROM staff WHERE staff_id = $id";
    if ($connection->query($sql_delete_staff) === TRUE) {
        $successMessage = "Staff deleted successfully.";
    } else {
        $errorMessage = "Error deleting staff: " . $connection->error;
    }

    // Redirect to the Admin page with success or error messages
    if (!empty($successMessage)) {
        header("location: Admin.php#success=$successMessage");
        exit;
    } elseif (!empty($errorMessage)) {
        header("location: Admin.php#error=$errorMessage");
        exit;
    }
}
?>