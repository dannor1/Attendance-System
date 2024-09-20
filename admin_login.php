<!-- admin_login.php -->

<?php
session_start();

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Hardcoded admin login credentials (this can be enhanced later)
    if ($username === 'admin' && $password === 'password123') {
        $_SESSION['admin'] = true;
        header('Location: manage_employees.php');
        exit();
    } else {
        echo "<script>alert('Invalid credentials!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        body {
            background-image: url('img/building.jpg');
            background-size: cover;
            background-position: center;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-container {
            background: rgba(255, 255, 255, 0.8);
            border-radius: 15px;
            padding: 30px;
            width: 400px; /* Make the login box broader */
            text-align: center;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
        }

        .logo {
            width: 100px; /* Adjust logo size */
            height: 100px;
            border-radius: 50%; /* Make logo circular */
            object-fit: cover; /* Ensure the image covers the area */
            margin-bottom: 20px;
        }

        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        .remember-me {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin: 10px 0;
        }

        .remember-me input {
            width: auto;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <img src="img/logo.jpg" alt="Hospital Logo" class="logo">
        <h2>New Abirem Government Hospital</h2>
        <p>Attendance Tracking System</p>
        <form method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <div class="remember-me">
                <label>
                    <input type="checkbox" name="remember"> Remember Me
                </label>
            </div>
            <button type="submit" name="login">Login</button>
        </form>
    </div>
</body>
</html>
