
<?php
session_start(); 
if (!isset($_SESSION['nomadmin'])) {
  header("Location: login.php"); 
  exit();
}
include "db_conn.php";

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <title>departement</title>
  <link rel="stylesheet" href="INDEX.css">
</head>

<body>

   
    <nav>
	<a href="menu.php">Home</a>
	<a href="index.php">Department</a>
	<a href="intern.php">intern</a>
	<a href="internship.php">internship</a>
	<a href="logout.php">Log out</a>
	<div class="animation start-home"></div>
</nav>

  <div class="container">
   
    

    <table class="table table-hover text-center">
      <thead class="table-dark">
        <tr>
        <a href="add_new.php" class="btn_ADD">+</a>
        <th scope="col">Name admin</th>
          <th scope="col">Departement</th>
          <th scope="col">delete / edit</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $id_d=$_SESSION['idadmin'];
        $sql = "SELECT * FROM `departement` where idadmin=$id_d";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
        ?>
          <tr class="content">
          <td><?php echo  $_SESSION['nomadmin']  ?></td>
            <td><?php echo $row["nomdeprt"] ?></td>
            <td>
              <a href="edit.php?id=<?php echo $row["iddeprt"] ?>" class="link-dark_E"><i class="fa-solid fa-pen-to-square fs-5 me-3"></i></a>
              <a href="delete.php?id=<?php echo $row["iddeprt"] ?>" class="link-dark_D"><i class="fa-solid fa-trash fs-5"></i></a>
            </td>
          </tr>
        <?php
       
        }
        ?>
      </tbody>
    </table>
    
  </div>

</body>

</html>