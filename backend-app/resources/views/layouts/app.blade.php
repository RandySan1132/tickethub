<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Management</title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap');
        body {
            margin: 0;
            padding: 0;
            background-color: #161616;
            color: #ffffff;
            font-family: 'Source Sans Pro', sans-serif;
        }

        /* Use Poppins font for headers and other elements as needed */
        h1, h2, h3, h4, h5, h6, .header, .sidebar, .card, .btn, .profile span {
            font-family: 'Poppins', sans-serif;
        }

        .p {
            font-family: 'Source Sans Pro', sans-serif;
            font-size: 16px;
        }

        .header {
            background-color: #282828;
            width: 100%;
            height: 74px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;
            position: fixed;
            top: 0;
            z-index: 1000;
        }
        .header-left {
            display: flex;
            align-items: center;
            padding-left: 35px;
        }
        .logo {
            width: 100%;
            height: 30px;
            margin-right: 20px; /* Gap between logo and search box */
        }
        .logo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .search {
            width: 227px;
            height: 42px;
            background: #353535;
            display: flex;
            align-items: center;
            padding: 0 10px;
            margin-right: 10px; /* Gap between search box and icon */
            margin-left: 10px;
            border-radius: 25px;
        }
        .search input {
            background: none;
            border: none;
            color: #BEBEBE;
            font-size: 16px;
            font-family: 'Source Sans Pro', sans-serif;
            flex: 1;
        }
        .icon {
            width: 24px;
            height: 24px;
            margin-right: 20px; /* Gap between icon and next element */
        }
        .icon img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .header-right {
            display: flex;
            align-items: center;
            padding-right: 50px;
        }
        .notification {
            width: 24px;
            height: 24px;
            margin-right: 20px; /* Gap between notification and profile */
        }
        .notification img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .profile {
            display: flex;
            align-items: center;
            margin-right: 20px; /* Gap to the right */
        }
        .profile img {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            margin-left: 10px;
        }
        .sidebar {
            background-color: #282828;
            width: 262px;
            position: absolute;
            top: 74px;
            padding: 20px;
            border-radius: 15px;
            margin-top: 20px;
            margin-left: 20px;
            margin-right: 20px;
            box-sizing: border-box;
        }
        .sidebar h2 {
            color: #1BD938;
        }
        .sidebar ul {
            padding: 0;
            list-style: none;
        }
        .sidebar li {
            margin-bottom: 5px;
            display: flex;
            align-items: center;
        }
        .sidebar li a {
            color: white;
            font-size: 17.7px;
            font-family: 'Poppins', sans-serif;
            text-decoration: none;
            display: flex;
            align-items: center;
            padding: 10px;
            border-radius: 15px;
            transition: background-color 0.3s ease;
            width: 300px; /* Set width */
            height: 45px; /* Set height */
            box-sizing: border-box; /* Include border in element's total width and height */
        }

        .sidebar li a .icon {
            width: 24px;
            height: 24px;
            margin-right: 10px; /* Gap between icon and text */
        }
        .sidebar li a.selected {
            color: #1BD938;
            border-radius: 15px;
            background-color: rgba(22, 22, 22, 1); /* Adjust the color and opacity as needed */
            margin-left: -10px; /* Shift the border to the left */
            padding-left: 20px; /* Adjust padding to keep text and icon aligned */
        }
        .content {
            margin-left: 300px;
            padding: 100px 20px 20px; /* Adjust padding to ensure content is below the header */
        }

        .event-table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
            table-layout: fixed; /* Ensures uniform column widths */
        }

        .event-table th,
        .event-table td {
            border-bottom: 1px solid #4E4E4E;
            padding: 10px;
            text-align: left;
        }

        .event-table th {
            background-color: #353535;
        }

        .event-table td {
            background-color: #282828;
        }

        .event-container {
            background-color: #282828;
            padding: 20px;
            border-radius: 15px;
            margin-bottom: 20px;
            width: calc(100% - 40px); /* Adjust for padding */
            box-sizing: border-box;
        }

        .event-details {
            display: flex;
            align-items: flex-start;
            gap: 20px; /* Adjust the gap as needed */
        }

        .event-details .text-content {
            flex: 1;
        }

        .event-details img {
            width: 269px;
            height: 181px;
            object-fit: cover;
            border-radius: 10px;
        }

        .event-container {
            background-color: #282828;
            padding: 20px;
            padding-left: 30px;
            border-radius: 15px;
            border: 2px solid rgba(0, 0, 0, 0.2);
            margin-bottom: 20px;
            max-width: 3000px; /* Set a max width */
            box-sizing: border-box; /* Include padding and border in the element's total width and height */
        }
        .event-details {
            display: flex;
            align-items: flex-start;
            gap: 20px; /* Adjust the gap as needed */
        }

        .event-details .text-content {
            flex: 1;
            line-height: 10px;
        }

        .event-details img {
            width: 269px;
            height: 181px;
            object-fit: cover;
            margin-right: 650px;
        }

        .event-box {
            background-color: #282828;
            padding: 15px;
            border-radius: 15px;
            margin-bottom: -5px;
            width: 363px; /* Ensure it doesn't overflow */
            height: 200px; /* Ensure it doesn't overflow */
            box-sizing: border-box; /* Include padding and border in the element's total width and height */
        }

        .event-box h3, .event-box p {
            margin: 0 0 3px 0;
            color: white;
            font-family: 'Poppins', sans-serif;
            font-size: 14px;
        }

        .event-box .event-actions {
            display: flex;
            gap: 10px;
            margin-top: 10px; /* Add space between content and buttons */
            margin-left: 180px; /* Shift the buttons to the left */
        }
        .btn {
            background-color: #1BD938;
            color: #030303;
            height: 40px;
            padding: 5px 13px;
            border: none;
            border-radius: 20px;
            cursor: pointer;
            font-size: 16px;
            text-align: center;
        }
        .btn.delete {
            background-color: #FF0000;
        }
        .carousel {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin-top: 30px;
            margin-bottom: 30px;
        }

        .carousel img {
            cursor: pointer;
        }

        .carousel .dots {
            display: flex;
            gap: 5px;
        }

        .carousel .dots img {
            width: 10px;
            height: 10px;
            border-radius: 50%;
        }

        .table-dark {
            background-color: #282828;
        }

        .thead-dark th {
            background-color: #353535;
        }

        .badge-success {
            background-color: #28a745;
            color: white;
        }

        .badge-warning {
            background-color: #ffc107;
            color: black;
        }

    </style>
