<?php
include('dataconnect.php');

if(isset($_GET['DelID'])) {
    $id = $_GET['DelID'];
    $query = "DELETE FROM form WHERE id='$id'";
    $result = mysqli_query($conn, $query);

    if($result) {
        header("Location: view.php");
    } else {
        echo 'Please Check Your Query';
    }
} else {
    header("Location: view.php");
}
?>
