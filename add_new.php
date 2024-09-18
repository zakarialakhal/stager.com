<?php
session_start();
if (!isset($_SESSION['nomadmin'])) {
  header('Location: login.php');
  exit();
}
include "db_conn.php";

if (isset($_POST["submit"])) {
   if(isset($_SESSION['idadmin'])) {
       $idadmin = $_SESSION['idadmin'];
       $nomdeprt = $_POST['nomdeprt'];

       $_SESSION['nomdeprt'] = $nomdeprt;

       $check_admin_query = "SELECT idadmin FROM administrator WHERE idadmin = $idadmin";
       $check_admin_result = mysqli_query($conn, $check_admin_query);

       if(mysqli_num_rows($check_admin_result) > 0) {
           $sql = "INSERT INTO `departement`(`idadmin`, `nomdeprt`) VALUES ($idadmin, '$nomdeprt')";
           $result = mysqli_query($conn, $sql);
           if ($result) {
              header("Location: index.php");
           } else {
              echo "Failed: " . mysqli_error($conn);
           }
       } else {
           echo "Failed: Specified administrator id does not exist.";
       }
   } else {
       echo "Failed: Administrator not logged in.";
   }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="EDIT.css">
   <title>Add New Department</title>
</head>

<body>
   <div class="container">
      <div class="text-center mb-4">
         <h3>Add New Department</h3>
      </div>

      <div >
         <form action="" method="post">
            <div class="input-box">
               <label class="form-label">Department Name:</label>
               <input type="text" required name="nomdeprt" placeholder="Enter department name">
            </div>

            <div class="btn-container">
               <button type="submit" class="btn btn-success" name="submit">Save</button>
               <a href="index.php" class="btn btn-danger">Cancel</a>
            </div>
         </form>
      </div>
   </div>
</body>

</html>
