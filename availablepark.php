<?php
session_start();

$spot_number = isset($_POST['spot_number']) ? $_POST['spot_number'] : '';
$wing = isset($_POST['wing']) ? $_POST['wing'] : '';

if (!empty($spot_number) && !empty($wing)) {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "phplogin";
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT spot_type FROM ParkingSpots WHERE spot_number = $spot_number AND wing = '$wing'";
    $result = $conn->query($sql);
    $spot_type = '';

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $spot_type = $row['spot_type'];
        }
    } else {
        $spot_type = 'Not found';
    }
    $conn->close();

    // Store receipt data in session
    $_SESSION['receipt'] = [
        'spot_number' => $spot_number,
        'wing' => $wing,
        'spot_type' => $spot_type
    ];
} else {
    $spot_type = 'Invalid spot number or wing.';
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Receipt</title>
    <style>
        body {
            font-family: Arial sans-serif; 
            background-color: #9e2576;
            margin: 0;
            padding: 20px; 
            margin:auto;display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            text-align: center;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color:white;
        }
        h1 { 
            text-align: center; 
            color: #333; 
        }
        p { 
            font-size: 20px; 
            color: grey; 
        }
        strong { 
            color: black; 
            font-size:20px;
        }
        .details { 
            margin-top: 20px; 
        }
        .details p { 
            margin: 5px 0; 
        }
        .thank-you { 
            text-align: center; 
            font-size: 18px; 
            color: black; 
            margin-top: 20px; 
        }
        .button-container { 
            text-align: center; 
            margin-top: 20px; 
            background-color:pink;
        }
        .button {
        display: inline-block;
        padding: 10px 20px;
        font-size: 25px;
        color: black;
        background-color: pink;
        text-align: center;
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    .button:hover {
        background-color: #0056b3;
    }
    </style>
</head>
<body>
    <div class="container">
        <h1>Receipt</h1>
        <p class="thank-you">Thank you for using QuickPark System. Here are your parking details:</p>
        <div class="details">
            <p><strong>Spot Number:</strong> <?php echo htmlspecialchars($spot_number); ?></p>
            <p><strong>Wing:</strong> <?php echo htmlspecialchars($wing); ?></p>
            <p><strong>Spot Type:</strong> <?php echo htmlspecialchars($spot_type); ?></p>
        </div>
        <div class="button-container">
            <form action="makepay.html" method="post">
                <input type="hidden" name="spot_number" value="<?php echo htmlspecialchars($spot_number); ?>">
                <input type="hidden" name="wing" value="<?php echo htmlspecialchars($wing); ?>">
                <input type="hidden" name="spot_type" value="<?php echo htmlspecialchars($spot_type); ?>">
                <p><a href="makepay.html" class="button">Confirm</a></p>
            </form>
        </div>
    </div>
</body>
</html>
