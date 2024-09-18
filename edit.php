<?php
session_start();

include "db_conn.php";

if (isset($_SESSION['idadmin'])) { 
    $idadmin = $_SESSION['idadmin']; 
} else {
    header("location: login.php"); 
    exit();
}

$id = $_GET["id"];

if (isset($_POST["submit"])) {
  $nomdeprt = $_POST['nomdeprt'];

  $sql = "UPDATE `departement` SET `idadmin`='$idadmin', `nomdeprt`='$nomdeprt' WHERE iddeprt=$id";
  $result = mysqli_query($conn, $sql);

  if ($result) {
    header("Location: index.php");
  } else {
    echo "Failed: " . mysqli_error($conn);
  }
}

$sql = "SELECT * FROM `departement` WHERE iddeprt=$id LIMIT 1";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>WWW.edit.com</title>
  <link rel="stylesheet" href="EDIT.css">
</head>

<body>
  <div class="container">
    <div class="text-center mb-4">
      <h3>Edit Department Information</h3>
    </div>

    <div>
      <form method="post">
        <div class="row mb-3">
          <div class="col">
            <label class="form-label">Department Name:</label>
            <input type="text" class="form-control" required name="nomdeprt" value="<?php echo $row['nomdeprt'] ?>">
          </div>
        </div>
        <div>
          <button type="submit" class="btn btn-success" name="submit">Update</button>
          <a href="index.php" class="btn btn-danger">Cancel</a>
        </div>
      </form>
    </div>
  </div>
</body>

</html>
