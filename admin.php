<?php
// Database connection
include ('server/db_connect.php');

session_start();

if(isset($_SESSION['admin_type'])){
    if($_SESSION['admin_type'] != 'main_admin'){
        header('Location: login.php');
        exit();
    }
} else {
    header('Location: login.php');
    exit();
}


// Function to fetch all admins
function getAllAdmins($conn) {
    $sql = "SELECT * FROM admins";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        return $result->fetch_all(MYSQLI_ASSOC);
    } else {
        return [];
    }
}

// Add new admin
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = hash('sha256', $_POST['password']);
    $role = $_POST['role'];

    $query = "SELECT * FROM admins WHERE username='$username'";
    $result = $conn->query($query);

    if($result->num_rows > 0){
        echo '<div style="color: red;">Username already exists!</div>';
    } else {

    $sql = "INSERT INTO admins (username, password, role) VALUES ('$username', '$password', '$role')";
    
    if ($conn->query($sql) === TRUE) {
        echo '<div style="color: green;">New admin added successfully!</div>';
    } else {
        echo '<div style="color: red;">Error: ' . $sql . '<br>' . $conn->error . '</div>';
    }
}
}

// Delete admin
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $query = "SELECT * FROM admins WHERE id=$id";
    $result = $conn->query($query);

    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        if($row['role'] == 'main_admin' && $row['username']== 'ari_ayar'){
            echo '<div style="color: red;">Main admin cannot be deleted!</div>';
        }
    else {

    $sql = "DELETE FROM admins WHERE id=$id";
    
    if ($conn->query($sql) === TRUE) {
        echo '<div style="color: green;">Admin deleted successfully!</div>';
    } else {
        echo '<div style="color: red;">Error: ' . $sql . '<br>' . $conn->error . '</div>';
    }
}
}
}

// Fetch all admins
$admins = getAllAdmins($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Management</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 20px;
        }
        h2 {
            color: #333;
        }
        form {
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 5px;
            padding: 20px;
            -webkit-backdrop-filter: blur(10px);
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            margin-bottom: 10px;
        }
        input[type="text"],
        input[type="password"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 15px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            background-color: #fff;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 3px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        li:hover {
            background-color: #f0f0f0;
        }
        a {
            color: #337ab7;
            text-decoration: none;
        }
        a:hover {
            /* text-decoration: underline; */
            color: #cc0509;
        }
        #logout{
            background: #337ab7;
            color: #fff;
            padding: 10px;
            text-decoration: none;
        }
        #logout:hover{
            background: #cc0509;
        }
    </style>
</head>
<body>
    <h2>Admin Management</h2>
    <!-- Add new admin form -->
    <form method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <label for="role">Role:</label>
        <select id="role" name="role">
            <option value="main_admin">Main Admin</option>
            <option value="news">News</option>
            <option value="standing">Standing</option>
            <option value="fixture">Fixture</option>
            <option value="result">Result</option>
            <option value="stats">Stats</option>
        </select>
        <input type="submit" name="submit" value="Add Admin">
    </form>

    <br>
    
    <!-- List of admins -->
    <h3>List of Admins</h3>
    <ul>
        <?php foreach ($admins as $admin): ?>
            <li>
                <?php echo $admin['username']; ?> - <?php echo $admin['role']; ?> 
                <a href="?delete=<?php echo $admin['id']; ?>">Delete</a>
            </li>
        <?php endforeach; ?>
    </ul>
    <a id="logout" href="logout.php">logout</a>

</body>
</html>

<?php
$conn->close();
?>