<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
        }

        .Frame111 {
            width: 1340px;
            height: 121px;
            display: inline-flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 10px;
        }

        .MainMenu {
            width: 1340px;
            height: 33px;
            position: relative;
        }

        .Frame12 {
            left: 890px;
            top: 7px;
            position: absolute;
            display: inline-flex;
            justify-content: flex-start;
            align-items: flex-start;
            gap: 50px;
        }

        .Frame12 .dropdown {
            position: relative;
        }

        .Frame12 .dropdown-content {
            display: none;
            position: absolute;
            background-color: white;
            min-width: 160px;
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .Frame12 .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .Frame12 .dropdown-content a:hover {
            background-color: #f1f1f1;
        }

        .Frame12 .dropdown:hover .dropdown-content {
            display: block;
        }

        .Events,
        .Sell,
        .MyTickets,
        .SignIn {
            color: black;
            font-size: 16px;
            font-weight: 700;
            word-wrap: break-word;
            text-decoration: none;
        }

        .SignInContainer {
            display: flex;
            align-items: center;
            position: relative;
        }

        .SignInContainer .SignIn {
            font-size: 16px;
            font-weight: 700;
            display: flex;
            align-items: center;
        }
        .MdiUser {
            width: 20px;
            height: 20px;
            background: black;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-left: 8px;
        }
        .MdiUser .Vector {
            width: 20px;
            height: 20px;
        }

        .dropdown .dropdown-content {
            display: none;
            position: absolute;
            background-color: white;
            min-width: 160px;
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .dropdown .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown .dropdown-content a:hover {
            background-color: #f1f1f1;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .TickethubLogo2 {
            width: 250px;
            height: 35px;
            left: -12px;
            top: -2px;
            position: absolute;
        }

        .Frame110 {
            width: 368px;
            height: 46px;
            left: 300px;
            top: -7px;
            position: absolute;
            border-radius: 20px;
            border: 1px #B5B5B5 solid;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: white;
            padding: 0 10px;
            transition: width 0.3s ease-in-out;
        }

        .Frame110.expanded {
            width: 500px;
        }

        .SearchForEventsArtistsOrVenues {
            color: #8C8C8C;
            font-size: 16px;
            font-family: 'Poppins', sans-serif;
            font-weight: 300;
            word-wrap: break-word;
            border: none;
            outline: none;
            flex-grow: 1;
            padding: 5px 0;
        }

        .IcBaselineSearch {
            width: 36px;
            height: 36px;
            display: flex;
            justify-content: center;
            align-items: center;
            background: white;
            border-radius: 50%;
            border: none;
            cursor: pointer;
        }

        .IcBaselineSearch .Vector {
            width: 20px;
            height: 20px;
        }

        .profile-dropdown {
            display: none;
            position: absolute;
            top: 20px;
            right: 0;
            background-color: white;
            min-width: 160px;
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .profile-dropdown a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .profile-dropdown a:hover {
            background-color: #f1f1f1;
        }

        .SignInContainer:hover .profile-dropdown {
            display: block;
        }
    </style>
</head>

<body>
    <div class="Frame111">
        <div class="MainMenu">
            <div class="Frame12">
                <a href="/events" class="Events">Events</a>
                <div class="dropdown">
                    <a href="/sell-tickets" class="Sell">Sell</a>
                    <div class="dropdown-content">
                        <a href="/sell-tickets">Sell Tickets</a>
                        <a href="/my-listings">My Tickets</a>
                        <a href="/my-sales">My Sales</a>
                    </div>
                </div>
                <div class="dropdown">
                    <a href="/my-listings" class="MyTickets">My Tickets</a>
                    <div class="dropdown-content">
                        <a href="/my-orders">Orders</a>
                        <a href="/my-listings">My Listings</a>
                        <a href="/my-sales">My Sales</a>
                        <a href="/payments">Payments</a>
                    </div>
                </div>

                <div class="SignInContainer">
                    @guest
                    <a href="/login" class="SignIn">Sign In</a>
                    <div class="MdiUser">
                        <a href="/login">
                            <img class="Vector" src="{{ asset('images/profile-icon.png') }}" alt="Profile Icon">
                        </a>
                    </div>
                    @else
                    <div class="dropdown">
                        <a href="#" class="SignIn">Profile
                            <div class="MdiUser">
                                <img class="Vector" src="{{ asset('images/profile-icon.png') }}" alt="Profile Icon">
                            </div>
                        </a>
                        <div class="profile-dropdown">
                            <a href="/my-profile">My Profile</a>
                            <a href="/settings">Settings</a>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Sign Out
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>

                        </div>
                    </div>
                    @endguest
                </div>
            </div>
            <a href="/">
                <img class="TickethubLogo2" src="{{ asset('images/tickethub logo.png') }}" alt="Tickethub Logo" />
            </a>
            <div class="Frame110">
                <form action="{{ route('search') }}" method="GET" style="display: flex; align-items: center; width: 100%;">
                    <input type="text" name="query" class="SearchForEventsArtistsOrVenues" placeholder="Search for events, artists, or venues" onfocus="expandSearchBar()" onblur="collapseSearchBar()">
                    <button type="submit" class="IcBaselineSearch">
                        <img class="Vector" src="{{ asset('images/search-icon.png') }}" alt="Search Icon">
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function expandSearchBar() {
            document.querySelector('.Frame110').classList.add('expanded');
        }

        function collapseSearchBar() {
            document.querySelector('.Frame110').classList.remove('expanded');
        }
    </script>
</body>

</html>
