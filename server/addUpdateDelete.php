<?php
// include('db_connect.php');
// // Function to retrieve all news items from the database
// function getAllNews(){
//     global $conn;
//     $sql = "SELECT * FROM news";
//     $result = mysqli_query($conn, $sql);
//     return $result;
// }

// // Function to add a new news item to the database
// function addNews($title, $description, $image) {
//     global $conn;
//     $sql = "INSERT INTO news (title, description, image) VALUES ('$title', '$description', '$image')";
//     return mysqli_query($conn, $sql);
// }

// // Function to update a news item in the database
// function updateNews($id, $title, $description, $image) {
//     global $conn;
//     if($title != '' && $description != '' && $image != '') {
//     $sql = "UPDATE news SET title='$title', description='$description', image='$image' WHERE id=$id";
//     } else if($title != '' && $description != '') {
//         $sql = "UPDATE news SET title='$title', description='$description' WHERE id=$id";
//     } else if($title != '' && $image != '') {
//         $sql = "UPDATE news SET title='$title', image='$image' WHERE id=$id";
//     } else if($description != '' && $image != '') {
//         $sql = "UPDATE news SET description='$description', image='$image' WHERE id=$id";
//     }
//     else if($title != '') {
//         $sql = "UPDATE news SET title='$title' WHERE id=$id";
//     }
//     else if($description != '') {
//         $sql = "UPDATE news SET description='$description' WHERE id=$id";
//     } else{
//         $sql = "UPDATE news SET image='$image' WHERE id=$id";
//     }
//     return mysqli_query($conn, $sql);
// }

// // Function to delete a news item from the database
// function deleteNews($id) {
//     global $conn;
//     $sql = "DELETE FROM news WHERE id=$id";
//     return mysqli_query($conn, $sql);
// }

// // Check if form for adding news item is submitted
// if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_news'])) {
//     $title = $_POST['title'];
//     $description = $_POST['description'];
//     $image = $_POST['image'];
//     addNews($title, $description, $image);
// }

// // Check if form for updating news item is submitted
// if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_news'])) {
//     $id = $_POST['id'];
//     $title = $_POST['title'];
//     $description = $_POST['description'];
//     $image = $_POST['image'];
//     updateNews($id, $title, $description, $image);
// }

// // Check if news item deletion is requested
// if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['delete_news'])) {
//     $id = $_GET['id'];
//     deleteNews($id);
// }
?>

<?php
include('db_connect.php');

// Function to retrieve all news items from the database
function getAllNews(){
    global $conn;
    $sql = "SELECT * FROM news";
    $result = mysqli_query($conn, $sql);
    return $result;
}

// Function to add a new news item to the database
function addNews($title, $description, $image) {
    global $conn;

    // Escape special characters in inputs to prevent SQL injection
    $title = mysqli_real_escape_string($conn, $title);
    $description = mysqli_real_escape_string($conn, $description);
    // $image = mysqli_real_escape_string($conn, $image);
    $image = "./image/news/" . mysqli_real_escape_string($conn, $image);
    $sql = "INSERT INTO news (title, description, image) VALUES ('$title', '$description', '$image')";
    return mysqli_query($conn, $sql);
}

// Function to update a news item in the database
function updateNews($id, $title, $description, $image) {
    global $conn;

    // Escape special characters in inputs to prevent SQL injection
    $id = mysqli_real_escape_string($conn, $id);
    $title = mysqli_real_escape_string($conn, $title);
    $description = mysqli_real_escape_string($conn, $description);
    // $image = mysqli_real_escape_string($conn, $image);
    // $image = "./image/news/" . mysqli_real_escape_string($conn, $image);


    $updates = array();
    if (!empty($title)) {
        $updates[] = "title='$title'";
    }
    if (!empty($description)) {
        $updates[] = "description='$description'";
    }
    if (!empty($image)) {
        $image = "./image/news/" . mysqli_real_escape_string($conn, $image);
        $updates[] = "image='$image'";
    }

    if (!empty($updates)) {
        $updateString = implode(", ", $updates);
        $sql = "UPDATE news SET $updateString WHERE id='$id'";
        return mysqli_query($conn, $sql);
    } else {
        return false; // No updates provided
    }
}

// Function to delete a news item from the database
function deleteNews($id) {
    global $conn;
    $id = mysqli_real_escape_string($conn, $id);
    $sql = "DELETE FROM news WHERE id='$id'";
    return mysqli_query($conn, $sql);
}

// Check if form for adding news item is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_news'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $image = $_POST['image'];
    addNews($title, $description, $image);
}

// Check if form for updating news item is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_news'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $image = $_POST['image'];
    updateNews($id, $title, $description, $image);
}

// Check if news item deletion is requested
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['delete_news'])) {
    $id = $_GET['id'];
    deleteNews($id);
}
?>
