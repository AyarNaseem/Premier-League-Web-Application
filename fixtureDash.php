<?php
session_start();

if(isset($_SESSION['admin_type'])){
    if($_SESSION['admin_type'] != 'fixture'){
        header('Location: login.php');
        exit();
    }
} else {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Games Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        #update-games {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        .update-games-title {
            text-align: center;
            margin-bottom: 20px;
        }

        .game-list table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .game-list table th, .game-list table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .game-list table th {
            background-color: #007bff;
            color: #fff;
        }

        .game-list table td form {
            display: flex;
            align-items: center;
        }

        .game-list table td form select, 
        .game-list table td form input[type="date"], 
        .game-list table td form input[type="time"], 
        .game-list table td form input[type="submit"],
        .game-list table td form input[type="text"] {
            margin-right: 10px;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }

        .game-list table td form input[type="date"],
        .game-list table td form input[type="time"] {
            width: 120px; /* Adjust width as needed */
        }

        .game-list table td form input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 8px 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .game-list table td form input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .game-list table td form select {
            width: 200px; 
        }
    </style>
</head>
<body>

<section id="update-games">

    <div class="update-games-title">
        <h1>Update Games</h1>
    </div>

    <div class="game-list">
        <table>
            <tr>
                <th colspan="9" style="text-align:center;" >Games Fixture</th>
            </tr>
            <?php
            include('server/db_connect.php');

            // Function to update game details
            function updateGame($conn, $id, $home_team, $away_team, $match_date, $match_time) {
                $sql = "UPDATE fixtures SET home_team = '$home_team', away_team = '$away_team', match_date = '$match_date', match_time = '$match_time' WHERE id = '$id'";
                if ($conn->query($sql) === TRUE) {
                    return true;
                } else {
                    return "Error updating game details: " . $conn->error;
                }
            }

            // Handle form submission
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_game'])) {
                $id = $_POST['game_id'];
                $home_team = $_POST['home_team'];
                $away_team = $_POST['away_team'];
                $match_date = $_POST['match_date'];
                $match_time = $_POST['match_time'];

                $update_result = updateGame($conn, $id, $home_team, $away_team, $match_date, $match_time);
                if ($update_result === true) {
                    echo "Game details updated successfully.";
                } else {
                    echo $update_result;
                }
            }

            // Retrieve game details from the database
            $sql = "SELECT * FROM fixtures order by match_date , match_time";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                        echo "<td>
                                <form method='post' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "'>
                                    <input type='hidden' name='game_id' value='{$row['id']}'>
                                    <input type='text' name='home_team' value='{$row['home_team']}' required>
                                    <input type='text' name='away_team' value='{$row['away_team']}' required>
                                    <input type='date' name='match_date' value='{$row['match_date']}' required>
                                    <input type='time' name='match_time' value='{$row['match_time']}' required>
                                    <input type='submit' name='update_game' value='Update'>
                                </form>
                            </td>";
                    echo "</tr>";
                }
            } else {
                    echo "<tr><td colspan='9'>No games available.</td></tr>";
            }
            ?>
        </table>
    </div>

</section>
<a href="logout.php">logOut</a>
</body>
</html>
