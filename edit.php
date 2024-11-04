<?php
include('dataconnect.php');
$id = $_GET['GetID'];
$query = "SELECT * FROM form WHERE id='" . $id . "'";
$result = mysqli_query($conn, $query);
while ($row = mysqli_fetch_assoc($result)) {
    $id = $row['id'];
    $firstname = $row['fname'];
    $lastname = $row['lname'];
    $Gender = $row['gender'];
    $gmail = $row['email'];
    $password = $row['pass'];
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Edit Record</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #9e2576;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            max-width: 700px;
            background: pink;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-top: 10px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="email"],
        input[type="password"] {
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            margin-top: 20px;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: violet;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <form action="update.php?id=<?php echo $id ?>" method="POST">
            <label>First Name</label>
            <input type="text" name="fname" value="<?php echo $firstname; ?>" required>
            <label>Last Name</label>
            <input type="text" name="lname" value="<?php echo $lastname; ?>" required>
            <label>Gender</label>
            <input type="text" name="gender" value="<?php echo $Gender; ?>" required>
            <label>Email</label>
            <input type="email" name="mail" value="<?php echo $gmail; ?>" required>
            <label>Password</label>
            <input type="password" name="pass" value="<?php echo $password; ?>" required>
            <input type="submit" name="update" value="Update">
        </form>
    </div>
</body>
</html>
