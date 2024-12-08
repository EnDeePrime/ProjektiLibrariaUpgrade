<?php
$host = "localhost";
$db = "libraria";
$user = "root";
$pass = "";

// Establish a connection to the MySQL database
// Establish a connection to the MySQL database
$conn = new mysqli($host, $user, $pass, $db);

// Check connection

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get data from database
$sql = "SELECT id, title, author, category, isbn, publisher, publication_date, price FROM books";
$result = $conn->query($sql);

$books = [];
if ($result) {
    if ($result->num_rows > 0) {
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            $books[] = $row;
        }
    }
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

return $books;
?>