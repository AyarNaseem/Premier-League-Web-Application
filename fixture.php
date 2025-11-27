<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>fixture</title>
    <link rel="stylesheet" href="css/fixture.css">




<?php
    include ('server/db_connect.php');
?>
</head>
<body>


<section id="fixture">

    <div class="fixture-title">
        <h1>Fixture</h1>
    </div>

    <div class="card-container">

        <?php
        // Query to fetch fixture data
        $sql = "SELECT * FROM fixtures order by match_date, match_time ";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                $home_team = $row["home_team"];
                $away_team = $row["away_team"];
                // $match_time = $row["match_time"];
                // $match_time = date("H:i", strtotime($row["match_time"]))." PM"; // Format time as "HH:MM"
                $match_time = date("g:i", strtotime($row["match_time"]))." PM"; // Format time as 12 hours (am and pm) 
                // $match_date = $row["match_date"];
                $match_date = date("d M", strtotime($row["match_date"])); // Format date as "DD MON"
                $home_image = "./image/teamsLogo/" . strtolower(str_replace(' ', '', $home_team)) . ".png";
                $away_image = "./image/teamsLogo/" . strtolower(str_replace(' ', '', $away_team)) . ".png";

                echo <<<HTML
                <div class="card">
                    <div class="left-team">
                        <p>$home_team</p>
                        <img src="$home_image" alt="">
                    </div>
                    <div class="middle-content">
                        <p>$match_time</p>
                        <p class="middle-content-date">$match_date</p>
                    </div>
                    <div class="right-team">
                        <p>$away_team</p>
                        <img src="$away_image" alt="">
                    </div>
                </div>
                HTML;
            }
        } else {
            echo "0 results";
        }
        ?>

    </div>
</section>


</body>
</html>