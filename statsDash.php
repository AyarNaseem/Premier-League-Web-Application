<?php
// Include database connection
include('server/db_connect.php');

session_start();

if(isset($_SESSION['admin_type'])){
    if($_SESSION['admin_type'] != 'stats'){
        header('Location: login.php');
        // exit();
    }
} else {
    header('Location: login.php');
    // exit();
}

// Function to generate the player statistic HTML
function generatePlayerStats($sql, $conn, $stat_type) {
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        $rank = 1;
        while ($row = $result->fetch_assoc()) {
            $id = $row['id'];
            $player_name = $row['player_name'];
            $stat_value = $row['stat_value'];
            $image_source = "./image/players/" . strtolower(str_replace(' ', '_', $player_name)) . ".png";

            echo "<div class='box'>
                    <img src='$image_source' alt='$player_name'>
                    <div class='name'><span>$rank.&nbsp;</span>$player_name<br></div>
                    <form method='post' action='" . $_SERVER['PHP_SELF'] . "'>
                        <input type='hidden' name='id' value='$id'>
                        <input type='hidden' name='stat_type' value='$stat_type'>
                        <input type='text' name='player_name' value='$player_name'>
                        <input type='number' name='stat_value' value='$stat_value' placeholder='New Value'>
                        <input type='submit' name='update_stat' value='Update'>
                    </form>
                </div>";
            $rank++;
        }
    } else {
        echo "0 results";
    }
}

// Function to add a new item (goal, assist, clean sheet)
function addNewItem($conn, $table_name, $player_name, $stat_value) {
    $sql = "INSERT INTO $table_name (player_name, stat_value) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $player_name, $stat_value);

    if ($stmt->execute()) {
        echo "New item added successfully.";
    } else {
        echo "Error adding new item: " . $stmt->error;
    }
}

// Check if the update_stat form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_stat'])) {
    // Get data from the form
    $id = $_POST['id'];
    $stat_type = $_POST['stat_type'];
    $new_player_name = $_POST['player_name'];
    $new_stat_value = $_POST['stat_value'];

    // Update the statistic in the database
    $sql = "UPDATE $stat_type SET player_name = ?, stat_value = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sii", $new_player_name, $new_stat_value, $id);

    if ($stmt->execute()) {
        echo "Statistic updated successfully.";
    } else {
        echo "Error updating statistic: " . $stmt->error;
    }
}

// Check if the add_new_item form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_new_item'])) {
    // Get data from the form
    $table_name = $_POST['table_name'];
    $new_player_name = $_POST['new_player_name'];
    $new_stat_value = $_POST['new_stat_value'];

    // Add the new item to the database
    addNewItem($conn, $table_name, $new_player_name, $new_stat_value);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Player Statistics Dashboard</title>

    <style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f4f4f4;
    }

    section#stats {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
    }

    .topScorer-title {
        width: fit-content;
        text-align: center;
        margin-top: 30px;
    }

    /* Styling for goals */
    .goal-title h1 {
        color: white;
        background: #38003c;
        padding: 10px;
    }

    /* Styling for assists */
    .assist-title h1 {
        background:#00ff85;
        color: #38003c;
        border: #38003c 1px solid;
        padding: 10px;
    }

    /* Styling for clean sheets */
    .cleanSheet-title h1 {
        background:#fff200;
        color: #38003c;
        border: #38003c 1px solid;
        padding: 10px;
    }
    /* Centerize heading for add new items */
    #addNewItem h2 {
        text-align: center;
        color: white;
        background:	#355E3B;
        padding: 10px;
    }


    .stats-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-around;
        margin-top: 20px;
    }

    .box {
        width: 300px;
        background-color: #fff;
        padding: 20px;
        border-radius: 10px;
        margin-bottom: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

    .box img {
        width: 100px;
        border-radius: 10px;
        margin-bottom: 10px;
    }

    .name {
        font-weight: bold;
        margin-bottom: 10px;
    }

    form {
        margin-top: 10px;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    input[type="text"],
    input[type="number"] {
        width: 100%;
        padding: 8px;
        border: 1px solid #ddd;
        border-radius: 5px;
        margin-bottom: 10px;
    }

    input[type="submit"] {
        background-color: #007bff;
        color: #fff;
        border: none;
        padding: 8px 16px;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    input[type="submit"]:hover {
        background-color: #0056b3;
    }

    /* Style for select box */
    #addNewItem select {
        width: 200px;
        padding: 8px;
        border: 1px solid #ddd;
        border-radius: 5px;
        margin-bottom: 10px;
        background-color: #fff;
        font-size: 16px;
        cursor: pointer;
    }

    /* Style for select box when hovered */
    select:hover {
        border-color: #007bff;
    }

    select:focus {
        outline: none;
        box-shadow: 0 0 5px #007bff;
    }

</style>

</head>
<body>

<section id="stats">
    <div class="topScorer-title goal-title">
        <h1>Goals</h1>
    </div>
    <div class="stats-container goal">
        <?php
        // Generate player statistics for goals
        $goal_sql = "SELECT * FROM goals ORDER BY stat_value DESC";
        generatePlayerStats($goal_sql, $conn, 'goals');
        ?>
    </div>

    <div class="topScorer-title assist-title">
        <h1>Assists</h1>
    </div>
    <div class="stats-container assist">
        <?php
        // Generate player statistics for assists
        $assist_sql = "SELECT * FROM assists ORDER BY stat_value DESC";
        generatePlayerStats($assist_sql, $conn, 'assists');
        ?>
    </div>

    <div class="topScorer-title cleanSheet-title">
        <h1>Clean Sheets</h1>
    </div>
    <div class="stats-container cleanSheet">
        <?php
        // Generate player statistics for clean sheets
        $clean_sheet_sql = "SELECT * FROM clean_sheets ORDER BY stat_value DESC";
        generatePlayerStats($clean_sheet_sql, $conn, 'clean sheets');
        ?>
    </div>
</section>

<section id="addNewItem">
    <h2>Add New Item</h2>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="table_name">Table Name:</label>
        <select name="table_name" id="table_name">
            <option value="goals">Goals</option>
            <option value="assists">Assists</option>
            <option value="clean_sheets">Clean Sheets</option>
        </select><br>
        <label for="new_player_name">Player Name:</label>
        <input type="text" name="new_player_name" required><br>
        <label for="new_stat_value">Statistic Value:</label>
        <input type="number" name="new_stat_value" required><br>
        <input type="submit" name="add_new_item" value="Add">
    </form>
</section>
<a href="logout.php">lougout</a>


</body>
</html>

<?php
// Close connection
$conn->close();
?>
