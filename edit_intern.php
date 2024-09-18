<?php
session_start();
if (!isset($_SESSION['nomadmin'])) {
  header('Location: login.php');
  exit();
}
include "db_conn.php";
$id = $_GET["id"];
if (isset($_POST["submit"])) {
  $first_name = $_POST['first_name_intern'];
  $last_name = $_POST['last_name_intern'];
  $birthday = $_POST['birthday_intern'];

  $_SESSION['first_name_intern'] = $first_name;
  $_SESSION['last_name_intern'] = $last_name;

  $sql = "UPDATE `intern` SET `first_name_intern`='$first_name',`last_name_intern`='$last_name',`birthday_intern`='$birthday' WHERE id_intern = $id";
  $result = mysqli_query($conn, $sql);

  if ($result) {
    header("Location: intern.php?msg=Data updated successfully");
  } else {
    echo "Failed: " . mysqli_error($conn);
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>edit_intern.ma</title>
  
</head>

<body>
  <div class="form">
    <h2>Edit Intern Information</h2>
    <p class="text-muted">Click update after changing any information</p>

    <?php
    $sql = "SELECT * FROM `intern` WHERE id_intern = $id LIMIT 1";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    ?>

    <form action="" method="post">
      <div>
        <label for="first_name_intern">First Name:</label>
        <input type="text" id="first_name_intern" name="first_name_intern" required value="<?php echo $row['first_name_intern'] ?>">
      </div>
      <div>
        <label for="last_name_intern">Last Name:</label>
        <input type="text" id="last_name_intern" name="last_name_intern" required value="<?php echo $row['last_name_intern'] ?>">
      </div>
      <div>
        <label for="birthday_intern">Birthday:</label>
        <input type="date" id="birthday_intern" name="birthday_intern" required value="<?php echo $row['birthday_intern'] ?>">
      </div>
      <div>
        <input type="submit" name="submit" value="Update">
        <input type="button" value="Cancel" onclick="window.location.href='intern.php'">
      </div>
    </form>
  </div>
</body>

</html>
