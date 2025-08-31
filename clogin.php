<?php
session_start();
$conn = new mysqli("localhost", "root", "", "store");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['register'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        
        $stmt = $conn->prepare("INSERT INTO customer (name, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $password);
        if ($stmt->execute()) {
            echo "<script>alert('Registration Successful! Please Login.');</script>";
        } else {
            echo "<script>alert('Registration Failed!');</script>";
        }
        $stmt->close();
    }
    
    if (isset($_POST['login'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        
        $stmt = $conn->prepare("SELECT id, password FROM customer WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id, $hashed_password);
            $stmt->fetch();
            if (password_verify($password, $hashed_password)) {
                $_SESSION['customer_id'] = $id;
                echo "<script>alert('Login Successful!'); window.location.href='customerhome.php';</script>";
            } else {
                echo "<script>alert('Invalid Password!');</script>";
            }
        } else {
            echo "<script>alert('No user found!');</script>";
        }
        $stmt->close();
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Login & Registration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            position: relative;
        }
        
        body::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('login.jpg') no-repeat center center/cover;
            filter: blur(5px);
            z-index: -1;
        }
        
        .container {
            background: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
            text-align: center;
            width: 320px;
        }
        input {
            width: 90%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            width: 100%;
            padding: 12px;
            background: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background 0.3s ease;
        }
        button:hover {
            background: #0056b3;
        }
        .toggle-buttons {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }
        .toggle-buttons button {
            width: 48%;
        }
        .admin-login {
            background: #28a745;
        }
        .admin-login:hover {
            background: #218838;
        }
    </style>
    <script>
        function toggleForm(form) {
            document.getElementById("loginForm").style.display = form === 'login' ? 'block' : 'none';
            document.getElementById("registerForm").style.display = form === 'register' ? 'block' : 'none';
        }
    </script>
</head>
<body>
    <div class="container">
        <h2>Customer Login & Registration</h2>
        <div class="toggle-buttons">
            <button onclick="toggleForm('login')">Login</button>
            <button onclick="toggleForm('register')">Register</button>
        </div>
        
        <div id="loginForm" style="display:block;">
            <h3>Login</h3>
            <form method="POST">
                <input type="email" name="email" placeholder="Email" required><br>
                <input type="password" name="password" placeholder="Password" required><br>
                <button type="submit" name="login">Login</button>
            </form>
        </div>
        
        <div id="registerForm" style="display:none;">
            <h3>Register</h3>
            <form method="POST">
                <input type="text" name="name" placeholder="Full Name" required><br>
                <input type="email" name="email" placeholder="Email" required><br>
                <input type="password" name="password" placeholder="Password" required><br>
                <button type="submit" name="register">Register</button>
            </form>
        </div>
        
        <button class="admin-login" onclick="window.location.href='login.php'">Admin Login</button>
    </div>
</body>
</html>
