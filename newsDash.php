<?php
include('server/db_connect.php');
include('server/addUpdateDelete.php');

session_start();

if(isset($_SESSION['admin_type'])){
    if($_SESSION['admin_type'] != 'news'){
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
    <title>News Dashboard</title>
    <link rel="stylesheet" href="css/dashboard.css">

</head>


<body>

    <h1>News Dashboard</h1>

    <!-- Display all news items in a table -->
    <table>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Description</th>
            <th>Image</th>
            <th>Action</th>
        </tr>
        <?php
        $newsItems = getAllNews();
        // while ($row = mysqli_fetch_assoc($newsItems)) {
        //     echo "<tr>";
        //     echo "<td>{$row['id']}</td>"; // Display ID column
        //     echo "<td>{$row['title']}</td>";
        //     echo "<td>{$row['description']}</td>";
        //     echo "<td><img src='{$row['image']}' alt='{$row['title']}' style='max-width: 100px;'></td>";
        //     echo "<td><a href='dashboard.php?delete_news&id={$row['id']}' style='color:red;'>Delete</a></td>";
        //     echo "</tr>";
        // }
        while ($row = mysqli_fetch_assoc($newsItems)) {
            echo <<<HTML
                <tr>
                    <td>{$row['id']}</td>
                    <td>{$row['title']}</td>
                    <td>{$row['description']}</td>
                    <td><img src='{$row['image']}' alt='{$row['title']}' style='max-width: 100px;'></td>
                    <td><a href='newsDash.php?delete_news&id={$row['id']}' style='color:red;'>Delete</a></td>
                </tr>
            HTML;
        }
        
        ?>
    </table>

    <!-- Form for adding news item -->
    <div class="form-container">
        <!-- Form for adding news item -->
        <h2>Add News</h2>
        <form id="addForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title">

            <label for="description">Description:</label>
            <textarea id="description" name="description"></textarea>

            <label for="image">Image URL:</label>
            <input type="file" id="image" name="image">
            

            <input type="submit" name="add_news" value="Add News">
        </form>

        <!-- Form for updating news item -->
        <h2>Update News</h2>
        <form id="updateForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="id">News ID:</label>
            <input type="text" id="updateId" name="id">

            <label for="updateTitle">Title:</label>
            <input type="text" id="updateTitle" name="title">

            <label for="updateDescription">Description:</label>
            <textarea id="updateDescription" name="description"></textarea>

            <label for="updateImage">Image URL:</label>
            <input type="file" id="updateImage" name="image">

            <input type="submit" name="update_news" value="Update News">

        </form>
    </div>
    

    <!-- Action buttons for refreshing the page -->
    <!-- <div class="action-buttons">
        <button onclick="window.location.href='<?php echo $_SERVER["PHP_SELF"]; ?>'">Refresh</button>
    </div> -->
    <a href="logout.php">logout</a>
    
</body>
</html>

<?php
mysqli_close($conn);
?>
