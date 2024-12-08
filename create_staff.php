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





$Saddress= "";
$Semail= "";
$Sfirstname= "";
$Blastname= "";
$Slastname="";
$Shiredate="";
$Sphone="";
$Salary="";

$errorMessage ="";


$succesMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    $Saddress = $_POST["saddress"];
    $Semail = $_POST["semail"];
    $Sfirstname = $_POST["sfirstName"];
    $Slastname = $_POST["slastName"];
    $Shiredate = $_POST["hiredate"];
    $Sphone = $_POST["sphone"];
    $Salary = $_POST["salary"];



do{
    if ( empty($Saddress) || empty($Semail) || empty($Sfirstname) || empty($Slastname) || empty($Shiredate) || empty($Sphone) || empty($Salary)) {
        $errorMessage = "All the fields are required";
        break;
    }
    //add new Staff  to database

    $sql = "INSERT INTO staff ( saddress ,semail, sfirstName, slastName, hiredate, sphone, salary)" .
    "VALUES ( '$Saddress','$Semail','$Sfirstname','$Slastname', '$Shiredate', '$Sphone','$Salary')";
    $result = $connection->query($sql);

if (!$result) {
    $errorMessage = "Invalid query: " . $connection->error;
    break;
}





$Saddress= "";
$Semail= "";
$Sfirstname= "";
$Slastname= "";
$Slastname="";
$Shiredate="";
$Sphone="";
$Salary="";



$succesMessage = "Staff added correcly";

header("location: /projekti%20final/Admin.php#staff");
exit;

}
while(false);


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
  </body>
</head>
<body>
    <div class= "container my-5">
        <h2>New Staff</h2>
       
       
       
        <?php 
       if ( !empty($errorMessage) ) {
    echo "
    <div class= 'alert alert-warning alert-dismissible fade show' role='alert'>
        <strong>$errorMessage</strong>
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button> 
    </div>
    ";

       }
       
       ?>
        <form method= "post">
           
            
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
                <label class="col-sm-3 col-form-label">Name</label>
                <div class="col-sm-6" >
                    <input type="text" class="form-control" name="sfirstName" value="<?php echo $Sfirstname;?>">
                </div>
            </div>

            <div class= "row mb-3">
                <label class="col-sm-3 col-form-label">Last name</label>
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


<?php 
if (!empty($succesMessage))

echo "
<div class= 'alert alert-success alert-success-dismissible fade show' role='alert'>
    <strong>$succesMessage</strong>
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-labe='Close'></button> </div>



";

?>

            <div class= "row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary" >Submit</button>
                </div>

                <div class=" col-sm-3 d-grid">
                    <a  class="btn btn-outline-primary" href="/ProjektiFinal/Admin.php#book-copies" role="button" >Cancel</a>
                </div>

            </div>
        </form>
    </div>
</body>
</html>