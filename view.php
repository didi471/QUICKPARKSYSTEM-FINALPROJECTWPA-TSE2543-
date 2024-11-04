<?php
include('dataconnect.php');
$query = "SELECT * FROM form";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" type="text/css" href="VIEW2.css">
    <title>View Records</title>

    <script type="text/javascript">
        function confirmDelete(delUrl) {
            if (confirm("Are you sure you want to delete this user?")) {
                document.location = delUrl;
            }
        }
    </script>
</head>
<body class="bg-dark">
<div class="header">
        <h1>Quickpark Users</h1>
        <nav>
            <a href="view.php">About Users</a>
            <a href="adminmenu.php">User Login</a>
            
        </nav>
    </div>
    <div class="container">
        <div class="row">
            <div class="col m-auto">
                <div class="card mt-5">
                    <table class="table table-bordered">
                        <tr>
                            <td>ID</td>
                            <td>First Name</td>
                            <td>Last Name</td>
                            <td>Gender</td>
                            <td>Email</td>
                            <td>Password</td>
                            <td>Add</td>
                            <td>Edit</td>
                            <td>Delete</td>
                        </tr>
                        <?php
                        while ($row = mysqli_fetch_assoc($result)) {
                            $id = $row['id'];
                            $firstname = $row['fname'];
                            $lastname = $row['lname'];
                            $Gender = $row['gender'];
                            $gmail = $row['email'];
                            $password = $row['pass'];
                        ?>
                            <tr>
                                <td><?php echo $id ?></td>
                                <td><?php echo $firstname ?></td>
                                <td><?php echo $lastname ?></td>
                                <td><?php echo $Gender ?></td>
                                <td><?php echo $gmail ?></td>
                                <td><?php echo $password ?></td>
                                <td><a href="add.php?GetID=<?php echo $id ?>">Add</a></td>
                                <td><a href="edit.php?GetID=<?php echo $id ?>">Edit</a></td>
                                <td><a href="javascript:confirmDelete('delete.php?DelID=<?php echo $id; ?>')">Delete</a></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </table>
                    <br>
                    <br>
                    <a style="text-align:center" href="login.php">Main Page</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
