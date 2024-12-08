<?php
// Include database connection
include 'db_conn.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $book_id = $_POST['book_id'];
    $recommended = isset($_POST['recommended']) ? 1 : 0;

    $sql = "UPDATE books SET recommended = $recommended WHERE id = $book_id";
    if ($conn->query($sql) === TRUE) {
        echo "Book recommendation updated successfully!";
    } else {
        echo "Error updating record: " . $connection->error;
    }
}
?>
