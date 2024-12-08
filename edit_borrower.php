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
$sql="";
$id = "";
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
    $sql = "SELECT * FROM borrowers WHERE borrower_id = $id";
    $result = $connection->query($sql);
    $borrowers = $result->fetch_assoc();

    if (!$borrowers) {
        // Redirect if the book with the specified ID is not found
        header("location:projekti%20final/Admin.php");
        exit;
    }

    // Assign retrieved values to variables
    $Borrower_id = $borrowers["borrower_id"];
    $Baddress = $borrowers["baddress"];
    $Bemail = $borrowers["bemail"];
    $Bfirstname = $borrowers["bfirstName"];
    $Blastname = $borrowers["blastName"];
    $Bpassword = $borrowers["bpassword"];
    $Bphone = $borrowers["bphone"];
   
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // POST method - Update the book data
    $Borrower_id = $_POST["borrower_id"];
    $Baddress = $_POST["baddress"];
    $Bemail = $_POST["bemail"];
    $Bfirstname = $_POST["bfirstName"];
    $Blastname = $_POST["blastName"];
    $Bpassword = $_POST["bpassword"];
    $Bphone = $_POST["bphone"];
    

    // POST method - Update the borrower data
$Borrower_id = $_POST["borrower_id"];
$Baddress = $_POST["baddress"];
$Bemail = $_POST["bemail"];
$Bfirstname = $_POST["bfirstName"];
$Blastname = $_POST["blastName"];
$Bpassword = $_POST["bpassword"];
$Bphone = $_POST["bphone"];

// Debugging
echo "Borrower ID: " . $Borrower_id;

// Validate form data
if ( empty($Baddress) || empty($Bemail) || empty($Bfirstname) || empty($Blastname) || empty($Bpassword) || empty($Bphone)) {
    $errorMessage = "All the fields are required";
} else {
    // Update the borrower data in the database
    $sql = "UPDATE borrowers SET baddress = '$Baddress', bemail = '$Bemail', bfirstName = '$Bfirstname', blastName = '$Blastname', bpassword = '$Bpassword', bphone = '$Bphone' WHERE borrower_id = $Borrower_id";
    echo $sql; // Debugging
    $result = $connection->query($sql);
    if (!$result) {
        $errorMessage = "Invalid query: " . $connection->error;
    } else {
        $succesMessage = "Borrower Updated Correctly";
        header("location: Admin.php");
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
    <title>Edit</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container my-5">
        <h2>Edit Borrower</h2>
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
            <input type="hidden" name="borrower_id" value="<?php echo $id;?>">
            <div class= "row mb-3">
                <label class="col-sm-3 col-form-label">Address</label>
                <div class="col-sm-6" >
                    <input type="text" class="form-control" name="baddress" value="<?php echo $Baddress;?>">
                </div>
            </div>
            
            <div class= "row mb-3">
                <label class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-6" >
                    <input type="text" class="form-control" name="bemail" value="<?php echo $Bemail;?>">
                </div>
            </div>

            <div class= "row mb-3">
                <label class="col-sm-3 col-form-label">First name</label>
                <div class="col-sm-6" >
                    <input type="text" class="form-control" name="bfirstName" value="<?php echo $Bfirstname;?>">
                </div>
            </div>

            <div class= "row mb-3">
                <label class="col-sm-3 col-form-label">Last name</label>
                <div class="col-sm-6" >
                    <input type="text" class="form-control" name="blastName" value="<?php echo $Blastname;?>">
                </div>
            </div>

            <div class= "row mb-3">
                <label class="col-sm-3 col-form-label">Password</label>
                <div class="col-sm-6" >
                    <input type="text" class="form-control" name="bpassword" value="<?php echo $Bpassword;?>">
                </div>
            </div>

            <div class= "row mb-3">
                <label class="col-sm-3 col-form-label">Phone Number</label>
                <div class="col-sm-6" >
                    <input type="text" class="form-control" name="bphone" value="<?php echo $Bphone;?>">
                </div>
            </div>
           




            <div class= "row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary" >Submit</button>
                </div>

                <div class=" col-sm-3 d-grid">
                    <a  class="btn btn-outline-primary" href="/projektifinal/Admin.php#book-copies" role="button" >Cancel</a>
                </div>

            </div>
        </form>
    </div>
</body>
</html>