<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Explore Events - TicketHub</title>
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
            padding: 20px 0;
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
            cursor: pointer;
        }

        .header .nav a:hover {
            color: #00911E;
        }

        .header .nav .selected {
            color: #00911E;
            border-bottom: 2px solid #00911E;
        }

        .filters {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .dates-dropdown {
            position: relative;
        }

        .dates-dropdown-content {
            display: none;
            position: absolute;
            top: 100%;
            right: 0;
            background-color: #fff;
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .dates-dropdown-content a {
            color: #000;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dates-dropdown-content a:hover {
            background-color: #f1f1f1;
        }

        .dates-dropdown-content .checked {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .explore-events {
            text-align: center;
            margin-bottom: 20px;
        }

        .explore-events h1 {
            font-size: 25px;
            font-weight: 700;
            text-align: left;
        }

        .explore-events p {
            font-size: 18px;
            color: #666;
        }

        .events-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }

        .event-item {
            width: calc(25% - 20px);
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            margin-bottom: 20px;
        }

        .event-item img {
            width: 100%;
            height: 200px;
        }

        .event-info {
            padding: 15px;
        }

        .event-info h3 {
            font-size: 18px;
            font-weight: 700;
            margin: 0 0 10px;
        }

        .event-info p {
            margin: 0;
            font-size: 14px;
            color: #666;
        }

        .event-info .event-date-time {
            margin-top: 10px;
            font-size: 14px;
            color: #333;
        }

        .show-more {
            text-align: center;
            margin: 40px 0;
        }

        .show-more button {
            background-color: #00911E;
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
        }

        .show-more button:hover {
            background-color: #007e1a;
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
            margin-left: -250px;
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

        .filters {
            display: flex;
            gap: 20px;
            align-items: center;
        }

        .filters .dates-dropdown {
            position: relative;
        }

        .filters .dates-dropdown a {
            color: #000;
            text-decoration: none;
            font-size: 16px;
            font-weight: 600;
            position: relative;
            cursor: pointer;
        }

        .filters .dates-dropdown a:hover {
            color: #00911E;
        }

        .filters .dates-dropdown-content {
            display: none;
            position: absolute;
            top: 100%;
            right: 0;
            background-color: #fff;
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .filters .dates-dropdown-content a {
            color: #000;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .filters .dates-dropdown-content a:hover {
            background-color: #f1f1f1;
        }

        .filters .dates-dropdown-content .checked {
            display: flex;
            justify-content: space-between;
        }

        .event-link {
            text-decoration: none;
            color: inherit;
        }
    </style>
</head>

<body>
    <div class="container">
        @include('header')

        <div class="header">
            <div class="nav">
                <a href="#" class="selected" onclick="filterEvents('all')">All Events</a>
                <a href="#" onclick="filterEvents('sports')">Sports</a>
                <a href="#" onclick="filterEvents('concerts')">Concerts</a>
                <a href="#" onclick="filterEvents('theater')">Theater</a>
                <a href="#" onclick="filterEvents('festivals')">Festivals</a>
            </div>
            <!-- <div class="filters">
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

        <div class="explore-events">
            <h1>Explore all events</h1>
        </div>

        <div class="events-grid" id="eventsGrid">
            @foreach($events as $event)
            <div class="event-item">
                <a href="{{ route('events.show', $event->id) }}" class="event-link">
                    <img src="http://localhost:8001/storage/{{ $event->thumbnail_image }}" alt="{{ $event->name }}">
                </a>
                <a href="{{ route('events.show', $event->id) }}" class="event-link">
                    <div class="event-info">
                        <h3>{{ $event->name }}</h3>
                        <p>{{ $event->location }}</p>
                        <p class="event-date-time">{{ $event->date }} - {{ $event->time }}</p>
                    </div>
                </a>
            </div>
            @endforeach
        </div>

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
        let displayedEvents = 8; // Number of events currently displayed
        let allEvents = []; // Array to store all events fetched from the server
        let currentCategory = 'all'; // Default category

        document.addEventListener('DOMContentLoaded', function () {
    fetchEvents('all', displayedEvents);

    document.querySelector('.header .nav a[onclick="filterEvents(\'all\')"]').classList.add('selected');
});

function toggleDropdown(event) {
    event.preventDefault();
    const dropdown = document.getElementById('datesDropdownContent');
    dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
}

window.onclick = function (event) {
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
            fetchEvents(currentCategory, displayedEvents, selectedDate); // Fetch events based on the selected date
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
        onClose: function (selectedDates, dateStr, instance) {
            if (selectedDates.length === 2) {
                const dateRange = selectedDates.map(date => date.toISOString().split('T')[0]);
                console.log(`Selected custom date range: ${dateRange}`);
                updateDateSelection(dateRange);
                updateCheckIcon(document.querySelector('[data-date="custom-dates"]'));
                closeModal();
                fetchEvents(currentCategory, displayedEvents, dateRange); // Fetch events based on the selected custom date range
            }
        }
    });
}

function closeModal() {
    const modal = document.getElementById('dateRangeModal');
    modal.style.display = 'none';
}

function filterEvents(category) {
    currentCategory = category;
    displayedEvents = 8; // Reset the number of displayed events
    fetchEvents(category, displayedEvents);

    const navLinks = document.querySelectorAll('.header .nav a');
    navLinks.forEach(link => link.classList.remove('selected'));

    let headerText = 'Explore all events';
    if (category === 'all') {
        headerText = 'Explore all events';
    } else {
        headerText = `Explore all ${category.charAt(0).toUpperCase() + category.slice(1)}`;
    }
    document.querySelector('.explore-events h1').innerText = headerText;

    document.querySelector(`.header .nav a[onclick="filterEvents('${category}')"]`).classList.add('selected');
}

function fetchEvents(category, limit, dateRange = 'all-dates') {
    let url = `/events/category/${category}?limit=${limit}`;
    if (dateRange !== 'all-dates') {
        if (Array.isArray(dateRange)) {
            url += `&start_date=${dateRange[0]}&end_date=${dateRange[1]}`;
        } else {
            url += `&date_range=${dateRange}`;
        }
    }
    fetch(url)
        .then(response => response.json())
        .then(events => {
            allEvents = events;
            displayEvents(allEvents.slice(0, displayedEvents));
        })
        .catch(error => console.error('Error fetching events:', error));
}

function displayEvents(events) {
    const eventsGrid = document.getElementById('eventsGrid');
    eventsGrid.innerHTML = '';

    events.forEach(event => {
        const eventItem = document.createElement('div');
        eventItem.classList.add('event-item');
        eventItem.setAttribute('data-category', event.category);
        eventItem.innerHTML = `
            <a href="/events/${event.id}" class="event-link">
                <img src="http://localhost:8001/storage/${event.thumbnail_image}" alt="${event.name}">
            </a>
            <a href="/events/${event.id}" class="event-link">
                <div class="event-info">
                    <h3>${event.name}</h3>
                    <p>${event.location}</p>
                    <p class="event-date-time">${event.date} - ${event.time}</p>
                </div>
            </a>
        `;
        eventsGrid.appendChild(eventItem);
    });
}

function showMoreEvents() {
    displayedEvents += 8;
    const newEvents = allEvents.slice(displayedEvents - 8, displayedEvents);
    appendEvents(newEvents);
}

function appendEvents(events) {
    const eventsGrid = document.getElementById('eventsGrid');

    events.forEach(event => {
        const eventItem = document.createElement('div');
        eventItem.classList.add('event-item');
        eventItem.setAttribute('data-category', event.category);
        eventItem.innerHTML = `
            <a href="/events/${event.id}" class="event-link">
                <img src="http://localhost:8001/storage/${event.thumbnail_image}" alt="${event.name}">
            </a>
            <a href="/events/${event.id}" class="event-link">
                <div class="event-info">
                    <h3>${event.name}</h3>
                    <p>${event.location}</p>
                    <p class="event-date-time">${event.date} - ${event.time}</p>
                </div>
            </a>
        `;
        eventsGrid.appendChild(eventItem);
    });
}


</script>
<script src="{{ mix('js/app.js') }}"></script>

</body>
</html>