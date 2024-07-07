<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Listings - TicketHub</title>
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
            background-color: #fff;
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

        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0,0,0);
            background-color: rgba(0,0,0,0.4);
            padding-top: 60px;
        }

        .modal-content {
            background-color: #fff;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 600px;
            border-radius: 10px;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .modal label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #333;
        }

        .modal input, .modal select {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .modal button {
            padding: 10px 20px;
            background-color: #00911E;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .modal button:hover {
            background-color: #007e1a;
        }

    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var tabs = document.querySelectorAll('.tabs a');
            tabs.forEach(function(tab) {
                tab.addEventListener('mouseover', function() {
                    this.style.backgroundColor = '#007e1a';
                    this.style.color = '#fff';
                });
                tab.addEventListener('mouseout', function() {
                    if (!this.classList.contains('active')) {
                        this.style.backgroundColor = '';
                        this.style.color = '#666';
                    }
                });
            });

            tabs.forEach(function(tab) {
                tab.addEventListener('click', function(event) {
                    event.preventDefault();
                    tabs.forEach(function(t) {
                        t.classList.remove('active');
                        t.style.backgroundColor = '';
                        t.style.color = '#666';
                    });
                    this.classList.add('active');
                    this.style.backgroundColor = '#00911E';
                    this.style.color = '#fff';

                    var tabContent = document.querySelectorAll('.tab-content');
                    tabContent.forEach(function(content) {
                        content.style.display = 'none';
                    });
                    document.querySelector(this.getAttribute('href')).style.display = 'block';
                });
            });

            // Show active tab content on page load
            document.querySelector('.tabs a.active').click();

            var editButtons = document.querySelectorAll('.edit-button');
            var modal = document.getElementById('editModal');
            var closeBtn = document.getElementsByClassName('close')[0];

            editButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    var listingId = this.getAttribute('data-id');
                    var listingPrice = this.getAttribute('data-price');
                    var listingQuantity = this.getAttribute('data-quantity');

                    document.getElementById('edit-listing-id').value = listingId;
                    document.getElementById('edit-price').value = listingPrice;
                    document.getElementById('edit-quantity').value = listingQuantity;

                    modal.style.display = 'block';
                });
            });

            closeBtn.onclick = function() {
                modal.style.display = 'none';
            }

            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = 'none';
                }
            }
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
                <h2>My Listings</h2>
                <div class="tabs">
                    <a href="#active" class="active">Active</a>
                    <a href="#sold">Sold</a>
                </div>

                <div id="active" class="tab-content">
                    <div class="listings">
                        @if($activeListings->isEmpty())
                            <p>You don't have any active listings</p>
                        @else
                            <table>
                                <thead>
                                    <tr>
                                        <th>Event Name</th>
                                        <th>Location</th>
                                        <th>Event Date</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($activeListings as $listing)
                                        <tr>
                                            <td>{{ $listing->event->name }}</td>
                                            <td>{{ $listing->event->location }}</td>
                                            <td>{{ $listing->event->date }}</td>
                                            <td>{{ $listing->quantity }}</td>
                                            <td>{{ $listing->price }}</td>
                                            <td>{{ ucfirst($listing->status) }}</td>
                                            <td>
                                                <button class="edit-button" 
                                                        data-id="{{ $listing->id }}" 
                                                        data-price="{{ $listing->price }}" 
                                                        data-quantity="{{ $listing->quantity }}" 
                                                        >
                                                    Edit
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>

                <div id="sold" class="tab-content">
                    <div class="listings">
                        @if($soldListings->isEmpty())
                            <p>You don't have any sold listings</p>
                        @else
                            <table>
                                <thead>
                                    <tr>
                                        <th>Event Name</th>
                                        <th>Location</th>
                                        <th>Event Date</th>
                                        <th>Quantity Sold</th>
                                        <th>Price</th>
                                        <th>Buyer</th>
                                        <th>Date Sold</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($soldListings as $listing)
                                        @if($listing->orders->isEmpty())
                                            <tr>
                                                <td colspan="8">No orders found for this listing.</td>
                                            </tr>
                                        @else
                                            @foreach($listing->orders as $order)
                                                <tr>
                                                    <td>{{ $listing->event->name }}</td>
                                                    <td>{{ $listing->event->location }}</td>
                                                    <td>{{ $listing->event->date }}</td>
                                                    <td>{{ $order->quantity }}</td>
                                                    <td>{{ $order->price }}</td>
                                                    <td>{{ $order->user->name }}</td>
                                                    <td>{{ $order->created_at->format('Y-m-d') }}</td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>

            </div>
        </div>
        @include('footer')
    </div>

    <!-- The Modal -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Edit Listing</h2>
            <form id="editForm" action="{{ route('my-listings.update') }}" method="POST">
                @csrf
                <input type="hidden" name="listing_id" id="edit-listing-id">
                <label for="edit-price">Price</label>
                <input type="text" name="price" id="edit-price" required>

                <label for="edit-quantity">Quantity</label>
                <input type="text" name="quantity" id="edit-quantity" required>



                <button type="submit">Update Listing</button>
            </form>
        </div>
    </div>
</body>

</html>
