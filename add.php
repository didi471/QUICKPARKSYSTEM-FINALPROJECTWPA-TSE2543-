<?php
include('dataconnect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $firstname = $_POST['fname'];
    $lastname = $_POST['lname'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $password = $_POST['pass'];

    // Insert into database
    $query = "INSERT INTO form (fname, lname, gender, email, pass) VALUES ('$firstname', '$lastname', '$gender', '$email', '$password')";
    
    if (mysqli_query($conn, $query)) {
        echo "New record created successfully";
        header("Location: view.php"); // Redirect to the view page after adding
        exit();
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="VIEW1.css">
    <title>Add User</title>
</head>
<body class="bg-dark">
    <h1>Add New User</h1>
    <div class="container">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="fname">First Name:</label>
            <input type="text" name="fname" required><br>

            <label for="lname">Last Name:</label>
            <input type="text" name="lname" required><br>

            <label for="gender">Gender:</label>
            <select name="gender" required>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Other">Other</option>
            </select><br>

            <label for="email">Email:</label>
            <input type="email" name="email" required><br>

            <label for="pass">Password:</label>
            <input type="password" name="pass" required><br>

            <input type="submit" value="Add User">
        </form>
        <br>
        <a href="view.php">Back to Users</a>
    </div>
</body>
</html>