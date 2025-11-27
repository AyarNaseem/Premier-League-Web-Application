<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/news.css">
    <link rel="stylesheet" href="css/index.css">
</head>
<body>

<section id="news">
        <div class="container">


            <?php
            include('server/db_connect.php');
                // Fetch the latest news item
                $latest_news_sql = "SELECT * FROM news ORDER BY id DESC LIMIT 1";
                $latest_news_result = $conn->query($latest_news_sql);
                $latest_news_row = mysqli_fetch_assoc($latest_news_result);

                // Display the latest news item in the header
                $latest_title = $latest_news_row['title'];
                $latest_desc = $latest_news_row['description'];
                $latest_image = $latest_news_row['image'];


                echo <<<HTML
                    <div class="header-item">
                        <div class="header-item-img">
                            <!-- <img src='$latest_image' id="ronaldoo" alt=""> -->
                            <img src='$latest_image' id="head-img" alt="">
                            <div class="header-item-content">
                                <!-- <h1 id="ronaldoTitle">$latest_title</h1> -->
                                <h1 id="head-title">$latest_title</h1>
                                <p>$latest_desc</p>
                            </div>
                        </div>
                    </div>
                HTML;
            ?>



            <div class="items-container">
                <?php                
                    
                    $last_news_id = $latest_news_row['id'];

                    $sql = "SELECT * FROM (
                        (SELECT * FROM news WHERE id < $last_news_id ORDER BY id DESC LIMIT 4)
                        UNION ALL
                        (SELECT * FROM news WHERE id = $last_news_id)
                    ) AS combined_news
                    ORDER BY id ";
            
                    $result = $conn->query($sql);
                    $rows = mysqli_num_rows($result);

                    for ($i = $rows -1 ; $i >= 0; $i--) {
                        mysqli_data_seek($result, $i);
                        $row = mysqli_fetch_assoc($result);
                
                        $title = $row['title'];
                        $desc = $row['description'];
                        $image = $row['image'];
                        

                        echo <<<HTML
                            <div class="item">
                                <div class="item-img" id="item-imgs">
                                    <img src='$image' alt="">
                                    <div class="item-content">
                                        <h2>$title</h2>
                                        <input type="button" value="Read More" onclick="swapNews('$image', '$title', '$desc')">
                                    </div>
                                </div>
                            </div>
                        HTML;
                    }
                    ?>

                    <?php
                    echo <<< HTML
                    <div class="item last">
                        <div class="item-img" id="item-imgs">
                            <img src="image/see-more.jpg" alt="">
                            <div class="item-content">
                                <input type="button" value="See More" onclick="window.open('all_news.php', '_blank')">
                            </div>
                        </div>
                    </div>
                    HTML;
                    ?>
            </div>





            <div class="scroll-indicator left" onclick="scrollToLeft()">
                <span class="arrow-left"></span>
            </div>
            <div class="scroll-indicator right" onclick="scrollToRight()">
                <span class="arrow-right"></span>
            </div>   
        </div>
    </section>
    
    


<script src="index.js"></script>
</body>
</html>