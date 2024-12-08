<?php 
$host = "localhost";
$db =  "libraria";
$user = "root";
$pass = "";

$connection = new mysqli($host, $user, $pass, $db);

if ($connection->connect_error){
    die("connection failed: ". $connection->connect_error);
}

$Condition = "";
$Bstatus = "";
$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    // Check if the condition_of_book is set in $_POST
    if(isset($_POST["condition_of_book"])) {
        $Condition = $_POST["condition_of_book"];
    }
    // Check if the bstatus is set in $_POST
    if(isset($_POST["bstatus"])) {
        $Bstatus = $_POST["bstatus"];
    }

    // Check if condition and status are not empty
    if (empty($Condition) || empty($Bstatus)) {
        $errorMessage = "Fields cannot be empty";
    } else {
        // Add new copy to the database
        $book_id = $_POST["book_id"]; // Get book ID from the form
        $sql = "INSERT INTO book_copies (book_id, condition_of_book, bstatus) VALUES ('$book_id', '$Condition', '$Bstatus')";
        $result = $connection->query($sql);

        if (!$result) {
            $errorMessage = "Invalid query: " . $connection->error;
        } else {
            $successMessage = "Copy added correctly";
            header("location: /projekti%20final/Admin.php#book-copies");
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
    <title>Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container my-5">
        <h2>New Copy</h2>

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
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Book ID</label>
                <div class="col-sm-6">
                    <select name="book_id" class="form-select">
                        <?php
                        // Fetch book IDs from the books table
                        $sql = "SELECT id, title  FROM books";
                        $result = $connection->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<option value='" . $row['id'] . "'>" . $row['title'] . "</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Condition</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="condition_of_book" value="<?php echo $Condition; ?>">
                </div>
            </div>

<div class="row mb-3">
    <label class="col-sm-3 col-form-label">Status</label>
    <div class="col-sm-6">
        <select class="form-select" name="bstatus">
            <option value="Available">Available</option>
            <option value="On Loan">On Loan</option>
            <option value="Damaged">Damaged</option>
            <option value="Lost">Lost</option>
        </select>
    </div>
</div>

            <?php
            if (!empty($successMessage)) {
                echo "
    <div class='alert alert-success alert-dismissible fade show' role='alert'>
        <strong>$successMessage</strong>
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button> 
    </div>
    ";
            }
            ?>

            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>

                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="/ProjektiFinal/Admin.php#book-copies" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
