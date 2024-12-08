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

$id = "";
$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // GET method - retrieve the copy ID from the URL parameters
    if (!isset($_GET["id"])) {
        // Redirect if the copy ID is not provided in the URL
        header("location: /projektifinal/Admin.php");
        exit;
    }

    // Retrieve the copy ID from the URL parameters
    $id = $_GET["id"];

    // Fetch the copy details from the database
    $sql = "SELECT * FROM book_copies WHERE copy_id = $id";
    $result = $connection->query($sql);
    $copy = $result->fetch_assoc();

    if (!$copy) {
        // Redirect if the copy with the specified ID is not found
        header("location:/projektifinal/Admin.php");
        exit;
    }

    // Assign retrieved values to variables
    $id = $copy["copy_id"];
    $condition = $copy["condition_of_book"];
    $status = $copy["bstatus"];
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // POST method - Update the copy data
    $id = $_POST["id"];
    $condition = $_POST["condition"];
    $status = $_POST["status"];

    // Validate form data
    if (empty($id) || empty($condition) || empty($status)) {
        $errorMessage = "All fields are required";
    } else {
        // Update the copy data in the database
        $sql = "UPDATE book_copies SET condition_of_book = '$condition', bstatus = '$status' WHERE copy_id = $id";
        $result = $connection->query($sql);
        if (!$result) {
            $errorMessage = "Invalid query: " . $connection->error;
        } else {
            $successMessage = "Copy Updated Successfully";
            header("location: http://localhost/projekti%20final/Admin.php");
            exit;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Copy</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container my-5">
        <h2>Edit Copy</h2>
        <?php 
        if (!empty($errorMessage)) {
            echo "
            <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                <strong>$errorMessage</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button> 
            </div>
            ";
        }
        ?>
        <form method="post">
            <input type="hidden" name="id" value="<?php echo $id;?>">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Condition</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="condition" value="<?php echo $condition;?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Status</label>
                <div class="col-sm-6">
                    <select class="form-select" name="status">
                        <option value="Available" <?php if($status == 'Available') echo 'selected'; ?>>Available</option>
                        <option value="On Loan" <?php if($status == 'On Loan') echo 'selected'; ?>>On Loan</option>
                        <option value="Damaged" <?php if($status == 'Damaged') echo 'selected'; ?>>Damaged</option>
                        <option value="Lost" <?php if($status == 'Lost') echo 'selected'; ?>>Lost</option>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="/projektifinal/Admin.php#book-copies" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>