<?php


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "vehicle";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);



$id = "";
$category = "";
$status = "";

$errorMessage = "";
$successMessage ="";

if ( $_SERVER['REQUEST_METHOD'] == 'GET' ) {
    //GET method: Show the data of the category

    if ( !isset($_GET["id"]) ) {
        header("location: category_index.php");
        exit;
    }

    $id = $_GET["id"];

    //read the row of the selected Category from database table
    $sql = "SELECT * From categories WHERE id=$id";
    $res = $conn->query($sql);
    $row = $res->fetch_assoc();


    if ( !$row) {
        header("location: category_index.php");
        exit;
    }

 
    $category = $row["category"];
    $status = $row["status"];

}
else {
    //POST method: Update the data of the Category

    $id = $_POST["id"];
    $category = $_POST["category"];
    $status = $_POST["status"];

    do {

        if ( empty($id) || empty($category) ) {
            $errorMessage = "All the fields are required";
            break;
        }


        $sql = "UPDATE categories 
               SET category = '$category', status ='$status'
               WHERE id = $id";

        $res = $conn->query($sql);

        if ( !$res) {
            $errorMessage = "Invalid query: " . $conn->error;
            break;
        }

        $category = "";
        $status ="";

        $successMessage = "Category updated correctly";

        echo"<script> alert('Category Updated Successfully!');
window.location.replace('category_index.php');
</script>";
        //header("location: category_index.php");
        exit;


    } while (true);

}





?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>vehicle</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container my-5">
        <h2>Create New Category</h2>


        <?php
        if ( !empty($errorMessage) ) {
            echo "
            <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                <strong>$errorMessage</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
        }
        ?>



        <form method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Category Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="category" value="<?php echo $category; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Status</label>
                <div class="col-sm-6">
                    <select name="status">
                        <option value="Active">Active</option>
                        <option value="Inactive">Inactive</option>
    </select>
                </div>
            </div>



            <?php
            if ( !empty($successMessage) ) {
                echo "
                <div class='row mb-3'>
                    <div class='offset-sm-3 col-sm-6'>
                        <div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <strong>$successMessage</strong>
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>
                    </div>
                </div>
                ";
            }



            ?>

            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="category_index.php" role="button">Cancel</a>
                </div>
            </div>




        </form>

    </div>
</body>
</html>