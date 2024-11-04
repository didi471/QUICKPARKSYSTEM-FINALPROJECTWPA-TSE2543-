<?php
// Create a new table to store login activity
$query = "CREATE TABLE IF NOT EXISTS login_activity (
    id INT AUTO_INCREMENT,
    user_email VARCHAR(255),
    login_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
)";
mysqli_query($conn, $query);

// Log the login activity
if (mysqli_num_rows($result) > 0) {
    $query = "INSERT INTO login_activity (user_email) VALUES ('$email')";
    mysqli_query($conn, $query);
    // Send notification to admin (optional)
    $admin_email = 'admin@example.com';
    $subject = 'New login activity';
    $message = "User $email has logged in at " . date('Y-m-d H:i:s');
    mail($admin_email, $subject, $message);
    // Redirect to dashboard
    header("Location: dashboard.php");
    exit();
}
?>
<?php
// Retrieve login activity data
$query = "SELECT * FROM login_activity ORDER BY login_time DESC";
$result = mysqli_query($conn, $query);

// Display login activity data
echo "<h1>Login Activity</h1>";
echo "<table>";
echo "<tr><th>User Email</th><th>Login Time</th></tr>";
while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>" . $row['user_email'] . "</td>";
    echo "<td>" . $row['login_time'] . "</td>";
    echo "</tr>";
}
echo "</table>";
?>
