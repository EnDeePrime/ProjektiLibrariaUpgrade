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





$Baddress= "";
$Bemail= "";
$Bfirstname= "";
$Blastname= "";
$Bpassword="";
$Bphone="";

$errorMessage ="";


$succesMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

$Baddress = $_POST["baddress"];
$Bemail = $_POST["bemail"];
$Bfirstname = $_POST["bfirstname"];
$Blastname = $_POST["blastname"];
$Bpassword = $_POST["bpassword"];
$Bphone = $_POST["bphone"];



do{
    if (empty($Baddress) || empty($Bemail) || empty($Bfirstname) || empty($Blastname)|| empty($Bpassword) || empty($Bphone) ){
        $errorMessage = "All the fields are requred";
        break;
    }
    //add new Borrower  to database

    $sql = "INSERT INTO borrowers ( baddress ,bemail, bfirstname, blastname, bpassword, bphone)" .
    "VALUES ( '$Baddress','$Bemail','$Bfirstname','$Blastname', '$Bpassword', '$Bphone')";
    $result = $connection->query($sql);

if (!$result) {
    $errorMessage = "Invalid query: " . $connection->error;
    break;
}





$Baddress= "";
$Bemail= "";
$Bfirstname= "";
$Blastname= "";
$Bpassword="";
$Bphone="";


$succesMessage = "Borrower added correcly";

header("location: /projekti%20final/Admin.php#book-copies");
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
        <h2>New Borrower</h2>
       
       
       
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
                <label class="col-sm-3 col-form-label">Name</label>
                <div class="col-sm-6" >
                    <input type="text" class="form-control" name="bfirstname" value="<?php echo $Bfirstname;?>">
                </div>
            </div>

            <div class= "row mb-3">
                <label class="col-sm-3 col-form-label">Last name</label>
                <div class="col-sm-6" >
                    <input type="text" class="form-control" name="blastname" value="<?php echo $Blastname;?>">
                </div>
            </div>

            <div class= "row mb-3">
                <label class="col-sm-3 col-form-label">Password</label>
                <div class="col-sm-6" >
                    <input type="text" class="form-control" name="bpassword" value="<?php echo $Bpassword;?>">
                </div>
            </div>
            <div class= "row mb-3">
                <label class="col-sm-3 col-form-label">Phone</label>
                <div class="col-sm-6" >
                    <input type="text" class="form-control" name="bphone" value="<?php echo $Bphone;?>">
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