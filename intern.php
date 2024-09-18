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
  <title>INTERN</title>
 <link rel="stylesheet" href="intern.css">
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
        <a href="add_intern.php" class="btn_ADD">+</a>
        <th scope="col">Name admin</th>
          <th scope="col">first name</th>
          <th scope="col">last name</th>
          <th scope="col">birthday</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $id_int=$_SESSION['idadmin'];
        $sql = "SELECT * FROM `intern`where idadmin=$id_int";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
        ?>
          <tr>
          <td><?php echo $_SESSION['nomadmin']?></td>
            <td><?php echo $row["first_name_intern"] ?></td>
            <td><?php echo $row["last_name_intern"] ?></td>
            <td><?php echo $row["birthday_intern"] ?></td>
            <td>
              <a href="edit_intern.php?id=<?php echo $row["id_intern"] ?>" class="link-dark_E"><i class="fa-solid fa-pen-to-square fs-5 me-3"></i></a>
              <a href="delete_intern.php?id=<?php echo $row["id_intern"] ?>" class="link-dark_D"><i class="fa-solid fa-trash fs-5"></i></a>
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