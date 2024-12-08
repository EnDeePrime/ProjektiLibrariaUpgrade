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





$Category_name= "";


$errorMessage ="";


$succesMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

$Category_name = $_POST["category_name"];



do{
    if (empty($Category_name) ){
        $errorMessage = "Field cannot be empty ";
        break;
    }
    //add new Borrower  to database

    $sql = "INSERT INTO categories ( category_name )" .
    "VALUES ( '$Category_name')";
    $result = $connection->query($sql);

if (!$result) {
    $errorMessage = "Invalid query: " . $connection->error;
    break;
}





$Category_name= "";



$succesMessage = "Category added correcly";

header("location:/projekti%20final/Admin.php#categories");
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
        <h2>New Category</h2>
       
       
       
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
                <label class="col-sm-3 col-form-label">New Category</label>
                <div class="col-sm-6" >
                    <input type="text" class="form-control" name="category_name" value="<?php echo $Category_name;?>">
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
                    <a  class="btn btn-outline-primary" href="/projekti%20final/Admin.php#categories" role="button" >Cancel</a>
                </div>

            </div>
        </form>
    </div>
</body>
</html>