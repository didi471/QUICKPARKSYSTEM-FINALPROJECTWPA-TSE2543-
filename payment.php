<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $transport = isset($_POST['transport']) ? $_POST['transport'] : '';
    $parking_type = isset($_POST['parking_type']) ? $_POST['parking_type'] : '';
    $date = isset($_POST['date']) ? $_POST['date'] : '';
    $start_time = isset($_POST['start_time']) ? $_POST['start_time'] : '';
    $end_time = isset($_POST['end_time']) ? $_POST['end_time'] : '';
    $price = isset($_POST['price']) ? $_POST['price'] : '';
    
    // Connect to the database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "phplogin";
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    // Insert booking into the database
    $sql = "INSERT INTO bookings (transport, parking_type, date, start_time, end_time, price) VALUES ('$transport', '$parking_type', '$date', '$start_time', '$end_time', '$price')";
    
    if ($conn->query($sql) === TRUE) {
        // Display the receipt
        echo "
        <html>
        <head>
            <title>Payment Receipt</title>
            <link rel='stylesheet' type='text/css' href='PAYMENT.css'>
        </head>
        <body>
        
            <div class='receipt'>
                <h2>QuickPark System</h2>
                <br><br>
                <p><strong>Transport:  </strong> $transport</p>
                <p><strong>ParkingType:  </strong> $parking_type</p>
                <p><strong>Date:  </strong> $date</p>
                <p><strong>Start Time:  </strong> $start_time</p>
                <p><strong>End Time:  </strong> $end_time</p>
                <p><strong>Total Price:  </strong> RM $price</p>
                <br><br><br>
                <form action='makepay.html' method='post'>
                    <button type='submit'>Proceed to Payment</button>
                </form>
            </div>
        </body>
        </html>
        ";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    // Close the connection
    $conn->close();
}
?>
