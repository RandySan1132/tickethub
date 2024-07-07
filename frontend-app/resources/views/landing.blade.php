<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TicketHub - The Right Marketplace For You</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <style>
        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
        }

        .container {
            width: 100%;
            max-width: 1340px;
            margin: 0 auto;
            padding: 0 20px;
            box-sizing: border-box;
        }

        .header {
            background-color: #fff;
            padding: 0px 0;
            margin-bottom: 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header .nav {
            display: flex;
            gap: 20px;
        }

        .header .nav a {
            color: #000;
            text-decoration: none;
            font-size: 16px;
            font-weight: 600;
            position: relative;
        }

        .header .nav a:hover {
            color: #00911E;
        }

        .header .dropdown {
            position: relative;
        }

        .header .dropdown-content {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            background-color: #fff;
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .header .dropdown-content a {
            color: #000;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .header .dropdown-content a:hover {
            background-color: #f1f1f1;
        }

        .header .dropdown:hover .dropdown-content {
            display: block;
        }

        .header .dates-dropdown {
            position: relative;
        }

        .header .dates-dropdown-content {
            display: none;
            position: absolute;
            top: 100%;
            right: 0;
            background-color: #fff;
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .header .dates-dropdown-content a {
            color: #000;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .header .dates-dropdown-content a:hover {
            background-color: #f1f1f1;
        }

        .header .dates-dropdown-content .checked {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .slideshow-container {
            position: relative;
            max-width: 100%;
            margin: auto;
        }

        .mySlides {
            display: none;
            width: 100%;
        }

        .mySlides img {
            width: 100%;
            border-radius: 25px;
        }

        .numbertext {
            color: #f2f2f2;
            font-size: 12px;
            padding: 8px 12px;
            position: absolute;
            top: 0;
        }

        .text {
            color: #f2f2f2;
            font-size: 15px;
            padding: 8px 12px;
            position: absolute;
            bottom: 8px;
            width: 100%;
            text-align: center;
        }

        .fade {
            -webkit-animation-name: fade;
            -webkit-animation-duration: 1.5s;
            animation-name: fade;
            animation-duration: 1.5s;
        }

        @-webkit-keyframes fade {
            from {
                opacity: .4
            }

            to {
                opacity: 1
            }
        }

        @keyframes fade {
            from {
                opacity: .4
            }

            to {
                opacity: 1
            }
        }

        .text-content {
            position: absolute;
            top: 50%;
            left: 5%;
            transform: translateY(-50%);
            color: white;
            max-width: 30%;
            padding: 10px;
            border-radius: 15px;
        }

        .text-content h1 {
            font-size: 38px;
            font-weight: 900;
            margin-bottom: 20px;
        }

        .text-content p {
            font-size: 17px;
            font-weight: 200;
            margin-bottom: 0px;
        }

        .text-content .button {
            background-color: #00911E;
            border: none;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            cursor: pointer;
            border-radius: 12px;
        }

        .dot {
            height: 15px;
            width: 15px;
            margin: 0 2px;
            background-color: #bbb;
            border-radius: 50%;
            display: inline-block;
            transition: background-color 0.6s ease;
        }

        .active {
            background-color: #717171;
        }

        .dot-container {
            text-align: center;
            padding: 20px;
            position: absolute;
            bottom: 10px;
            left: 50%;
            transform: translateX(-50%);
        }

        .section {
            margin: 40px 0;
        }

        .section h2 {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .section .grid {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }

        .section .item {
            flex: 1;
            min-width: 200px;
            max-width: calc(25% - 20px);
        }

        .section .item img {
            width: 100%;
            border-radius: 10px;
        }

        .section .item p {
            margin-top: 10px;
            font-size: 16px;
            font-weight: 700;
            text-align: left;
        }

        .modal {
            display: none;
            position: absolute;
            background-color: #fff;
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
            padding: 20px;
            border-radius: 10px;
            width: 300px;
            z-index: 1000;
            margin-left:-250px;

        }

        .modal-content {
            padding: 0px;
            
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-left: 10px;
            margin-bottom: 5px;
        }

        .modal-header h2 {
            margin: 0;
            font-size: 18px;
        }

        .modal-close {
            cursor: pointer;
            font-size: 24px;
        }

        .flatpickr-calendar {
            width: 100%;
            border: none;
            box-shadow: none;
        }

        .flatpickr-calendar .flatpickr-months .flatpickr-month {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .flatpickr-calendar .flatpickr-months .flatpickr-month .flatpickr-prev-month,
        .flatpickr-calendar .flatpickr-months .flatpickr-month .flatpickr-next-month {
            cursor: pointer;
            font-size: 24px;
            padding: 0 10px;
        }

        .flatpickr-calendar .flatpickr-days {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 5px;
        }

        .flatpickr-calendar .flatpickr-day {
            padding: 10px;
            cursor: pointer;
        }

        .flatpickr-calendar .flatpickr-day.selected {
            background-color: #00911E;
            color: white;
        }

        .flatpickr-calendar .flatpickr-day.startRange {
            border-radius: 50% 0 0 50%;
        }

        .flatpickr-calendar .flatpickr-day.endRange {
            border-radius: 0 50% 50% 0;
        }
    </style>
</head>

<body>
    <div class="container">
        @include('header')

        <div class="header">
            <div class="nav">
                <div class="dropdown">
                    <a href="#">Sports</a>
                    <div class="dropdown-content">
                        <a href="#">Copa America</a>
                        <a href="#">New York Yankees</a>
                        <a href="#">All Sports</a>
                    </div>
                </div>
                <div class="dropdown">
                    <a href="#">Concerts</a>
                    <div class="dropdown-content">
                        <a href="#">Taylor Swift</a>
                        <a href="#">Justin Bieber</a>
                        <a href="#">All Concerts</a>
                    </div>
                </div>
                <div class="dropdown">
                    <a href="#">Theater</a>
                    <div class="dropdown-content">
                        <a href="#">Legend</a>
                        <a href="#">Major</a>
                        <a href="#">All Theater</a>
                    </div>
                </div>
            </div>
            <!-- <div class="nav">
                <div class="dates-dropdown">
                    <a href="#" id="allDatesButton" onclick="toggleDropdown(event)">All Dates</a>
                    <div class="dates-dropdown-content" id="datesDropdownContent">
                        <a href="#" data-date="all-dates" class="checked">All Dates <span>&#10003;</span></a>
                        <a href="#" data-date="today">Today</a>
                        <a href="#" data-date="this-weekend">This weekend</a>
                        <a href="#" data-date="this-month">This month</a>
                        <a href="#" data-date="custom-dates" onclick="showModal(event)">Custom dates</a>
                    </div>
                </div>
            </div> -->
        </div>

        <div class="slideshow-container">
            <div class="mySlides fade">
                <img src="{{ asset('images/slide1.jpg') }}" alt="Morodok Techo National Stadium">
                <div class="text-content">
                    <p>FEATURED</p>
                    <h1>Morodok Techo National Stadium</h1>
                    <a href="#" class="button">See Tickets</a>
                </div>
            </div>

            <div class="mySlides fade">
                <img src="{{ asset('images/slide2.jpg') }}" alt="Smart Axiata Concert">
                <div class="text-content">
                    <p>FEATURED</p>
                    <h1>Smart Axiata Concert</h1>
                    <a href="#" class="button">See Tickets</a>
                </div>
            </div>

            <!-- Add more slides as needed -->
            <div class="dot-container">
                <span class="dot"></span>
                <span class="dot"></span>
                <!-- Add more dots as needed -->
            </div>
        </div>

        <!-- New Sections -->
        <!-- <div class="section">
            <h2>Recommended for You</h2>
            <div class="grid">
                <div class="item">
                    <img src="{{ asset('images/recommended1.jpg') }}" alt="Los Angeles Dodgers">
                    <p>Los Angeles Dodgers</p>
                </div>
                <div class="item">
                    <img src="{{ asset('images/recommended2.jpg') }}" alt="Cyndi Lauper">
                    <p>Cyndi Lauper</p>
                </div>
                <div class="item">
                    <img src="{{ asset('images/recommended3.jpg') }}" alt="Howard Jones">
                    <p>Howard Jones</p>
                </div>
                <div class="item">
                    <img src="{{ asset('images/recommended4.jpg') }}" alt="Orchestral Manoeuvres In The Dark">
                    <p>Orchestral Manoeuvres In The Dark</p>
                </div>
            </div>
        </div> -->

        <!-- <div class="section">
            <h2>Popular Categories</h2>
            <div class="grid">
                <div class="item">
                    <img src="{{ asset('images/category1.jpg') }}" alt="Pop">
                    <p>Pop</p>
                </div>
                <div class="item">
                    <img src="{{ asset('images/category2.jpg') }}" alt="Rock Music">
                    <p>Rock Music</p>
                </div>
                <div class="item">
                    <img src="{{ asset('images/category3.jpg') }}" alt="Soccer">
                    <p>Soccer</p>
                </div>
                <div class="item">
                    <img src="{{ asset('images/category4.jpg') }}" alt="Formula 1">
                    <p>Formula 1</p>
                </div>
            </div>
        </div> -->

        <div class="section">
            <h2>Concerts</h2>
            <div class="grid">
                <div class="item">
                    <img src="{{ asset('images/concert1.jpg') }}" alt="Cyndi Lauper">
                    <p>Cyndi Lauper</p>
                </div>
                <div class="item">
                    <img src="{{ asset('images/concert2.jpg') }}" alt="Howard Jones">
                    <p>Howard Jones</p>
                </div>
                <div class="item">
                    <img src="{{ asset('images/concert3.jpg') }}" alt="Orchestral Manoeuvres In The Dark">
                    <p>Orchestral Manoeuvres In The Dark</p>
                </div>
                <div class="item">
                    <img src="{{ asset('images/concert4.jpg') }}" alt="Sebastian Bach">
                    <p>Sebastian Bach</p>
                </div>
            </div>
        </div>

        <div class="section">
            <h2>Sports</h2>
            <div class="grid">
                <div class="item">
                    <img src="{{ asset('images/sports1.jpg') }}" alt="Los Angeles Dodgers">
                    <p>Los Angeles Dodgers</p>
                </div>
                <div class="item">
                    <img src="{{ asset('images/sports2.jpg') }}" alt="Los Angeles Sparks">
                    <p>Los Angeles Sparks</p>
                </div>
                <div class="item">
                    <img src="{{ asset('images/sports3.jpg') }}" alt="Los Angeles Rams">
                    <p>Los Angeles Rams</p>
                </div>
                <div class="item">
                    <img src="{{ asset('images/sports4.jpg') }}" alt="Los Angeles Chargers">
                    <p>Los Angeles Chargers</p>
                </div>
            </div>
        </div>

        <div class="section">
            <h2>Theater</h2>
            <div class="grid">
                <div class="item">
                    <img src="{{ asset('images/theater1.jpg') }}" alt="Hamilton">
                    <p>Hamilton</p>
                </div>
                <div class="item">
                    <img src="{{ asset('images/theater2.jpg') }}" alt="Mean Girls">
                    <p>Mean Girls</p>
                </div>
                <div class="item">
                    <img src="{{ asset('images/theater3.jpg') }}" alt="Tucker Carlson">
                    <p>Tucker Carlson</p>
                </div>
                <div class="item">
                    <img src="{{ asset('images/theater4.jpg') }}" alt="Seong-Jin Cho">
                    <p>Seong-Jin Cho</p>
                </div>
            </div>
        </div>

        <!-- <div class="section">
            <h2>Comedy</h2>
            <div class="grid">
                <div class="item">
                    <img src="{{ asset('images/comedy1.jpg') }}" alt="Sarah Silverman">
                    <p>Sarah Silverman</p>
                </div>
                <div class="item">
                    <img src="{{ asset('images/comedy2.jpg') }}" alt="Tim Minchin">
                    <p>Tim Minchin</p>
                </div>
                <div class="item">
                    <img src="{{ asset('images/comedy3.jpg') }}" alt="Pauly Shore">
                    <p>Pauly Shore</p>
                </div>
                <div class="item">
                    <img src="{{ asset('images/comedy4.jpg') }}" alt="Patton Oswalt">
                    <p>Patton Oswalt</p>
                </div>
            </div>
        </div> -->

        <div id="dateRangeModal" class="modal">
            <div class="modal-content">
                <div class="modal-header">
                    <h2>Select date range</h2>
                    <span class="modal-close" onclick="closeModal()">&times;</span>
                </div>
                <div id="dateRangePicker"></div>
            </div>
        </div>

        @include('footer')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script>
        let slideIndex = 0;
        showSlides();

        function showSlides() {
            let i;
            let slides = document.getElementsByClassName("mySlides");
            let dots = document.getElementsByClassName("dot");
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            slideIndex++;
            if (slideIndex > slides.length) {
                slideIndex = 1
            }
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }
            slides[slideIndex - 1].style.display = "block";
            dots[slideIndex - 1].className += " active";
            setTimeout(showSlides, 20000); // Change image every 20 seconds
        }

        function toggleDropdown(event) {
            event.preventDefault();
            const dropdown = document.getElementById('datesDropdownContent');
            dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
        }

        window.onclick = function(event) {
            if (!event.target.matches('.dates-dropdown > a') && !event.target.closest('.modal')) {
                const dropdown = document.getElementById('datesDropdownContent');
                if (dropdown.style.display === 'block') {
                    dropdown.style.display = 'none';
                }
            }
        }

        document.querySelectorAll('.dates-dropdown-content a').forEach(item => {
            item.addEventListener('click', event => {
                event.preventDefault();
                const selectedDate = event.target.getAttribute('data-date');
                if (selectedDate !== 'custom-dates') {
                    updateDateSelection(selectedDate);
                    updateCheckIcon(event.target); // Update the check icon
                    toggleDropdown(event); // Close dropdown after selection
                } else {
                    showModal(event);
                }
            });
        });

        function updateDateSelection(date) {
    const allDatesButton = document.getElementById('allDatesButton');
    const dateText = {
        'all-dates': 'All Dates',
        'today': 'Today',
        'this-weekend': 'This Weekend',
        'this-month': 'This Month',
        'custom-dates': 'Custom Dates'
    };

    if (dateText[date]) {
        allDatesButton.innerText = dateText[date];
    } else {
        allDatesButton.innerText = date;
    }
    console.log(`Selected date: ${date}`);
}


        function updateCheckIcon(selectedElement) {
            const allOptions = document.querySelectorAll('.dates-dropdown-content a');
            allOptions.forEach(option => {
                option.classList.remove('checked');
                option.querySelector('span')?.remove(); // Remove existing check icon
            });

            selectedElement.classList.add('checked');
            const checkIcon = document.createElement('span');
            checkIcon.innerHTML = '&#10003;';
            selectedElement.appendChild(checkIcon);
        }

        function showModal(event) {
            event.preventDefault();
            const modal = document.getElementById('dateRangeModal');
            const dropdownContent = document.getElementById('datesDropdownContent');
            dropdownContent.style.display = 'none'; // Hide the dropdown

            // Get the position of the "All Dates" button
            const allDatesButton = document.getElementById('allDatesButton');
            const rect = allDatesButton.getBoundingClientRect();

            // Position the modal just below the "All Dates" button
            modal.style.top = `${rect.bottom + window.scrollY}px`;
            modal.style.left = `${rect.left + window.scrollX}px`;

            modal.style.display = 'block'; // Show the modal

            // Initialize Flatpickr on the modal directly
            flatpickr("#dateRangePicker", {
                mode: "range",
                inline: true, // Display the calendar inline
                onClose: function(selectedDates, dateStr, instance) {
                    if (selectedDates.length === 2) {
                        const dateRange = selectedDates.map(date => date.toLocaleDateString('en-US', { month: 'short', day: 'numeric' })).join(' - ');
                        console.log(`Selected custom date range: ${dateRange}`);
                        updateDateSelection(dateRange);
                        updateCheckIcon(document.querySelector('[data-date="custom-dates"]'));
                        closeModal();
                    }
                }
            });
        }

        function closeModal() {
            const modal = document.getElementById('dateRangeModal');
            modal.style.display = 'none';
        }

        // Add an event listener for the custom dates option
        document.querySelector('[data-date="custom-dates"]').addEventListener('click', showModal);
    </script>
    <script src="{{ mix('js/app.js') }}"></script>
</body>

</html>
