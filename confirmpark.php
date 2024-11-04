<?php
session_start();
include("dbconnect.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $transport = $_POST['transport'];
    $parking_type = $_POST['parking_type'];
    $date = $_POST['date'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $price = $_POST['price'];

    // Calculate time difference in hours
    $start = new DateTime($start_time);
    $end = new DateTime($end_time);
    $diff = $end->diff($start)->h;

    $price = 0;
    if ($transport == 'motorcycle') {
        if ($parking_type == 'vip') {
            $price = $diff <= 2 ? 2 : 4;
        } else { // basic
            $price = $diff <= 2 ? 2 : 4;
        }
    } else if ($transport == 'car') {
        if ($parking_type == 'vip') {
            $price = $diff <= 2 ? 4 : 6;
        } else { // basic
            $price = $diff <= 2 ? 2 : 4;
        }
    }

    $sql = "INSERT INTO bookings (transport, parking_type, date, start_time, end_time, price) VALUES ('$transport', '$parking_type', '$date', '$start_time', '$end_time', '$price')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the connection
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="CONFIRMPARK1.css">
    <title>Booking Form</title>
    <script>
        function calculatePrice() {
            const transport = document.querySelector('select[name="transport"]').value;
            const parkingType = document.querySelector('select[name="parking_type"]').value;
            const startTime = document.querySelector('input[name="start_time"]').value;
            const endTime = document.querySelector('input[name="end_time"]').value;
            let price = 0;
            if (startTime && endTime) {
                const start = new Date(`1970-01-01T${startTime}:00Z`);
                const end = new Date(`1970-01-01T${endTime}:00Z`);
                const diff = (end - start) / (1000 * 60 * 60);
                if (transport === 'motorcycle') {
                    if (parkingType === 'vip') {
                        price = diff <= 2 ? 2 : 4;
                    } else { // basic
                        price = diff <= 2 ? 2 : 2;
                    }
                } else if (transport === 'car') {
                    if (parkingType === 'vip') {
                        price = diff <= 2 ? 4 : 6;
                    } else { // basic
                        price = diff <= 2 ? 2 : 4;
                    }
                }
            }
            document.querySelector('input[name="price"]').value = price;
            document.getElementById('price-display').innerText = `Total Price: RM ${price}`;
        }

        function validateDate() {
            const selectedDate = new Date(document.querySelector('input[name="date"]').value);
            const currentYear = new Date().getFullYear();

            if (selectedDate.getFullYear() !== currentYear) {
                alert("Please select a date within the current year.");
                return false;
            }
            return true;
        }
    </script>
</head>
<body>
<h1>Quickpark Users</h1><br><br><br><br>
<header>
    <div class="navbar">
        <h1>QUICKPARK BOOKING SLOT</h1>
    </div>
</header>
<div class="main-container">
    <div class="container">
        <h2>Book Your Slot</h2>
        <form action="parkingbook.php" method="POST" onsubmit="return validateDate()" oninput="calculatePrice()">
            <label>Transport:</label>
            <select name="transport" required>
                <option value="motorcycle">Motorcycle</option>
                <option value="car">Car</option>
            </select>
            <br><br>
            <label>Parking Type:</label>
            <select name="parking_type" required>
                <option value="vip">VIP</option>
                <option value="basic">Basic</option>
            </select>
            <br><br>
            <label>Date:</label>
            <input type="date" name="date" required>
            <br><br>
            <label>Start Time:</label>
            <input type="time" name="start_time" required>
            <br><br>
            <label>End Time:</label>
            <input type="time" name="end_time" required>
            <br><br>
            <input type="hidden" name="price">
            <div id="price-display">Total Price: RM 0</div>
            <br>
            <br>
            <br>
            <button type="submit">Submit</button>
        </form>
    </div>
</div>
</body>
</html>
