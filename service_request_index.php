<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>vehicle</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
</head>
<body style='background-image:url(https://thumbs.dreamstime.com/z/service-mechanic-showing-his-work-customers-car-to-clie-dedicated-professional-customer-around-her-which-has-just-61664157.jpg);background-size:cover;'>
<?php require_once('adminpanel.php') ?>

    <div class="container my-5">
    <h1 style='color:white;font-size:45px;'><center> Vehicle Service Management System </center></h1>
        <h2 style='color: white;'>List of Service Requests</h2>
        <a class="btn btn-primary" href="service_request_create.php" role="buttom">Create New</a>
        <br>
        <table class="table">
            <thead>
                <tr style='color: white;'>
                    <th>id</th>
                    <th>Date Created</th>
                    <th>Owner Name</th>
                    <th>Services</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
<tbody>
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "vehicle";


    // Create connection
$conn = new mysqli($servername, $username, $password, $dbname);



// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

//read all row from database table
$sql = "SELECT * From service_requests";
$res = $conn->query($sql);


if (!$res) {
    die("Invalid query: " . $conn->error);
}


//read data of each row
$num=1;
while($row = $res->fetch_assoc()) {
    echo "
    <tr style='color: white;'>
        <td>$num</td>
        <td>$row[date_created]</td>
        <td>$row[owner_name]</td>
        <td>$row[services]</td>
        <td>$row[status]</td>
        
        
        <td>
            <a class='btn btn-primary btn-sm' href='service_request_edit.php?id=$row[id]'>Edit</a>
            <a class='btn btn-danger btn-sm' href='service_request_delete.php?id=$row[id]'>Delete</a>
            
</td>
</tr>
    ";
    $num++;
}


    ?>
    
</tbody>
</table>
</div>
</body>
</html>