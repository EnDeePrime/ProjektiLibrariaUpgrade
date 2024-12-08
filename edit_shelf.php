

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
$sql= "";

$errorMessage = "";
$succesMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // GET method - retrieve the book ID from the URL parameters
    if (!isset($_GET["id"])) {
        // Redirect if the book ID is not provided in the URL
        header("location: /projekti%20final/Admin.php");
        exit;
    }

    // Retrieve the book ID from the URL parameters
    $id = $_GET["id"];

    // Fetch the book details from the database
    $sql = "SELECT * FROM shelves WHERE shelf_id = $id";
    $result = $connection->query($sql);
    $shelves = $result->fetch_assoc();

    if (!$shelves) {
        // Redirect if the book with the specified ID is not found
        header("location:projekti%20final/Admin.php");
        exit;
    }

    // Assign retrieved values to variables
    $Shelf_id = $shelves["shelf_id"];
    $Shelf_name = $shelves["shelf_name"];
    
} if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // POST method - Update the shelf data
    $Shelf_name = $_POST["shelf_name"];

    // Validate form data
    if (empty($Shelf_name)) {
        $errorMessage = "All the fields are required";
    } else {
        // Retrieve the shelf ID from the URL parameters
        $id = isset($_GET["id"]) ? $_GET["id"] : null;

        // Check if $id is not empty
        if (!empty($id)) {
            // Update the shelf data in the database
            $sql = "UPDATE shelves SET shelf_name = '$Shelf_name'  WHERE shelf_id = $id";
            $result = $connection->query($sql);
            if (!$result) {
                $errorMessage = "Invalid query: " . $connection->error;
            } else {
                $succesMessage = "Shelves Updated Correctly";
                header("location: Admin.php");
                exit;
            }
        } else {
            $errorMessage = "Shelf ID is empty";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container my-5">
        <h2>Edit Staff</h2>
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
        <form method= "post">
            <input type="hidden" name="staff_id" value="<?php echo $Shelf_id;?>">
            <div class= "row mb-3">
                <label class="col-sm-3 col-form-label">Shelves</label>
                <div class="col-sm-6" >
                    <input type="text" class="form-control" name="shelf_name" value="<?php echo $Shelf_name;?>">
                </div>
            </div>
            
            





            <div class= "row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary" >Submit</button>
                </div>

                <div class=" col-sm-3 d-grid">
                    <a  class="btn btn-outline-primary" href="/projektifinal/Admin.php#" role="button" >Cancel</a>
                </div>

            </div>
        </form>
    </div>
</body>
</html>