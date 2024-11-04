<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_data'])) {
    header("Location: login.php");
    exit();
}

$user_data = $_SESSION['user_data'];

// Retrieve receipt data from session
$receipt = isset($_SESSION['receipt']) ? $_SESSION['receipt'] : null;
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #9e2576;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: auto;
            background:#cc6e9d ;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .banner {
            background-color: pink;
            color: black;
            padding: 20px;
            text-align: center;
        }
        .details {
            margin-top: 20px;
        }
        .details p {
            margin: 5px 0;
        }
        .receipt-container {
            margin-top: 20px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            background-color: #fff;
        }
        .thank-you {
            text-align: center;
            font-size: 18px;
            color: #333;
            margin-top: 20px;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            color: white;
            background-color: purple;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .button:hover {
            background-color: #0056b3;
        }

        /* Center the button container */
        p {
            text-align: center; /* Centers the button horizontally */
        }
        h1{
            font-size:25px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="banner">
            <h1>Profile Page</h1>
            <p>Welcome, <strong><?php echo htmlspecialchars($user_data['fname']); ?></strong>!</p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($user_data['email']); ?></p>
        </div>

        <?php if ($receipt): ?>
            <div class="receipt-container">
                <h1>Your Boooking History</h1>
                
                <p class="thank-you">Thank you for using QuickPark System. Here are your parking details:</p>
                <div class="details">
                    <p><strong>Spot Number:</strong> <?php echo htmlspecialchars($receipt['spot_number']); ?></p>
                    <p><strong>Wing:</strong> <?php echo htmlspecialchars($receipt['wing']); ?></p>
                    <p><strong>Spot Type:</strong> <?php echo htmlspecialchars($receipt['spot_type']); ?></p>
                </div>
                <div class="button-container">
                    <form action="makepay.html" method="post">
                        <input type="hidden" name="spot_number" value="<?php echo htmlspecialchars($receipt['spot_number']); ?>">
                        <input type="hidden" name="wing" value="<?php echo htmlspecialchars($receipt['wing']); ?>">
                        <input type="hidden" name="spot_type" value="<?php echo htmlspecialchars($receipt['spot_type']); ?>">
                        
                    </form>
                </div>
            </div>
        <?php else: ?>
            <p>No parking details available.</p>
        <?php endif; ?>
    </div>
    <p><a href="login.php" class="button">Logout</a></p>

</body>
</html>
