<?php
// Include the database connection
include('server/db_connect.php');
session_start();

if(isset($_SESSION['admin_type'])){
    if($_SESSION['admin_type'] != 'result'){
        header('Location: login.php');
        exit();
    }
} else {
    header('Location: login.php');
    exit();
}

// Function to update match result
function updateResult($conn, $id, $home_team, $away_team, $home_goals, $away_goals, $home_scorers, $away_scorers) {
    // Prepare the SQL statement with placeholders
    $sql = "UPDATE results SET home_team = ?, away_team = ?, home_goals = ?, away_goals = ?, home_scorers = ?, away_scorers = ? WHERE id = ?";
    
    // Prepare the statement
    $stmt = $conn->prepare($sql);
    
    
    // Convert scorers arrays to strings with comma as delimiter
    $home_scorers_str = implode(',', $home_scorers);
    $away_scorers_str = implode(',', $away_scorers);
    // Bind the parameters
    $stmt->bind_param("ssiissi", $home_team, $away_team, $home_goals, $away_goals, $home_scorers_str, $away_scorers_str, $id);

    if ($stmt->execute()) {
        echo '<script>alert("Match result updated successfully.");</script>';
    } else {
        echo '<script>alert("Error updating match result: ' . $stmt->error . '");</script>';
    }

}


// Handle form submission for updating match result
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_result'])) {
    $id = $_POST['id'];
    $home_team = $_POST['home_team'];
    $away_team = $_POST['away_team'];
    $home_goals = $_POST['home_goals'];
    $away_goals = $_POST['away_goals'];
    $home_scorers = explode(',', $_POST['home_scorers']);
    $away_scorers = explode(',', $_POST['away_scorers']);

    // Check if goals are not negative
        if ($home_goals >= 0 && $away_goals >= 0) {
        $update_result = updateResult($conn, $id, $home_team, $away_team, $home_goals, $away_goals, $home_scorers, $away_scorers);
        if ($update_result === true) {
            echo '<script>alert("Match result updated successfully.");</script>';
        } else {
            echo '<script>alert("' . $update_result . '");</script>';
        }
    } else {
        // echo '<script>alert("Please fill in all required fields.");</script>';
        echo '<script>alert("Goals cannot be negative.");</script>';
    }

}

// Fetch match result data from the database
$sql = "SELECT * FROM results";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;

        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            /* justify-content: center; */
            align-items: center;
            padding: 30px;
        }

        input[type="text"],
        input[type="number"],
        textarea,
        input[type="submit"] {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            /* Adjust width as needed */
            /* width: 110px; 
            height: 40px; */
            /* Remove fixed widths and heights */
            /* width: 110px; */
            /* height: 40px; */
            text-align: center;
        }

        input[type="text"]{
            background: #afa;
            /* height: 10px; */
        }
        input[type="number"]{
            background: #87ceeb;
            /* height: 10px; */
            width: 80px;
        }

        textarea {
            /* height: 40px;  */
            /* Adjust width as needed */
            width: 200px;
            resize: none;
            background: #c3e5d7;

        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<section id="result">
    <div class="result-title">
        <h1>Results</h1>
    </div>
    
    <div class="result-table">
        <table>
            <tr>
            </tr>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    // Retrieve match details
                    $id = $row['id'];
                    $home_team = $row['home_team'];
                    $away_team = $row['away_team'];
                    $home_goals = $row['home_goals'];
                    $away_goals = $row['away_goals'];
                    $home_scorers = explode('*?', $row['home_scorers']);
                    $away_scorers = explode('*?', $row['away_scorers']);

                    echo "<tr>";

                    echo "<td>
                            <form method='post' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "'>
                                <input type='hidden' name='id' value='$id'>
                                <input type='text' name='home_team' value='$home_team' placeholder='Home Team' required>
                                <input type='number' name='home_goals' value='$home_goals' placeholder='Home Goals' required min='0'>
                                <textarea name='home_scorers' placeholder='Home Scorers' >" . implode(PHP_EOL, $home_scorers) . "</textarea>
                                <input type='text' name='away_team' value='$away_team' placeholder='Away Team' required>
                                <input type='number' name='away_goals' value='$away_goals' placeholder='Away Goals' required min='0'>
                                <textarea name='away_scorers' placeholder='Away Scorers' >" . implode(PHP_EOL, $away_scorers) . "</textarea>
                                <input type='submit' name='update_result' value='Update'>
                            </form>
                        </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No match results available.</td></tr>";
            }
            ?>
        </table>
    </div>  
</section>
<a href="logout.php">LogOut</a>

</body>
</html>
