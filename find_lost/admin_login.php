<?php
session_start();
include 'db.php'; // Database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query to fetch admin user by username and password
    $stmt = $conn->prepare("SELECT * FROM admin_users WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['admin'] = $username;
        header("Location: admin_panel.php");  // Redirect to admin panel
        exit();
    } else {
        echo "Invalid username or password!";
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
        /* Resetting default margins and paddings */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Full-page styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; /* Full viewport height */
            color: #333;
        }

        /* Main container styling */
        .login-container {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            width: 300px; /* Fixed width for the login form */
        }

        /* Header styling */
        h2 {
            text-align: center;
            color: #2a5298;
            margin-bottom: 20px;
        }

        /* Form element styling */
        label {
            margin-bottom: 5px;
            display: block;
            color: #555;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%; /* Full width */
            padding: 10px;
            margin-bottom: 20px; /* Space between inputs */
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #2a5298;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s; /* Smooth transition */
        }

        button:hover {
            background-color: #1e3a78; /* Darker shade on hover */
        }

        /* Responsive adjustments */
        @media (max-width: 400px) {
            .login-container {
                width: 90%; /* Adjust width for small screens */
            }

            h2 {
                font-size: 24px; /* Slightly smaller font */
            }

            input[type="text"],
            input[type="password"],
            button {
                font-size: 14px; /* Smaller font size for inputs and buttons */
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Admin Login</h2>
        <form method="POST" action="admin_login.php">
            <label for="username">Username:</label>
            <input type="text" name="username" required><br>

            <label for="password">Password:</label>
            <input type="password" name="password" required><br>

            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
