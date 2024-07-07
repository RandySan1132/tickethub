<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Sales - TicketHub</title>
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

        .summary-boxes {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .summary-box {
            flex: 1;
            background-color: #00911E;
            color: #fff;
            padding: 20px;
            margin: 0 10px;
            text-align: center;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .summary-box h3 {
            margin: 0;
            font-size: 24px;
        }

        .summary-box p {
            margin: 5px 0 0;
            font-size: 18px;
        }

        .chart-container {
            margin-top: 20px;
        }

        .chart {
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 50px;
        }

        .chart-title {
            font-size: 24px;
            margin-bottom: 20px;
            text-align: center;
        }

        h1,
        h2 {
            font-size: 32px;
            margin-bottom: 20px;
            text-align: left;
            color: #333;
        }

        .tabs {
            display: flex;
            justify-content: flex-start;
            margin-bottom: 20px;
            gap: 0;
        }

        .tabs a {
            padding: 8px 15px;
            text-decoration: none;
            color: #666;
            border: 1px solid #ddd;
            border-radius: 5px 5px 0 0;
            margin: 0;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .tabs a.active {
            background-color: #00911E;
            color: #fff;
            border-bottom: 1px solid transparent;
        }

        .tabs a:hover {
            background-color: #007e1a;
            color: #fff;
        }

        .search-bar {
            display: flex;
            justify-content: flex-start;
            margin-bottom: 20px;
        }

        .search-bar input {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 5px 0 0 5px;
            width: 300px;
            max-width: 100%;
        }

        .search-bar button {
            padding: 10px 20px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-left: none;
            background-color: #00911E;
            color: #fff;
            border-radius: 0 5px 5px 0;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .search-bar button:hover {
            background-color: #007e1a;
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

        .listings {
            text-align: center;
        }

        .listings table {
            width: 100%;
            border-collapse: collapse;
        }

        .listings th,
        .listings td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        .listings th {
            background-color: #f9f9f9;
        }

        .filters {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .filters .sort-by {
            display: flex;
            align-items: center;
        }

        .filters select {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .filters label {
            font-size: 14px;
            color: #666;
            margin-right: 10px;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var tabs = document.querySelectorAll('.tabs a');
            tabs.forEach(function (tab) {
                tab.addEventListener('mouseover', function () {
                    this.style.backgroundColor = '#007e1a';
                    this.style.color = '#fff';
                });
                tab.addEventListener('mouseout', function () {
                    if (!this.classList.contains('active')) {
                        this.style.backgroundColor = '';
                        this.style.color = '#666';
                    }
                });
            });

            tabs.forEach(function (tab) {
                tab.addEventListener('click', function () {
                    tabs.forEach(function (t) {
                        t.classList.remove('active');
                        t.style.backgroundColor = '';
                        t.style.color = '#666';
                    });
                    this.classList.add('active');
                    this.style.backgroundColor = '#00911E';
                    this.style.color = '#fff';
                });
            });

            // Sample sales data for the chart
            var salesData = {
                labels: @json($salesData['labels']),
                datasets: [{
                    label: 'Sales Over Time',
                    data: @json($salesData['data']),
                    backgroundColor: 'rgba(0, 145, 30, 0.5)',
                    borderColor: 'rgba(0, 145, 30, 1)',
                    borderWidth: 1
                }]
            };

            var ctx = document.getElementById('salesChart').getContext('2d');
            var salesChart = new Chart(ctx, {
                type: 'line',
                data: salesData,
                options: {
                    responsive: true,
                    scales: {
                        x: {
                            beginAtZero: true
                        },
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
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
            <h2>My Sales</h2>

                <div class="summary-boxes">
                    <div class="summary-box">
                        <h3>Total Sales</h3>
                        <p>${{ $totalSales }}</p>
                    </div>
                    <div class="summary-box">
                        <h3>Total Orders</h3>
                        <p>{{ $totalOrders }}</p>
                    </div>
                    <div class="summary-box">
                        <h3>Tickets Sold</h3>
                        <p>{{ $ticketsSold }}</p>
                    </div>
                </div>
                <div class="chart-container">
                    <div class="chart">
                        <div class="chart-title">Sales Over Time</div>
                        <canvas id="salesChart"></canvas>
                    </div>
                </div>

                <div class="listings">
                    @if($sales->isEmpty())
                        <p>You don't have any sales</p>
                    @else
                        <table>
                            <thead>
                                <tr>
                                    <th>Event Name</th>
                                    <th>Order ID</th>
                                    <th>Buyer</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($sales as $sale)
                                    <tr>
                                        <td>{{ $sale->listing->event->name }}</td>
                                        <td>{{ $sale->id }}</td>
                                        <td>{{ $sale->user->name }}</td>
                                        <td>{{ $sale->quantity }}</td>
                                        <td>{{ $sale->price }}</td>
                                        <td>{{ ucfirst($sale->status) }}</td>
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
