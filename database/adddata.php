<?php
require_once "conn.php";

if (isset($_POST['submit'])) {
    // Retrieve form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $people_count = $_POST['people_count'];
    $appointment_date = $_POST['appointment_date'];
    $appointment_time = $_POST['appointment_time'];
    $message = $_POST['message'];

    // Validate inputs
    if ($name !== "" && $email !== "" && $phone !== "" && $people_count !== "" && $appointment_date !== "" && $appointment_time !== "" && $message !== "") {
        // Use prepared statements to prevent SQL injection
        $stmt = $conn->prepare("INSERT INTO reservasi (name, email, phone, people_count, appointment_date, appointment_time, message) VALUES ('$name', '$email', '$phone', '$people_count', '$appointment_date', '$appointment_time', '$message')");

        // Execute the query and check if successful
        if ($stmt->execute()) {
            header("Location: index.php");
            exit; // Always exit after header redirection
        } else {
            echo "Something went wrong. Please try again later.";
        }
        $stmt->close();
    } else {
        echo "Name, email, phone, people_count, appointment_date, appointment_time, and message cannot be empty!";
    }
}

// Close database connection
$conn->close();
?>
