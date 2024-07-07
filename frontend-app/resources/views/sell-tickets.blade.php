<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sell Tickets - TicketHub</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700;900&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
            background-color: #f5f5f5;
        }

        .container {
            width: 100%;
            max-width: 1340px;
            margin: 0 auto;
            padding: 0 20px;
            box-sizing: border-box;
        }

        h1 {
            font-size: 32px;
            margin-bottom: 10px;
            text-align: center;
            color: #333;
        }

        h2 {
            font-size: 24px;
            margin-top: 100px;
            margin-bottom: 20px;
            text-align: center;
            color: #333;
        }

        p {
            font-size: 16px;
            color: #666;
            margin-bottom: 30px;
            text-align: center;
        }

        .search-box {
            display: flex;
            justify-content: center;
            margin-bottom: 30px;
            position: relative;
        }

        .search-box input {
            padding: 15px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 5px 0 0 5px;
            width: 100%;
            max-width: 800px;
            box-sizing: border-box;
        }

        .search-box button {
            padding: 15px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-left: none;
            background-color: #00911E;
            color: #fff;
            border-radius: 0 5px 5px 0;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .search-box button:hover {
            background-color: #007e1a;
        }

        .cta-button {
            display: inline-block;
            margin-top: 20px;
            padding: 15px 30px;
            font-size: 16px;
            background-color: #00911E;
            color: #fff;
            border: none;
            border-radius: 15px;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .cta-button:hover {
            background-color: #007e1a;
        }

        .section {
            margin-top: 20px;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .styled-button {
            background-color: #00911E;
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            font-weight: bold;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .styled-button:hover {
            background-color: #007B16;
            transform: scale(1.05);
        }

        .styled-button:active {
            background-color: #005F12;
            transform: scale(1);
        }

        .hidden-form {
            display: none;
            margin-top: 20px;
        }

        .hidden-form input[type="text"],
        .hidden-form textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
        }

        .hidden-form input[type="file"] {
            margin-top: 10px;
        }

        .hidden-form h2 {
            margin-top: 0;
            font-size: 20px;
        }

        .hidden-form p {
            margin-top: 0;
            font-size: 14px;
            color: #666;
        }

        .autocomplete-dropdown {
            position: absolute;
            top: 60px;
            left: 0;
            right: 0;
            background-color: #fff;
            border: 1px solid none;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-height: 200px;
            overflow-y: auto;
            z-index: 1000;
            width: 100%;
        }

        .autocomplete-item {
            padding: 10px;
            cursor: pointer;
        }

        .autocomplete-item:hover {
            background-color: #f1f1f1;
        }
    </style>
    <script>
        function toggleRequestForm() {
            var form = document.getElementById('request-form');
            if (form.style.display === 'none' || form.style.display === '') {
                form.style.display = 'block';
            } else {
                form.style.display = 'none';
            }
        }

        // Hide the search bar
        document.addEventListener('DOMContentLoaded', function () {
            var searchBar = document.querySelector('.Frame110');
            if (searchBar) {
                searchBar.style.display = 'none';
            }
        });

        function searchEvents(query) {
            if (query.length < 3) {
                document.getElementById('autocomplete-dropdown').innerHTML = '';
                return;
            }

            fetch(`/search-events?query=${query}`)
                .then(response => response.json())
                .then(events => {
                    const dropdown = document.getElementById('autocomplete-dropdown');
                    dropdown.innerHTML = '';
                    events.forEach(event => {
                        const item = document.createElement('div');
                        item.classList.add('autocomplete-item');
                        item.textContent = event.name;
                        item.addEventListener('click', () => {
                            window.location.href = `/sell-tickets/${event.id}`;
                        });
                        dropdown.appendChild(item);
                    });
                });
        }
    </script>
</head>

<body>
    <div class="container">
        @include('header')

        <h1>Sell your tickets</h1>
        <p>viagogo is the world’s largest secondary marketplace for tickets to live events</p>
        <div class="search-box">
            <input type="text" placeholder="Search your event and start selling" oninput="searchEvents(this.value)">
            <div id="autocomplete-dropdown" class="autocomplete-dropdown"></div>
        </div>
        <h2>Can't find your events?</h2>

        <div class="section">
            <button class="styled-button" onclick="toggleRequestForm()">Request yours now</button>
        </div>
        <div id="request-form" class="section hidden-form">
            <h2>Request to List Your Event</h2>
            <input type="text" placeholder="Event Name">
            <input type="text" placeholder="Venue">
            <input type="text" placeholder="City">
            <textarea rows="5" placeholder="Event Details"></textarea>
            <input type="file">
            <p>Please upload any supporting documentation</p>
            <button class="styled-button">Submit Request</button>
        </div>

        @include('footer')
    </div>
</body>

</html>
