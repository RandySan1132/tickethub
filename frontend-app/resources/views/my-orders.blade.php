<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders - TicketHub</title>
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
            padding: 20px;
            box-sizing: border-box;
        }

        .main-content {
            display: flex;
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

        h1, h2 {
            font-size: 32px;
            margin-bottom: 20px;
            text-align: left;
            color: #333;
        }

        .info-bar {
            padding: 10px;
            background-color: #e0f3ff;
            border: 1px solid #b8e2ff;
            color: #0066cc;
            border-radius: 5px;
            margin-bottom: 20px;
            display: flex;
            justify-content: center;
        }

        .orders-section {
            display: block;
        }

        .orders-section table {
            width: 100%;
            border-collapse: collapse;
        }

        .orders-section th,
        .orders-section td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        .orders-section th {
            background-color: #f9f9f9;
        }

        .add-payment-option {
            display: flex;
            align-items: center;
            color: #00911E;
            cursor: pointer;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .add-payment-option:hover {
            text-decoration: underline;
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
                <h2>Orders</h2>
                <div class="orders-section">
                    <h3>Orders</h3>
                    @if($pastOrders->isEmpty())
                        <p>You don't have any orders</p>
                    @else
                        <table>
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Event Name</th>
                                    <th>Date</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pastOrders as $order)
                                    <tr>
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->listing->event->name }}</td>
                                        <td>{{ $order->created_at->format('Y-m-d') }}</td>
                                        <td>{{ $order->quantity }}</td>
                                        <td>{{ $order->price }}</td>
                                        <td>{{ ucfirst($order->status) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
        @include('footer')
    </div>
</body>

</html>