</head>
<body>
    <div class="header">
        <div class="header-left">
            <div class="logo">
                <img src="{{ asset('images/tickethub logo.png') }}" alt="Logo">
            </div>
            <!-- <div class="search">
                <input type="text" placeholder="Search">
            </div>
            <div class="icon">
                <img src="{{ asset('images/search-icon.png') }}" alt="Icon">
            </div> -->
        </div>
        <div class="header-right">
            <!-- <div class="notification">
                <img src = "{{ asset('images/bell-icon.png') }}" alt="Notification">
            </div> -->
            <div class="profile">
                <img src="{{ asset('images/profile-icon.png') }}" alt="Profile">
            </div>
        </div>
    </div>
    <div class="sidebar">
        <ul>
            <li>
                <a href="{{ url('/events') }}" class="{{ Request::is('events') ? 'selected' : '' }}">
                    <img src="{{ asset(Request::is('events') ? 'images/icons/events-selected.png' : 'images/icons/events.png') }}" class="icon" alt="Events Icon">Events
                </a>
            </li>
            <li>
                <a href="{{ url('/orders') }}" class="{{ Request::is('orders') ? 'selected' : '' }}">
                    <img src="{{ asset(Request::is('orders') ? 'images/icons/orders-selected.png' : 'images/icons/orders.png') }}" class="icon" alt="Orders Icon">Orders
                </a>
            </li>
            <li>
                <a href="{{ url('/user-management') }}" class="{{ Request::is('user-management') ? 'selected' : '' }}">
                    <img src="{{ asset(Request::is('user-management') ? 'images/icons/user-management-selected.png' : 'images/icons/user-management.png') }}" class="icon" alt="User Management Icon">User Management
                </a>
            </li>
            <li>
                <a href="{{ url('/analytics') }}" class="{{ Request::is('analytics') ? 'selected' : '' }}">
                    <img src="{{ asset(Request::is('analytics') ? 'images/icons/analytics-selected.png' : 'images/icons/analytics.png') }}" class="icon" alt="Analytics Icon">Analytics
                </a>
            </li>
        </ul>
    </div>
    <div class="content">
        @yield('content')
    </div>
</body>
</html>
