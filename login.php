<?php
session_start();
include("dataconnect.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $email = $_POST['mail'];
    $password = $_POST['pass'];

    if (!empty($email) && !empty($password) && !is_numeric($email)) {
        $query = "SELECT * FROM form WHERE email = '$email' LIMIT 1";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $user_data = mysqli_fetch_assoc($result);

            if ($user_data['pass'] == $password) {
                // Update the last login time
                $update_query = "UPDATE form SET last_login = NOW() WHERE email = '$email'";
                mysqli_query($conn, $update_query);

                // Log the login activity
                $log_query = "INSERT INTO login_log (user_id, login_time) VALUES ('".$user_data['id']."', NOW())";
                mysqli_query($conn, $log_query);

                // Store user data in session
                $_SESSION['user_data'] = $user_data;

                // Redirect based on role
                if ($user_data['role'] == 'admin') {
                    header("Location: admindash.html");
                } else {
                    header("Location: dashboard.html");
                }
                die;
            }
        }
        echo "<script type='text/javascript'> alert('Wrong Email or Password')</script>";
    } else {
        echo "<script type='text/javascript'> alert('Wrong Email or Password')</script>";
    }
}
$conn->close();
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login And Register</title>
    <link rel="stylesheet" href="LOGIN.css">
</head>
<body>
<div class="main-container">
        <h1>Welcome to Quickpark</h1>
        <div class="container">
            <div class="image-container">
                <img src="https://static.vecteezy.com/system/resources/previews/036/372/442/non_2x/hospital-building-with-ambulance-emergency-car-on-cityscape-background-cartoon-illustration-vector.jpg"style="width:900px;height:500px;">
            </div>
    <div class="login-container">
        <h2>Login</h2>
        <form method="POST">
            <label>Email</label>
            <input type="email" name="mail" required>
            <br>
            <label>Password</label>
            <input type="password" name="pass" required>
            <br><br>
            <input type="submit" value="Submit">
        </form>
        <br><br>
        <p>New User? <br><br><a href="signup.php">Sign Up</a></p>
    </div>
</body>
</html>
