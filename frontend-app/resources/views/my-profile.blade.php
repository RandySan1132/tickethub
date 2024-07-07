<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TicketHub - My Profile</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            margin: 0;
            background-color: #f5f5f5;
        }

        .container {
            width: 100%;
            max-width: 1340px;
            margin: 0 auto;
            padding: 0 20px;
            box-sizing: border-box;
        }

        .main-content {
            display: flex;
            flex-wrap: nowrap;
            margin-top: 20px;
        }

        .sidebar {
            width: 250px;
            padding: 20px;
            background-color: none;
            border-right: 1px solid #ddd;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            box-sizing: border-box;
            border-radius: 10px;
        }

        .sidebar img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            display: block;
            margin: 0 auto 10px;
        }

        .sidebar h3 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 18px;
        }

        .sidebar a {
            display: block;
            color: #000;
            padding: 10px 0;
            text-decoration: none;
            font-size: 16px;
            border-bottom: 1px solid #ddd;
            transition: background-color 0.3s, color 0.3s;
            padding-left: 10px;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background-color: #f5f5f5;
            color: #00911E;
        }

        .content {
            flex: 1;
            padding: 40px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            box-sizing: border-box;
            margin-left: 20px;
            border-radius: 10px;
        }

        .profile-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .profile-header h2 {
            margin: 0;
            font-size: 24px;
        }

        .profile-info {
            margin-bottom: 20px;
        }

        .profile-info label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .profile-info p {
            margin: 0 0 10px 0;
        }

        .edit-profile-link {
            display: block;
            text-align: center;
            margin-top: 20px;
        }

        .edit-profile-link a {
            text-decoration: none;
            color: #00911E;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container">
        @include('header')
        <div class="main-content">
            <div class="sidebar">
                <img src="{{ asset('images/profile-icon.png') }}" alt="Profile Picture">
                <h3>{{ $user->name }}</h3>
                <a href="{{ url('/my-profile') }}" class="tab-link @if(request()->is('my-profile')) active @endif">Profile</a>
                <a href="{{ url('/my-orders') }}" class="tab-link @if(request()->is('my-orders')) active @endif">My Orders</a>
                <a href="{{ url('/my-listings') }}" class="tab-link @if(request()->is('my-listings')) active @endif">My Listings</a>
                <a href="{{ url('/my-sales') }}" class="tab-link @if(request()->is('my-sales')) active @endif">My Sales</a>
                <a href="{{ url('/payments') }}" class="tab-link @if(request()->is('payments')) active @endif">Payments</a>
                <a href="{{ url('/settings') }}" class="tab-link @if(request()->is('settings')) active @endif">Settings</a>
            </div>
            <div class="content">
                <div class="profile-header">
                    <h2>My Profile</h2>
                </div>
                <div class="profile-info">
                    <label for="name">Name:</label>
                    <p>{{ $user->name }}</p>
                </div>
                <div class="profile-info">
                    <label for="email">Email:</label>
                    <p>{{ $user->email }}</p>
                </div>
                <div class="profile-info">
                    <label for="role">Role:</label>
                    <p>{{ ucfirst($user->role) }}</p>
                </div>
                @if($address)
                <div class="profile-info">
                    <label for="address">Address:</label>
                    <p>Street: {{ $address->address_line1 }}</p>
                    <p>{{ $address->address_line2 }}</p>
                    <p>City: {{ $address->city }}</p>
                    <p>Postal Code: {{ $address->postal_code }}</p>
                    <p>Country: {{ $address->country }}</p>
                </div>
                @else
                <div class="profile-info">
                    <label for="address">Address:</label>
                    <p>No address available</p>
                </div>
                @endif
                <div class="edit-profile-link">
                    <a href="{{ url('/settings') }}">Edit Profile</a>
                </div>
            </div>
        </div>
        @include('footer')
    </div>
</body>

</html>
