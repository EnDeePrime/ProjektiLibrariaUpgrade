<html>
<head>
    <title>Library Management System</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <style>
        .container {
            max-width: 1200px;
        }

        .nav-tabs {
            margin-bottom: 20px;
        }

        .card {
            margin-bottom: 20px;
        }
       
    </style>
</head>
<body>
    <!-- Your HTML code -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">Library Management System</a>
        </div>
    </nav>
    <div class="container mt-4">
        <ul class="nav nav-tabs">
        
    
        <li class="nav-item">
                <a class="nav-link active"  id="books-tab" data-bs-toggle="tab" href="#books">Books</a>
            </li>
        <li class="nav-item">
                <a class="nav-link" id="book-copies-tab" data-bs-toggle="tab" href="#book_copies">Book Copies</a>
            </li>
        <li class="nav-item">
                <a class="nav-link" id="borrowers-tab" data-bs-toggle="tab" href="#borrowers">Borrowers</a>
            </li>
        <li class="nav-item">
                <a class="nav-link" id="categories-tab" data-bs-toggle="tab" href="#categories">Categories</a>
            </li>
        <li class="nav-item">
                <a class="nav-link" id="shelves-tab" data-bs-toggle="tab" href="#shelves">Shelves</a>
            </li>
         <li class="nav-item">
                <a class="nav-link" id="staff-tab" data-bs-toggle="tab" href="#staff">Staff</a>
        </li>
        </ul>
        
                    
    <div class="tab-content mt-4">
        <div class="tab-pane fade show active" id="books">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h5>Books</h5>
                    <a class="btn btn-primary" href="create_book.php" type="button">Add Book</a>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Book ID</th>
                                <th>Title</th>
                                <th>Author</th>
                                <th>Category</th>
                                <th>ISBN</th>
                                <th>Publisher</th>
                                <th>Publication Date</th>
                                <th>Price</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $host = "localhost";
                            $db = "libraria";
                            $user = "root";
                            $pass = "";

                            // Establish a connection to the MySQL database
                            $conn = new mysqli($host, $user, $pass, $db);

                            // Check connection
                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            }

                            // Fetch books from the database
                            $sql = "SELECT * FROM books";
                            $result = $conn->query($sql);

                            // Check if there are any books
                          
                                if ($result->num_rows > 0) {
                                    // Output data of each row
                                    while($books = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>" . $books['id'] . "</td>";
                                        echo "<td>" . $books['title'] . "</td>";
                                        echo "<td>" . $books['author'] . "</td>"; // Now 'author' refers to the author name
                                        echo "<td>" . $books['category'] . "</td>"; // Now 'category' refers to the category name
                                        echo "<td>" . $books['isbn'] . "</td>";
                                        echo "<td>" . $books['publisher'] . "</td>";
                                        echo "<td>" . $books['publication_date'] . "</td>";
                                        echo "<td>" . $books['price'] . "</td>";
                                        echo "<td>";
                                        echo "<a href='edit_book.php?id=" . $books['id'] . "' class='btn btn-sm btn-primary'>Edit</a>";
                                        echo "<a href='delete_book.php?id=" . $books['id'] . "' class='btn btn-sm btn-danger'>Delete</a>";
                                        echo "</td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='9'>No books found</td></tr>";
                                }
                                
                                // Close the database connection
                                $conn->close();
                          
             
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <!-- Similar structure for other tabs -->
        <div class="tab-pane fade" id="borrowers">
             <div class="card">
            <div class="card-header d-flex justify-content-between">
            <h5>Borrowers</h5>
            <a class="btn btn-primary" href="create_borrower.php" type="button">Add Borrower</a>
             </div>
            <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Last Name</th>
                        <th>Address</th>
                        <th>Phone</th>
                       
                        <th>Email</th>
                        <th>Password</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    
                     $conn = new mysqli($host, $user, $pass, $db);

                     // Check connection
                     if ($conn->connect_error) {
                         die("Connection failed: " . $conn->connect_error);
                     }
                    // Assuming $conn is your database connection
                    $sql = "SELECT * FROM borrowers";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while($borrower = $result->fetch_assoc()) {
                           
                                    echo "<tr>";
                                    echo "<td>" . $borrower['borrower_id'] . "</td>";
                                    echo "<td>" . $borrower['bfirstName'] . "</td>";
                                    echo "<td>" . $borrower['blastName'] . "</td>"; 
                                    echo "<td>" . $borrower['baddress'] . "</td>"; 
                                    echo "<td>" . $borrower['bphone'] . "</td>";
                                    echo "<td>" . $borrower['bemail'] . "</td>";
                                    echo "<td>" . $borrower['bpassword'] . "</td>";
                                   
                                    echo "<td>";
                                    echo "<a href='edit_borrower.php?id="  . $borrower['borrower_id'] . "' class='btn btn-sm btn-primary'>Edit</a>"; 
                                    echo "<a href='delete_borrower.php?id="  .  $borrower['borrower_id'] . "' class='btn btn-sm btn-danger'>Delete</a>";
                                    echo "</td>";
                                    echo "</tr>";
                        
                          
                        
                                    }
                                } else {
                                    echo "<tr><td colspan='2'>No borrowers found</td></tr>";
                                }
                                
                                // Close the database connection
                                $conn->close();
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                

