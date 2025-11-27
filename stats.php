<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/stats.css">
</head>
<body>
<section id="stats">

<?php
// database connection
include('server/db_connect.php');


function generatePlayerStats($titleContainer,$title, $boxContainer, $sql, $conn) {
    echo "<div class='topScorer-title $titleContainer'>
            <h1>$title</h1>
        </div>
    <div class='stats-container $boxContainer'>";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $rank = 1;
        while ($row = $result->fetch_assoc()) {
            $player_name = $row['player_name'];
            $stat_value = $row['stat_value'];
            $image_source = "./image/players/" . strtolower(str_replace(' ', '_', $player_name)) . ".png";

            echo "<div class='box'>
                    <img src='$image_source' alt='$player_name'>
                    <div class='name'><span>$rank.&nbsp;</span>$player_name<br>$stat_value $title</div>
                </div>";
            $rank++;
        }
    } else {
        echo "0 results";
    }

    echo "</div>";
}

// goals
$goal_container_title = "goal-title";
$goal_title = "Goals";
$goal_box = "goal";
$goal_sql = "SELECT * FROM goals ORDER BY stat_value DESC limit 10";
generatePlayerStats($goal_container_title,$goal_title, $goal_box, $goal_sql, $conn);

// assists
$assist_container_title = "assist-title";
$assist_title = "Assists";
$assist_box = "assist";
$assist_sql = "SELECT * FROM assists ORDER BY stat_value DESC limit 10";
generatePlayerStats($assist_container_title, $assist_title, $assist_box, $assist_sql, $conn);

//clean sheets
$clean_sheet_title = "Clean Sheets";
$clean_sheet_container_title = "cleanSheet-title";
$cleanSheet_box = "cleanSheet";
$clean_sheet_sql = "SELECT * FROM clean_sheets ORDER BY stat_value DESC limit 10";
generatePlayerStats($clean_sheet_container_title,$clean_sheet_title, $cleanSheet_box, $clean_sheet_sql, $conn);

// Close connection
$conn->close();
?>

</section>
</body>
</html>