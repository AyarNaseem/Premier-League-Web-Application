<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "premier-league";
    
    // Create a database connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    
    // Check for connection errors
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
?>