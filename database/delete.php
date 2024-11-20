<?php
    require_once "conn.php";
    $id = $_GET["id"];
    $query = "DELETE FROM reservasi WHERE id = '$id'";
    if (mysqli_query(mysql: $conn, query: $query)) {
        header(header: "location: index.php");

    } else {
        echo "Something went wrong. PLease try again later.";
    }   
?>