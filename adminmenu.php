<?php
session_start();
include("dataconnect.php");

// Check if the user is logged in and is an admin
if (!isset($_SESSION['user_data']) || $_SESSION['user_data']['role'] != 'admin') {
    header("Location: login.php");
    die;
}

// Fetch login logs
$query = "SELECT * FROM login_log INNER JOIN form ON login_log.user_id = form.id ORDER BY login_time DESC";
$result = mysqli_query($conn, $query);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Login Logs</title>
    <style>
        body {
            background-color: #9e2576;
            color: black;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .header {
            background-color: #fa50ad;
            color: white;
            padding: 10px 0;
            text-align: center;
        }
        .header a {
            color: white;
            margin: 0 15px;
            text-decoration: none;
        }
        .header a.submit {
            background-color: #333;
            padding: 5px 10px;
            border-radius: 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: pink;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: black;
            color:whitesmoke;
        }
        h1{
            text-align:center;
        }
        .button-link {
            display: inline-block;
            text-align: center;
            margin: 20px auto;
            padding: 10px 20px;
            background-color: #007BFF;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-family: Arial, sans-serif;
        }

        .button-link:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<div class="header">
        <h1>Quickpark Users</h1>
        <nav>
            <a href="view.php">About Users</a>
            <a href="adminmenu.php">User Login</a>
        </nav>
    </div>
    <h1>Login Activities</h1>
    <table>
        <tr>
            <th>User ID</th>
            <th>Email</th>
            <th>Login Time</th>
        </tr>
        <?php
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>{$row['user_id']}</td>
                    <td>{$row['email']}</td>
                    <td>{$row['login_time']}</td>
                  </tr>";
        }
        ?>
    </table>
    <a class="button-link" href="login.php">Main Page</a>

</body>
</html>
<?php
$conn->close();
?>
