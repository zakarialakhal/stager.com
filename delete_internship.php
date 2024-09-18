<?php
session_start();
include "db_conn.php";


if(!isset($_SESSION['idadmin'])) {
    header("location: login.php"); 
    exit();
}

$id = $_GET['id'];
$sql = "DELETE FROM internship WHERE id_internship=$id";
if (mysqli_query($conn, $sql)) {
    header("location: internship.php");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
?>
