<?php
include('server/db_connect.php');

session_start();

if(isset($_SESSION['admin_type'])){
    if($_SESSION['admin_type'] != 'standing'){
        header('Location: login.php');
        // exit();
    }
} else {
    header('Location: login.php');
    // exit();
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_statistics'])) {
    $club_name = $_POST['club_name'];
    // $played = $_POST['played'];
    $won = $_POST['won'];
    $draw = $_POST['draw'];
    $lost = $_POST['lost'];
    $plus_minus = $_POST['plus_minus'];

    $sql = "UPDATE standings SET won = '$won', draw = '$draw', lost = '$lost', plus_minus = '$plus_minus' WHERE club_name = '$club_name'";
    if ($conn->query($sql) === TRUE) {
        header("Location: standingDash.php");
        exit();
        //echo "Statistics updated successfully.";
    } else {
        echo "Error updating statistics: " . $conn->error;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>League Statistics Dashboard</title>
    <!-- <link rel="stylesheet" href="css/dashboard.css"> -->

    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h1 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 10px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }
        
        td img{
            height: 40px;
            padding-right: 2px;
        }
        
        
        
        td:first-child{
            display: flex;
            align-items: center;
        }
        
        th {
            background-color: #f2f2f2;
        }
        th:last-child{
            background: blanchedalmond;
        }
        tr td{
            text-align: center;
        }

        form {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-left: 40px;
            background-color: blanchedalmond;
        }

        input[type="number"], input[type="text"] {
            padding: 5px;
            width: 60px;
            margin-right: 10px;
        }

        input[type="submit"] {
            padding: 5px 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
        label{
            font-weight: bold;
        }
        
    </style>
</head>

<body>
    <h1>League Statistics Dashboard</h1>

    <!-- Display team statistics in a table -->
    <table>
        <tr>
            <th>Club</th>
            <!-- <th>Played</th> -->
            <th>Won</th>
            <th>Draw</th>
            <th>Lost</th>
            <th>Plus-Minus</th>
            <th>Update</th>
        </tr>
        <?php
        // include ('server/db_connect.php');
        $sql = "SELECT * FROM standings order by points DESC,goal_difference DESC";
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>
                <img src='{$row['club_logo']}' alt=''>
                <p>{$row['club_name']}</p>
            </td>";
            // echo "<td>{$row['played']}</td>";
            echo "<td>{$row['won']}</td>";
            echo "<td>{$row['draw']}</td>";
            echo "<td>{$row['lost']}</td>";
            echo "<td>{$row['plus_minus']}</td>";
            echo "<td>
                    <form method='post' action=''>
                    <input type='hidden' name='club_name' value='{$row['club_name']}'>
                    <!-- <input type='number' name='played' value='{$row['played']}'> -->


                    <label for='won'>Won:</label>
                    <input type='number' name='won' value='{$row['won']}'><br>
                    <label for='draw'>Draw:</label>
                    <input type='number' name='draw' value='{$row['draw']}'><br>
                    <label for='lost'>Lost:</label>
                    <input type='number' name='lost' value='{$row['lost']}'><br>
                    <label for='plus_minus'>+/- :</label>
                    <input type='text' name='plus_minus' value='{$row['plus_minus']}'><br>
                    <input type='submit' name='update_statistics' value='Update'>
                    </form></td>";
            echo "</tr>";
        }
        ?>
    </table>
    <a href="logout.php">logout</a>
</body>
</html>
