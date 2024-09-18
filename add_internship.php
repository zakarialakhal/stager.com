<?php 
session_start();
if (!isset($_SESSION['idadmin'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include_once "db_conn.php";
    $intern_id = htmlspecialchars($_POST['id_intern']);
    $department_id = htmlspecialchars($_POST['id_depart']);
    $start_date = htmlspecialchars($_POST['start_training']);
    $end_date = htmlspecialchars($_POST['end_training']);
    $admin_id = $_SESSION['idadmin'];

    $sql = "INSERT INTO internship (id_intern, idadmin, iddeprt, start_training, end_training) VALUES ('$intern_id', '$admin_id', '$department_id', '$start_date', '$end_date')";
    if (mysqli_query($conn, $sql)) {
        header("Location: internship.php");
        exit();
    } else {
        $message = "Error: " . mysqli_error($conn);
    }
}

include_once "db_conn.php";
$id = $_SESSION['idadmin'];
$interns = mysqli_query($conn, "SELECT id_intern, first_name_intern, last_name_intern FROM intern WHERE idadmin = $id");
$departments = mysqli_query($conn, "SELECT iddeprt, nomdeprt FROM departement WHERE idadmin = $id");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="edit_internship.css">
</head>
<body>
<section>
    <div class="form">
        <h2>Add Internship</h2>
        <p class="erreur_message">
            <?php 
            if(isset($message)){
                echo htmlspecialchars($message);
            }
            ?>
        </p>
        <form action="" method="POST">
            <label for="id_intern">Intern</label>
            <select id="id_intern" name="id_intern" required>
                <option value="">Select Intern</option>
                <?php while ($row = mysqli_fetch_assoc($interns)) { ?>
                    <option value="<?= htmlspecialchars($row['id_intern']) ?>"><?= htmlspecialchars($row['first_name_intern'] . ' ' . $row['last_name_intern']) ?></option>
                <?php } ?>
            </select>

            <label for="id_depart">Department</label>
            <select id="id_depart" name="id_depart" required>
                <option value="">Select Department</option>
                <?php while ($row = mysqli_fetch_assoc($departments)) { ?>
                    <option value="<?= htmlspecialchars($row['iddeprt']) ?>"><?= htmlspecialchars($row['nomdeprt']) ?></option>
                <?php } ?>
            </select>

            <label for="start_training">Start Date</label>
            <input type="date" id="start_training" name="start_training" required>

            <label for="end_training">End Date</label>
            <input type="date" id="end_training" name="end_training" required>

            <input type="submit" value="Add" name="button">
            <input type="button" value="Cancel" onclick="window.location.href='internship.php';">
        </form>
    </div>
</section>
</body>
</html>
