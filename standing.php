<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/standing.css">
    <?php
        include('server/db_connect.php'); // for connecting to database server
    ?>
</head>
<body>

    <section id="standing">

        <div class="standing-title">
            <h1>Standing</h1>
        </div>

        <div class="standing-table">
            <table >
                <tr> <!-- First Row to header -->
                    <th>Position</th>
                    <th>Club</th>
                    <th>Played</th>
                    <th class="make-for-screen-size">Won</th>
                    <th class="make-for-screen-size">Draw</th>
                    <th class="make-for-screen-size">Lost</th>
                    <th class="make-for-screen-size">+/-</th>
                    <th class="make-for-screen-size">Goal Difference</th>
                    <th>Points</th>
                </tr>



                
                <?php
                    // Output standing data rows dynamically
                    $sql = "SELECT * FROM standings ORDER BY points desc, goal_difference DESC"; // order by points and then by goal_difference

                    $result = $conn->query($sql);
                    if ($result-> num_rows<=20) { // or we can write (==20), because abet exactly 20 club habn
                        $position = 1; // ama bo position'a, ka ba pey row'y table'aka dai anet 
                        
                        while ($row = $result->fetch_assoc()) {
                            
                            // $position = $row['positions']; // lay adain bo awai xoi lagall row'akan rrizbandi zyad bkat, agar ama habet zorjar la postion'y jegai yakam nusrawa 3 yan 2 w HTD....
                            $club_logo = $row['club_logo'];
                            $club_name = $row['club_name'];
                            // $played = $row['played']; // bo awai pewsist nakat daim amaish update bkain aikain ba kokrdnawai anjamakan bashtra
                            $played = $row['won'] + $row['draw'] + $row['lost']; // won w draw w lost la dwatrawa nasenrawn boya lera ba $row wary agrin
                            $won = $row['won'];
                            $draw = $row['draw'];
                            $lost = $row['lost'];
                            $plus_minus = $row['plus_minus'];
                            // $goal_difference = $row['goal_difference']; // change to make calculation 
                            $goals = explode('-', $plus_minus);
                                // Convert the string components to integers
                            $goals_scored = intval($goals[0]);
                            $goals_conceded = intval($goals[1]);
                                // Calculate the plus_minus
                            $goal_difference = $goals_scored - $goals_conceded;
                            if ($goal_difference > 0) {
                                    $goal_difference = '+' . $goal_difference;
                            }
                            // $points = $row['points'];
                            $points = ($won * 3) + $draw; // calculate points directly from the results of won's and draws 
                            //$played = $won + $draw + $lost; // atwanin bam shewa bikain la xwaraawi awai won w draw w shtman nasand, yanish akre waku awai sarawa bikain
                            if ($club_name == 'Everton') {
                                $points -= 8; // Decrease points of Everton club by 5, because of Punishment
                            }
                            if ($club_name == 'Nottingham') {
                                $points -= 4; // Decrease points of Bournemouth club by 5, because of Punishment
                            }
                            
                            
                            // Update the database with the calculated values
                            $update_sql = "UPDATE standings SET played = '$played', goal_difference = '$goal_difference', points = '$points' WHERE club_name = '$club_name'";
                            $conn->query($update_sql);


                            echo <<<HTML
                            <tr> <!-- Another rows (should be 20 rows for all clubs) -->
                                <td>{$position}</td>
                                <td>
                                    <img src={$club_logo} alt="">
                                    <p>{$club_name}</p>
                                </td>
                                <td>{$played}</td>
                                <td class="make-for-screen-size">{$won}</td>
                                <td class="make-for-screen-size">{$draw}</td>
                                <td class="make-for-screen-size">{$lost}</td>
                                <td class="make-for-screen-size">{$plus_minus}</td>
                                <td class="make-for-screen-size">{$goal_difference}</td>
                                <td>{$points}</td>
                            </tr>
                            HTML;
                            $position++;
                        } // end of while loop
                    } // end of if condition
                    else { // agar 20 row zyatrman habu, awa yak row bxara zyad bka waku awai ta bzanin hallayak haya
                        echo "<tr><td colspan='9'>No data available</td></tr>";
                    }
                ?>

            </table>

            <div class="explain">
                <div class="blue"></div> <span>Qualificate to Champions League</span>
                <div class="orange"></div> <span>Qualificate to Europa League</span>
                <div class="green"></div> <span>Qualificate to Conference League</span>
                <div class="red"></div> <span>Relegation</span>
            </div>

        </div>

    </section>

</body>
</html>