<?php
session_start(); 

include "db_conn.php";

if(isset($_SESSION['idadmin'])) { 
    $idadmin = $_SESSION['idadmin']; 
} else {
    header("location: login.php"); 
    exit();
}
if(isset($_GET["id"]) && isset($_GET["confirm"])) {
    if($_GET["confirm"] == "yes") {
        $id = $_GET["id"];
        $sql = "DELETE FROM `intern` WHERE id_intern=$id"; 
        $result = mysqli_query($conn, $sql);

        if ($result) {
            header("Location: intern.php");
        } else {
            echo "Failed: " . mysqli_error($conn);
        }
    } else {
       
        header("Location: intern.php");
    }
} else {
    
    echo '<script>
    var id = '.$_GET["id"].';
    var confirmDelete = confirm("Are you sure you want to delete this?");
    if(confirmDelete) {
        window.location.href = "delete_intern.php?id="+id+"&confirm=yes";
    } else {
        window.location.href = "delete_intern.php?id="+id+"&confirm=no";
    }
    </script>';
}