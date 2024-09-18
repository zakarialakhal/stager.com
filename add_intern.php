<?php
session_start();
if (!isset($_SESSION['nomadmin'])) {
   header('Location: login.php');
   exit();
}
include "db_conn.php";

if (isset($_POST["submit"])) {
   $first_name = $_POST['first_name_intern'];
   $last_name = $_POST['last_name_intern'];
   $birthday = $_POST['birthday_intern'];
   $idadmin = $_SESSION['idadmin'];
  
   $_SESSION['first_name_intern'] = $first_name;
   $_SESSION['last_name_intern'] = $last_name;

   $sql = "INSERT INTO `intern`(`id_intern`, `first_name_intern`, `last_name_intern`, `birthday_intern`, `idadmin`) VALUES (NULL,'$first_name','$last_name','$birthday','$idadmin')";
   $result = mysqli_query($conn, $sql);

   if ($result) {
      header("Location: intern.php?msg=New record created successfully");
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
   <title>www.intern.ma</title>
   <link rel="stylesheet" href="ADD_EDIT_intern.css">
</head>

<body>
   <div class="form">
      <h2>Add New Intern</h2>
      <form action="" method="post">
         <div>
            <label for="first_name_intern">First Name:</label>
            <input type="text" id="first_name_intern" name="first_name_intern" required placeholder="First Name...">
         </div>
         <div>
            <label for="last_name_intern">Last Name:</label>
            <input type="text" id="last_name_intern" name="last_name_intern" required placeholder="Last Name...">
         </div>
         <div>
            <label for="birthday_intern">Birthday:</label>
            <input type="date" id="birthday_intern" name="birthday_intern" required>
         </div>
         <div>
            <input type="submit" name="submit" value="Save">
            <input type="button" value="Cancel" onclick="window.location.href='intern.php'">
         </div>
         <div class="erreur_message">
            <?php
            if (isset($message)) {
               echo $message;
            }
            ?>
         </div>
      </form>
   </div>
</body>

</html>
