<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Match Results</title>
    <link rel="stylesheet" href="css/result.css">


<?php
// Connect to the database
include('server/db_connect.php');
?>
</head>
<body>

<section id="result">
    <div class="result-title">
        <h1>Results</h1>
    </div>
    
    <div class="result-table">

        <table>

            <?php

            // Fetch match result data from the database
            $sql = "SELECT * FROM results";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    $home_scorers = explode(';', $row['home_scorers']);
                    $away_scorers = explode(';', $row['away_scorers']);
                    $home_team = $row['home_team'];
                    $away_team = $row['away_team'];
                    $home_goals = $row['home_goals'];
                    $away_goals = $row['away_goals'];

                    $home_image = "./image/teamsLogo/" . strtolower(str_replace(' ', '', $home_team)) . ".png";
                    $away_image = "./image/teamsLogo/" . strtolower(str_replace(' ', '', $away_team)) . ".png";

                    echo <<<HTML
                    <tr>
                        <td>
                            <img src="$home_image" alt="">
                            <p>{$home_team}</p>
                    HTML;
                    foreach ($home_scorers as $scorer) {
                        echo "<p class='scorers'>$scorer</p>";
                    }
                    // echo"</td>";

                    echo <<<HTML
                    </td>

                        <td class="middle">
                            <p>{$home_goals} - {$away_goals}</p> 
                        </td>

                        <td>
                            <img src="$away_image" alt="">
                            <p>{$away_team}</p>
                    HTML;
                    foreach ($away_scorers as $scorer) {
                        echo "<p class='scorers'>$scorer</p>";
                    }
                    echo <<<HTML
                        </td>
                    </tr>
                    HTML;
                }
            } else {
                echo "<tr><td colspan='3'>0 results</td></tr>";
            }

            $conn->close();
            ?>
        </table>
    </div>  
</section>

</body>
</html>
