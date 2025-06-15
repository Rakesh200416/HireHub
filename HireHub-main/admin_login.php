<?php
session_start();

// Hardcoded admin credentials
$admin_username = "admin";
$admin_password = "admin123";

// Handle login form submission
if (isset($_POST['login'])) {
    $input_username = $_POST['username'];
    $input_password = $_POST['password'];

    // Check if entered credentials match the hardcoded credentials
    if ($input_username === $admin_username && $input_password === $admin_password) {
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_username'] = $admin_username;
        header("Location: dashboard.php". $_SERVER['PHP_SELF']); // Redirect to the same page (dashboard)
        exit;
    } else {
        $error_message = "Invalid username or password!";
    }
}

// Handle logout
if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header("Location: " . $_SERVER['PHP_SELF']); // Redirect to the same page (login)
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login and Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            background-image: url('https://thumbs.dreamstime.com/b/woman-use-laptop-to-manage-recruitment-employers-virtual-interface-human-resources-management-employment-headhunting-335439836.jpg');
            margin: 0;
            padding: 20px;
        }

        .container {
            width: 100%;
            max-width: 400px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
        }

        form {
            margin-top: 20px;
        }

        label {
            font-size: 16px;
            color: #333;
        }

        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 12px;
            margin: 8px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #007BFF;
            color: white;
            border: none;
            padding: 14px 20px;
            margin-top: 10px;
            cursor: pointer;
            border-radius: 4px;
            width: 100%;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .error-message {
            color: red;
            text-align: center;
        }

        .dashboard {
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        a {
            color: #007BFF;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="container">
    <?php
    // If admin is logged in, show the dashboard
    if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
        echo "<div class='dashboard'>";
        echo "<h2>Welcome, Admin " . $_SESSION['admin_username'] . "!</h2>";
        echo "<p>You are logged in. Here is your admin dashboard.</p>";
        echo '<a href="?logout=true">Logout</a>';
        echo "</div>";
    } else {
        // If admin is not logged in, show the login form
        if (isset($error_message)) {
            echo "<p class='error-message'>$error_message</p>";
        }
        ?>
        <h2>Admin Login</h2>
        <form method="POST">
            <label for="username">Username:</label><br>
            <input type="text" id="username" name="username" required><br><br>

            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password" required><br><br>

            <input type="submit" name="login" value="Login">
        </form>
    <?php
    }
    ?>
</div>

</body>
</html>



