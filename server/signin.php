<?php
// Initialize the session
session_start();

// Check if the user is already logged in, if yes then redirect to home page

if (isset($_SESSION['username'])) {
    header("location: index.php");
    exit;
}

if (isset($_GET['message'])) {
    $message = $_GET['message'];
    echo "<p id='err' style='color:orange !important;'>$message</p>";
}

// Step 2: Process the form submission and check if the user exists in the MySQL table
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    require 'db_connect.php';

    $username = strtolower($_POST["username"]);
    $password = $_POST["password"];

  // prepare the SQL statement to select the user from the database
    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";

    // execute the SQL statement and retrieve the user record
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

  // check if the user was found in the database
if ($row) {

    // store the username in the session
    $username = $row['username'];
    $_SESSION['username'] = $username;

    // close the database connection
    mysqli_close($conn);

    // redirect the user to the home page
    header('Location: index.php');
    exit;
} else {
    // display an error message
    echo "<p id='err'>Invalid username or password.</p>";
}
}
