<?php
define(constant_name: 'DB_SERVER', value: 'localhost');
define(constant_name: 'DB_USERNAME', value: 'root');
define(constant_name: 'DB_PASSWORD', value: '');
define(constant_name: 'DB_NAME', value: 'appointment_db'); $conn = mysqli_connect
(hostname: DB_SERVER, username: DB_USERNAME, password: DB_PASSWORD, database: DB_NAME);
if ($conn === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>
