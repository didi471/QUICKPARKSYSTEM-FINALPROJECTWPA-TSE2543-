<!DOCTYPE html>
<html>
<head>
    <title>Car Parking System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('https://static.vecteezy.com/system/resources/previews/036/372/442/non_2x/hospital-building-with-ambulance-emergency-car-on-cityscape-background-cartoon-illustration-vector.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            margin: 0;
            padding: 20px;
        }
        h1 {
            text-align: center;
        }
        h2 {
            text-align: center;
        }
        .container {
            max-width: 800px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color:#9e2576;
        }
        .wing {
            margin-bottom: 20px;
        }
        .wing h2 {
            text-align: center;
        }
        .parking-lot {
            display: grid;
            grid-template-columns: repeat(10, 1fr);
            gap: 5px;
            margin-top: 10px;
        }
        .spot {
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #ffffff;
            border: 1px solid #ccc;
            border-radius: 5px;
            cursor: pointer;
        }
        .spot.occupied {
            background-color: #f44336;
            color: white;
        }
        .spot.vip {
            background-color: #ff9800;
        }
        button {
            margin-top: 10px;
            padding: 10px;
            width: 100%;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome To QuickPark System</h1>
        <h2>Car Parking System</h2>
        <!-- Wing A -->
        <div class="wing">
            <h2>Wing A</h2>
            <div class="parking-lot" id="wing-a"></div>
        </div>
        <!-- Wing B -->
        <div class="wing">
            <h2>Wing B</h2>
            <div class="parking-lot" id="wing-b"></div>
        </div>
        <!-- Wing C -->
        <div class="wing">
            <h2>Wing C</h2>
            <div class="parking-lot" id="wing-c"></div>
        </div>
        <button onclick="resetParkingLot()">Reset</button>
        <form id="paymentForm" action='availablepark.php' method='post'>
            <input type="hidden" id="selectedSpotNumber" name="spot_number">
            <input type="hidden" id="selectedWing" name="wing">
            <button type='button' onclick="confirmSubmission()">Confirm</button>
        </form>

    </div>
    <script>
        const parkingSpots = [...new Array(20).fill(false), ...new Array(40).fill(false), ...new Array(30).fill(false)];
        const wingAElement = document.getElementById('wing-a');
        const wingBElement = document.getElementById('wing-b');
        const wingCElement = document.getElementById('wing-c');

        function initializeParkingLot() {
            for (let i = 0; i < 20; i++) {
                const spotElement = createSpotElement(i, 'VIP');
                wingAElement.appendChild(spotElement);
            }
            for (let i = 20; i < 60; i++) {
                const spotElement = createSpotElement(i, 'Basic');
                wingBElement.appendChild(spotElement);
            }
            for (let i = 60; i < 90; i++) {
                const spotElement = createSpotElement(i, 'Basic');
                wingCElement.appendChild(spotElement);
            }
        }

        function createSpotElement(index, type) {
            const spotElement = document.createElement('div');
            spotElement.classList.add('spot');
            spotElement.dataset.index = index;
            spotElement.innerText = `${type} ${index + 1}`;
            if (type === 'VIP' && index < 20) {
                spotElement.classList.add('vip');
            }
            spotElement.onclick = () => toggleSpot(index, type === 'VIP' ? 'A' : (index < 60 ? 'B' : 'C'));
            return spotElement;
        }

        function toggleSpot(index, wing) {
            if (!parkingSpots[index]) {
                parkingSpots[index] = true;
                const spotElement = document.querySelector(`.spot[data-index='${index}']`);
                spotElement.classList.add('occupied');

                document.getElementById('selectedSpotNumber').value = index + 1;
                document.getElementById('selectedWing').value = wing;
            } else {
                alert("This spot is already occupied.");
            }
        }

        function confirmSubmission() {
            const confirmed = confirm("Are you sure you want to confirm your parking?");
            if (confirmed) {
                document.getElementById('paymentForm').submit();
            }
        }


        function resetParkingLot() {
            parkingSpots.fill(false);
            const spots = document.querySelectorAll('.spot');
            spots.forEach(spot => {
                spot.classList.remove('occupied');
            });
            alert("The parking lot has been reset.");
        }

        window.onload = initializeParkingLot;
    </script>
</body>
</html>
