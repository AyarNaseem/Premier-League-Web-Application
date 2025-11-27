<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All News</title>
    <link rel="stylesheet" href="css/all_news.css">
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
                <img id="head-img" src='$latest_image' alt="">
                <div class="header-item-content">
                    <h1 id="head-title">$latest_title</h1>
                    <p>$latest_desc</p>
                </div>
            </div>
        </div>
    HTML;
        ?>

        <div class="items-container">
            <?php
            $sql = "SELECT * FROM news ORDER BY id DESC";
            $result = $conn->query($sql);

            while ($row = mysqli_fetch_assoc($result)) {
                $title = $row['title'];
                $desc = $row['description'];
                $image = $row['image'];

                echo <<<HTML
                    <div class="item">
                        <div class="item-img">
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
        </div>
    </div>
</section>

<script>
    
    function swapNews(imgSrc, title, desc) {
    document.getElementById('head-img').src = imgSrc;
    document.getElementById('head-title').textContent = title;
    document.querySelector('.header-item p').textContent = desc;
}
</script>
</body>
</html>