<!-- Similar structure for other tabs -->

    <div class="tab-pane fade" id="shelves">
             <div class="card">
            <div class="card-header d-flex justify-content-between">
            <h5>Shelves</h5>
            <a class="btn btn-primary" href="create_shelf.php" type="button">Add Shelf</a>
             </div>
            <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Shelf id</th>
                        <th>Name</th>
                        
                        <th>Action</th>
                       
                    </tr>
                </thead>
                <tbody>
                    <?php
                    
                     $conn = new mysqli($host, $user, $pass, $db);

                     // Check connection
                     if ($conn->connect_error) {
                         die("Connection failed: " . $conn->connect_error);
                     }
                    // Assuming $conn is your database connection
                    $sql = "SELECT * FROM shelves";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while($shelves = $result->fetch_assoc()) {
                           
                                    echo "<tr>";
                                    echo "<td>" . $shelves['shelf_id'] . "</td>";
                                    echo "<td>" . $shelves['shelf_name'] . "</td>";
                                   
                                   
                                    echo "<td>";
                                    echo "<a href='edit_shelf.php?id=" . $shelves['shelf_id'] . "' class='btn btn-sm btn-primary'>Edit</a>";
                                    echo "<a href='delete_shelf.php?id="  . $shelves['shelf_id']. "' class='btn btn-sm btn-danger'>Delete</a>";
                                    echo "</td>";
                                    echo "</tr>";
                        
                          
                        
                                    }
                                } else {
                                    echo "<tr><td colspan='2'>No shelves found</td></tr>";
                                }
                                
                                // Close the database connection
                                $conn->close();
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                
   

