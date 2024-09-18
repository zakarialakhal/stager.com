<?php 
session_start();
if (!isset($_SESSION['nomadmin'])) {
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Internship Management</title>
  <link rel="stylesheet" href="internship.css">
    <script>
        function confirmDelete() {
            return confirm("Are you sure want to delete the internship?");
        }
    </script>
</head>
<body>

<nav>
        <a href="menu.php">Home</a>
        <a href="index.php">Department</a>
        <a href="intern.php">Intern</a>
        <a href="internship.php">Internship</a>
        <a href="logout.php">Log Out</a>
        <div class="animation start-home"></div>
</nav>

<div class="container">
    <a href="add_internship.php" class="Btn_add">+</a>
    <table>
        <tr id="items">
             <th>Admin Name</th>
            <th>First Name Intern</th>
            <th>Last Name Intern</th>
            <th>Department Name</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Actions</th>
        </tr>
        <?php 
            include "db_conn.php";
            $id = $_SESSION['idadmin'];
            $sql = "
                SELECT internship.id_internship,
                    intern.first_name_intern,
                    intern.last_name_intern, 
                    departement.nomdeprt, 
                    administrator.nomadmin,
                    internship.start_training, 
                    internship.end_training
                FROM 
                    internship
                JOIN departement ON internship.iddeprt = departement.iddeprt
                JOIN intern ON internship.id_intern = intern.id_intern
                JOIN administrator ON internship.idadmin = administrator.idadmin
                WHERE internship.idadmin = $id
                ";
            $result = mysqli_query($conn, $sql);

            
            if (!$result) {
                echo "Error: " . mysqli_error($conn);
                exit();
            }

            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){
                    ?>
                    <tr><td><?= htmlspecialchars($row['nomadmin']) ?></td>
                        <td><?= htmlspecialchars($row['first_name_intern']) ?></td>
                        <td><?= htmlspecialchars($row['last_name_intern']) ?></td>
                        <td><?= htmlspecialchars($row['nomdeprt']) ?></td>
                        
                        <td><?= htmlspecialchars($row['start_training']) ?></td>
                        <td><?= htmlspecialchars($row['end_training']) ?></td>
                        <td>
                            <a href="edit_internship.php?id=<?= $row['id_internship'] ?>" class="link-dark_E"><i class="fa-solid fa-pen-to-square fs-5 me-3"></i></a>
                            <a href="delete_internship.php?id=<?= $row['id_internship'] ?>" class="link-dark_D" onclick="return confirmDelete();"><i class="fa-solid fa-trash fs-5"></i></a>
                        </td>
                    </tr>
                    <?php
                }
            } 
        ?>
    </table>
</div>
</body>
</html>
