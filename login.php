<!-- login.php -->
<?php
    include('server/db_connect.php');

    session_start();

    if(isset($_SESSION['admin_type'])){
        if($_SESSION['admin_type'] == 'admin'){
            header('Location: createAdmin.php');
        }
        elseif($_SESSION['admin_type'] == 'news') {
            header('Location: newsDash.php');
        } elseif($_SESSION['admin_type'] == 'standing') {
            header('Location: standingDash.php');
        } elseif($_SESSION['admin_type'] == 'fixture') {
            header('Location: fixtureDash.php');
        } elseif($_SESSION['admin_type'] == 'result') {
            header('Location: resultsDash.php');
        } elseif($_SESSION['admin_type'] == 'stats') {
            header('Location: statsDash.php');
        }
    }

    if(isset($_POST['login'])){
        $username = mysqli_escape_string($conn, $_POST['username']) ;
        $password = mysqli_escape_string($conn, hash('sha256', $_POST['password']));

        $sql = "SELECT * FROM `admins` WHERE username='$username' AND password='$password'";
        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_assoc($result);
            $_SESSION['admin_type'] = $row['role'];
            if($_SESSION['admin_type'] == 'main_admin'){
                header('Location: admin.php');
            }
            elseif($_SESSION['admin_type'] == 'news') {
                header('Location: newsDash.php');
            } elseif($_SESSION['admin_type'] == 'standing') {
                header('Location: standingDash.php');
            } elseif($_SESSION['admin_type'] == 'fixture') {
                header('Location: fixtureDash.php');
            } elseif($_SESSION['admin_type'] == 'result') {
                header('Location: resultsDash.php');
            } elseif($_SESSION['admin_type'] == 'stats') {
                header('Location: statsDash.php');
            } else {
                $error_message = "Invalid username or password.";
            }
            
        }else{
            $error_message = "Invalid username or password.";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <style>

body {
            font-family: Arial, sans-serif;
            background-image: url('image/bgg.webp'); /* Replace 'your-image.jpg' with the path to your image */
            /* write pink blend mode overlay */
            background-color: rgba(25, 25, 25, 0.8); /* Adding transparency to the background color */
            background-blend-mode: overlay;
            background-size: cover;
            background-position: center;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-container {
            /* background-color: rgba(250, 254, 252, 0.9);  */
            padding: 20px;
            border-radius: 18px;
            /* box-shadow: 0 2px 4px rgba(43, 32, 150, 0.7); */
            width: 350px;
            text-align: center;

            background-color: rgba(255, 255 255, 0.7);
            border-radius: 5px;
            padding: 20px;
            -webkit-backdrop-filter: blur(10px);
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 5px rgba(20, 150, 215, 0.9);
        }

        .login-container h2 {
            margin-bottom: 20px;
            color: #ccc;
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
        }

        .login-container input[type="text"],
        .login-container input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            background: rgba(220, 220, 220, 0.6);
        }

        .login-container button {
            width: 100%;
            padding: 10px;
            background-color: #0056b3;
            color: #fff;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .login-container button:hover {
            background-color: #22aa33;
        }
        
    </style>
</head>
<body>
<div class="login-container">

    <h2>Admin Login</h2>
    <form action="login.php" method="post">
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit" name="login">Login</button>
    </form>
    <?php if (!empty($error_message)) { ?>
        <p class="error"><?php echo $error_message; ?></p>
    <?php } ?>

    
</div>
</body>
</html>
