<?php
include('dataconnect.php');

if (isset($_POST['update'])) {
    $id = $_GET['id'];
    $firstname = $_POST['fname'];
    $lastname = $_POST['lname'];
    $Gender = $_POST['gender'];
    $gmail = $_POST['mail'];
    $password = $_POST['pass'];

    $query = "UPDATE form SET fname='$firstname', lname='$lastname', gender='$Gender', email='$gmail', pass='$password' WHERE id='$id'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        header("Location: view.php");
    } else {
        echo 'Please Check Your Query';
    }
} else {
    header("Location: view.php");
}
?>
