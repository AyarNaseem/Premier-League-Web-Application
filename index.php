<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap" rel="stylesheet"> 
    <link rel="icon" type="image/png" href="./image/pl.png"/>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Premier League</title>
    
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-D7BOjr2DkmoR8EZRX0lSMv6JxQF07po5wVgB0iw9Drlw+H5JvqPc6iuE9NEoID1u" crossorigin="anonymous">
    <?php
        include('server/db_connect.php');
    ?>
</head>
<body>


<?php
include("header.php");
include("navbar.php");
include('sidebar.php');
include('./news.php');
include ("./standing.php");
include ("./fixture.php");
include ("./results.php");
include('./stats.php');
include('./contact.php');
?>



</body>
</html>