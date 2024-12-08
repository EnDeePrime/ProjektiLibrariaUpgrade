

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
    $sql = "SELECT * FROM staff WHERE staff_id = $id";
    $result = $connection->query($sql);
    $staff = $result->fetch_assoc();

    if (!$staff) {
        // Redirect if the book with the specified ID is not found
        header("location:projekti%20final/Admin.php");
        exit;
    }

    // Assign retrieved values to variables
    $Staff_id = $staff["staff_id"];
    $Saddress = $staff["saddress"];
    $Semail = $staff["semail"];
    $Sfirstname = $staff["sfirstName"];
    $Slastname = $staff["slastName"];
    $Shiredate = $staff["hiredate"];
    $Sphone = $staff["sphone"];
    $Salary= $staff["salary"];
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // POST method - Update the book data
    $Staff_id = $_POST["staff_id"];
    $Saddress = $_POST["saddress"];
    $Semail = $_POST["semail"];
    $Sfirstname = $_POST["sfirstName"];
    $Slastname = $_POST["slastName"];
    $Shiredate = $_POST["hiredate"];
    $Sphone = $_POST["sphone"];
    $Salary = $_POST["salary"];

    // Validate form data
    if ( empty($Saddress) || empty($Semail) || empty($Sfirstname) || empty($Slastname) || empty($Shiredate) || empty($Sphone) || empty($Salary)) {
        $errorMessage = "All the fields are required";
    } else {
        // Update the book data in the database
        $sql = "UPDATE staff SET saddress = '$Saddress', semail = '$Semail', sfirstName = '$Sfirstname', slastName = '$Slastname', hiredate = '$Shiredate', sphone = '$Sphone', salary = '$Salary' WHERE staff_id = $Staff_id";
        $result = $connection->query($sql);
        if (!$result) {
            $errorMessage = "Invalid query: " . $connection->error;
        } else {
            $succesMessage = "Staff Updated Correctly";
            header("location: Admin.php#
            ");
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
            <input type="hidden" name="staff_id" value="<?php echo $Staff_id;?>">
            <div class= "row mb-3">
                <label class="col-sm-3 col-form-label">Address</label>
                <div class="col-sm-6" >
                    <input type="text" class="form-control" name="saddress" value="<?php echo $Saddress;?>">
                </div>
            </div>
            
            <div class= "row mb-3">
                <label class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-6" >
                    <input type="text" class="form-control" name="semail" value="<?php echo $Semail;?>">
                </div>
            </div>

            <div class= "row mb-3">
                <label class="col-sm-3 col-form-label">First Name</label>
                <div class="col-sm-6" >
                    <input type="text" class="form-control" name="sfirstName" value="<?php echo $Sfirstname;?>">
                </div>
            </div>

            <div class= "row mb-3">
                <label class="col-sm-3 col-form-label">Last Name</label>
                <div class="col-sm-6" >
                    <input type="text" class="form-control" name="slastName" value="<?php echo $Slastname;?>">
                </div>
            </div>

            <div class= "row mb-3">
                <label class="col-sm-3 col-form-label">Hire Date</label>
                <div class="col-sm-6" >
                    <input type="text" class="form-control" name="hiredate" value="<?php echo $Shiredate;?>">
                </div>
            </div>

            <div class= "row mb-3">
                <label class="col-sm-3 col-form-label">Phone</label>
                <div class="col-sm-6" >
                    <input type="text" class="form-control" name="sphone" value="<?php echo $Sphone;?>">
                </div>
            </div>
            <div class= "row mb-3">
                <label class="col-sm-3 col-form-label">Salary</label>
                <div class="col-sm-6" >
                    <input type="text" class="form-control" name="salary" value="<?php echo $Salary;?>">
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