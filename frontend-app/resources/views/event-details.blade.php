<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $event->name }} - TicketHub</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700;900&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 0;
            height: 100vh;
            overflow: hidden;
        }

        .container {
            width: 100%;
            max-width: 1300px;
            margin: 0 auto;
            padding: 20px;
            display: flex;
            flex-direction: column;
            height: 90%;
        }

        .event-header {
            display: flex;
            align-items: center;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .event-header img {
            width: 70px;
            height: 70px;
            border-radius: 10px;
            object-fit: cover;
            margin-right: 20px;
        }

        .event-header h1 {
            font-size: 18px;
            margin: 0;
        }

        .event-header p {
            font-size: 14px;
            margin: 5px 0;
            color: gray;
        }

        .divider {
            width: 100%;
            height: 3px;
            background-color: #ddd;
            margin-bottom: 20px;
        }

        .main-content {
            display: flex;
            flex-grow: 1;
            overflow: hidden;
        }

        .venue-map-container {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding-right: 20px;
        }

        .venue-map {
            width: 70%;
        }

        .listings-container {
            width: 40%;
            overflow-y: auto;
            padding-left: 20px;
            padding-right: 20px;
            border-left: 1px solid #ddd;
        }

        .listings {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .listing-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            cursor: pointer;
        }

        .listing-item:hover,
        .listing-item.selected {
            background-color: #f0f0f0;
            border-color: #00911E;
        }

        .listing-item .price {
            font-size: 16px;
            font-weight: bold;
            color: #00911E;
        }

        .listing-item .details {
            display: flex;
            flex-direction: column;
        }

        .listing-item .details span {
            font-size: 14px;
            color: gray;
        }

        #listingsCount {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .select-button {
            background-color: #00911E;
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
            width: 100%;
            text-align: center;
            margin-top: 20px;
        }

        .select-button:hover {
            background-color: #007e1a;
        }
    </style>
</head>

<body>
    <div class="container">
        @include('header')

        <div class="event-header">
            <img src="http://localhost:8001/storage/{{ $event->thumbnail_image }}" alt="{{ $event->name }}">
            <div>
                <h1>{{ $event->name }}</h1>
                <p>{{ $event->date }} - {{ $event->time }}</p>
                <p>{{ $event->location }}</p>
            </div>
        </div>

        <div class="divider"></div>

        <div class="main-content">
            <div class="venue-map-container">
                <img src="http://localhost:8001/storage/{{ $event->event_map_image }}" alt="Venue Map" class="venue-map">
            </div>

            <div class="listings-container">
                <div id="listingsCount"></div>

                <div class="listings">
                    @foreach($groupedTickets as $ticketKey => $ticketData)
                        @php
                            list($ticketType, $price) = explode('|', $ticketKey);
                        @endphp
                        <div class="listing-item" onclick="selectTicket(this, '{{ $ticketType }}', {{ $price }})">
                            <div class="details">
                                <span>{{ $ticketType }}</span>
                                <span>Quantity: {{ $ticketData['quantity'] }}</span>
                            </div>
                            <div class="price">${{ $price }} each</div>
                        @endforeach
                </div>

                <button class="select-button" onclick="proceedToNextPage()">Select</button>
            </div>
        </div>
    </div>

    <script>
        let selectedTicketType = null;
        let selectedPrice = null;

        function selectTicket(element, ticketType, price) {
            document.querySelectorAll('.listing-item').forEach(item => {
                item.classList.remove('selected');
            });
            element.classList.add('selected');
            selectedTicketType = ticketType;
            selectedPrice = price;
        }

        function proceedToNextPage() {
            if (selectedTicketType && selectedPrice !== null) {
                window.location.href = `/checkout?ticket_type=${selectedTicketType}&price=${selectedPrice}&event_id={{ $event->id }}&event_name={{ urlencode($event->name) }}`;
            } else {
                alert('Please select a ticket type.');
            }
        }

        function updateListingsCount() {
            const listingsContainer = document.querySelector('.listings');
            const listingsCount = listingsContainer.children.length;
            document.getElementById('listingsCount').innerText = `${listingsCount} listings`;
        }

        updateListingsCount();
    </script>
</body>
</html>
