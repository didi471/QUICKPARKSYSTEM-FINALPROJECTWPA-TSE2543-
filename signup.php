<?php
session_start();
include("dataconnect.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $firstname = $_POST['fname'];
    $lastname = $_POST['lname'];
    $gender = $_POST['gender'];
    $email = $_POST['mail'];
    $password = $_POST['pass'];
    $role = $_POST['role'];

    if (!empty($email) && !empty($password) && !is_numeric($email)) {
        $query = "INSERT INTO form (fname, lname, gender, email, pass, role) VALUES ('$firstname', '$lastname', '$gender', '$email', '$password', '$role')";
        mysqli_query($conn, $query);
        echo "<script type='text/javascript'> alert('Your Registration is Successful')</script>";
    } else {
        echo "<script type='text/javascript'> alert('Your Registration is Unsuccessful. Please Enter Valid Information')</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login And Register</title>
    <link rel="stylesheet" type="text/css" href="signup.css">
    <style>
        
    </style>
</head>
<body>
    <br><br>
    <br>
    <br>
    <div class="main-container">
        <h1>Welcome to Quickpark</h1>
        <div class="container">
            <div class="image-container">
                <img src="https://static.vecteezy.com/system/resources/previews/036/372/442/non_2x/hospital-building-with-ambulance-emergency-car-on-cityscape-background-cartoon-illustration-vector.jpg"style="width:900px;height:620px;">
            </div>
            <div class="signup-container">
                <h2>Sign Up</h2>
                <form method="POST">
                    <label>First Name</label>
                    <input type="text" name="fname" required>
                    <label>Last Name</label>
                    <input type="text" name="lname" required>
                    <label>Gender</label>
                    <input type="text" name="gender" required>
                    <label>Email</label>
                    <input type="email" name="mail" required>
                    <label>Password</label>
                    <input type="password" name="pass" required>
                    <label>Role</label>
                    <select name="role" required>
                        <option value="user">User</option>
                        <option value="admin">Admin</option>
                    </select>
                    <br><br>
                    <input type="submit" value="Submit">
                </form>
                <br>
                <p>Already have an account? <br><a href="login.php">Login</a></p>
            </div>
        </div>
    </div>
</body>
</html>


