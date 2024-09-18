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
        $sql = "DELETE FROM `departement` WHERE iddeprt = $id AND idadmin = $idadmin"; 
        $result = mysqli_query($conn, $sql);

        if ($result) {
            header("Location: index.php");
        } else {
            echo "Failed: " . mysqli_error($conn);
        }
    } else {
       
        header("Location: index.php");
    }
} else {
    
    echo '<script>
    var id = '.$_GET["id"].';
    var confirmDelete = confirm("Are you sure you want to delete this?");
    if(confirmDelete) {
        window.location.href = "delete.php?id="+id+"&confirm=yes";
    } else {
        window.location.href = "delete.php?id="+id+"&confirm=no";
    }
    </script>';
}

