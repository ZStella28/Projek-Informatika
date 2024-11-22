<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM contacts WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Data deleted successfully!";
        header("Location: read.php");
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
