<!DOCTYPE html>
<html>
<head>
    <title>Signup</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .signup-container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            box-sizing: border-box;
        }

        .signup-container h2 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }

        .signup-container input[type="text"],
        .signup-container input[type="password"] {
            width: 100%;
            padding: 15px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
        }

        .signup-container input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
            margin-top: 10px;
        }

        .signup-container input[type="submit"]:hover {
            background-color: #45a049;
        }

        .signup-container .login-link {
            margin-top: 20px;
            font-size: 14px;
            color: #777;
            text-align: center;
        }

        .signup-container .login-link a {
            color: #4CAF50;
            text-decoration: none;
        }

        .signup-container .login-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div class="signup-container">
    <h2>Signup</h2>
    <form action="signup_process.php" method="post">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="hidden" name="role" value="user"> 
        <input type="submit" value="Signup">
    </form>
    <div class="login-link">
        <p>Already have an account? <a href="login.php">Login</a></p>
    </div>
</div>
</body>
</html>