<!-- Similar structure for other tabs -->
    <div class="tab-pane fade" id="staff">
             <div class="card">
            <div class="card-header d-flex justify-content-between">
            <h5>Staff</h5>
            <a class="btn btn-primary" href="create_staff.php" type="button">Add Staff</a>             </div>
            <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                    <th>Staff ID</th>
                       
                        <th>First Name</th>
                        <th>Last name</th>
                        <th>Hire date</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Salary</th>
                       
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    
                     $conn = new mysqli($host, $user, $pass, $db);

                     // Check connection
                     if ($conn->connect_error) {
                         die("Connection failed: " . $conn->connect_error);
                     }
                    // Assuming $conn is your database connection
                    $sql = "SELECT * FROM staff";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while($staff = $result->fetch_assoc()) {
                           
                                    echo "<tr>";
                                    echo "<td>" . $staff['staff_id'] . "</td>";
                                    echo "<td>" . $staff['sfirstName'] . "</td>";
                                    echo "<td>" . $staff['slastName'] . "</td>"; 
                                    echo "<td>" . $staff['hiredate'] . "</td>"; 
                                    echo "<td>" . $staff['saddress'] . "</td>";
                                    echo "<td>" . $staff['sphone'] . "</td>";
                                    echo "<td>" . $staff['semail'] . "</td>";
                                    echo "<td>" . $staff['salary'] . "</td>";
                                    
                                    echo "<td>";
                                  
                                    echo "<a href='edit_staff.php?id="  .$staff['staff_id'] . "' class='btn btn-sm btn-primary'>Edit</a>";
                                    echo "<a href='delete_staff.php?id=" .$staff['staff_id'] ."' class='btn btn-sm btn-danger'>Delete</a>";
                                    echo "</td>";
                                    echo "</tr>";
                        
                          
                        
                                    }
                                } else {
                                    echo "<tr><td colspan='3'>No staff found</td></tr>";
                                }
                                
                                // Close the database connection
                                $conn->close();
                          
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                
 <!-- Similar structure for other tabs -->
 <div class="tab-pane fade" id="categories">
             <div class="card">
            <div class="card-header d-flex justify-content-between">
            <h5>Categories</h5>
            <a class="btn btn-primary" href="create_category.php" type="button">Add Category</a>
             </div>
            <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                          <th>ID</th>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    
                     $conn = new mysqli($host, $user, $pass, $db);

                     // Check connection
                     if ($conn->connect_error) {
                         die("Connection failed: " . $conn->connect_error);
                     }
                    // Assuming $conn is your database connection
                    $sql = "SELECT * FROM categories";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while($category = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . $category['category_id'] . "</td>";
 				                    echo "<td>" . $category['category_name'] . "</td>";
                                    echo "<td>";
                                    echo "<a href='edit_category.php?id="   . $category['category_id'] . "' class='btn btn-sm btn-primary'>Edit</a>";
                                    echo "<a href='delete_category.php?id=" . $category['category_id'] .  "' class='btn btn-sm btn-danger'>Delete</a>";
                                    echo "</td>";
                                    echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='1'>No Categories found</td></tr>";
                                }
                                
                                // Close the database connection
                                $conn->close();
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
          
<div class="tab-pane fade" id="book_copies">
             <div class="card">
            <div class="card-header d-flex justify-content-between">
            <h5>Book Copies</h5>
            <a class="btn btn-primary" href="create_book_copy.php" type="button">Add Book Copy</a>
             </div>
            <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                          <th>Copy</th>
                        <th>Book ID</th>
                      
                        <th> Condition</th>
                        <th> Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    
                     $conn = new mysqli($host, $user, $pass, $db);

                     // Check connection
                     if ($conn->connect_error) {
                         die("Connection failed: " . $conn->connect_error);
                     }
                    // Assuming $conn is your database connection
                    $sql = "SELECT * FROM book_copies";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while($book_copies = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . $book_copies['copy_id'] . "</td>";
 				                    echo "<td>" . $book_copies['book_id'] . "</td>";
                                     echo "<td>" . $book_copies['condition_of_book'] . "</td>";
                                     echo "<td>" . $book_copies['bstatus'] . "</td>";
                                    echo "<td>";
                                    echo "<a href='edit_book_copy.php?id="   . $book_copies['copy_id'] . "' class='btn btn-sm btn-primary'>Edit</a>";
                                    echo "<a href='delete_book_copy.php?id=" . $book_copies['copy_id'] .  "' class='btn btn-sm btn-danger'>Delete</a>";
                                    echo "</td>";
                                    echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='1'>No Categories found</td></tr>";
                                }
                                
                                // Close the database connection
                                $conn->close();
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
    <!-- Add Book Modal -->
    
    <!-- Your HTML code -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"> 
    
  </script>
</body>
</html> 