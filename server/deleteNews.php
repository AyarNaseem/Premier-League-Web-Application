<?php
// Add this code to deleteNews.php

include('server/db_connect.php'); // Include the database connection script

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    // Retrieve news ID from GET request
    $id = $_GET['id'];

    // Prepare SQL statement
    $sql = "DELETE FROM news WHERE id=$id";

    if (mysqli_query($conn, $sql)) {
        echo "News deleted successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
