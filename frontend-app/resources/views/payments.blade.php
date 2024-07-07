<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payments - TicketHub</title>
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

        .payment-section {
            margin-bottom: 20px;
        }

        .payment-section h3 {
            font-size: 20px;
            margin-bottom: 10px;
        }

        .payment-section p {
            font-size: 16px;
            color: #666;
        }

        .add-payment-option-container {
            margin-bottom: 20px;
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

        .info-bar {
            padding: 10px;
            background-color: #e0f3ff;
            border: 1px solid #b8e2ff;
            color: #0066cc;
            border-radius: 5px;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
        }

        .payment-option {
            display: flex;
            flex-direction: column;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 10px;
        }

        .payment-option .field {
            margin-bottom: 5px;
            font-size: 14px;
            color: #333;
        }

        .payment-option .field span {
            font-weight: bold;
        }

        .payment-option .actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        .payment-option .actions button {
            background-color: #dc3545;
            color: #fff;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 5px;
        }

        .payment-option .actions button:hover {
            background-color: #c82333;
        }

        .payment-option .actions .edit-btn {
            background-color: #007bff;
        }

        .payment-option .actions .edit-btn:hover {
            background-color: #0056b3;
        }

        .payment-form {
            display: none;
            margin-top: 10px;
        }

        .payment-form.active {
            display: block;
        }

        .payment-form input,
        .payment-form button {
            display: block;
            width: 100%;
            margin-bottom: 10px;
            padding: 8px;
            font-size: 14px;
        }

        .payment-form button {
            background-color: #00911E;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .payment-form button:hover {
            background-color: #007e1a;
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var addPaymentOptionButtons = document.querySelectorAll('.add-payment-option');
            var paymentForms = document.querySelectorAll('.payment-form');

            addPaymentOptionButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    var form = button.nextElementSibling;
                    form.classList.toggle('active');
                });
            });

            var editButtons = document.querySelectorAll('.edit-btn');
            var removeButtons = document.querySelectorAll('.remove-btn');

            editButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    var option = JSON.parse(button.dataset.details);
                    var form = button.closest('.payment-option').nextElementSibling;
                    form.classList.add('active');
                    form.querySelector('[name="details[card_number]"]').value = option.card_number;
                    form.querySelector('[name="details[expiry_date]"]').value = option.expiry_date;
                    form.querySelector('[name="details[cvv]"]').value = option.cvv;
                    form.querySelector('[name="details[cardholder_name]"]').value = option.cardholder_name;
                });
            });

            removeButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    var form = document.createElement('form');
                    form.method = 'POST';
                    form.action = button.dataset.action;
                    form.innerHTML = '@csrf @method("DELETE")';
                    document.body.appendChild(form);
                    form.submit();
                });
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
                <h2>Payments</h2>
                <div class="tabs">
                    <a href="#" class="active">Payment options</a>
                    <a href="#">Payouts</a>
                </div>
                <div class="payment-section">
                    <h3>Payment options for buying tickets</h3>
                    @foreach ($paymentOptions->where('for', 'buying') as $option)
                        @php
                            $details = json_decode($option->details, true);
                        @endphp
                        <div class="payment-option">
                            <div class="field"><span>Card Number:</span> {{ $details['card_number'] }}</div>
                            <div class="field"><span>Expiry Date:</span> {{ $details['expiry_date'] }}</div>
                            <div class="field"><span>Cardholder Name:</span> {{ $details['cardholder_name'] }}</div>
                            <div class="actions">
                                <button class="edit-btn" data-details="{{ $option->details }}">Edit</button>
                                <button class="remove-btn" data-action="{{ route('payments.destroy', $option->id) }}">Remove</button>
                            </div>
                        </div>
                        <div class="payment-form">
                            <form action="{{ route('payments.update', $option->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="for" value="buying">
                                <input type="hidden" name="type" value="card">
                                <label for="card_number">Card Number</label>
                                <input type="text" name="details[card_number]" required>
                                <label for="expiry_date">Expiry Date (MM/YY)</label>
                                <input type="text" name="details[expiry_date]" pattern="\d{2}/\d{2}" required>
                                <label for="cvv">CVV</label>
                                <input type="text" name="details[cvv]" pattern="\d{3}" required>
                                <label for="cardholder_name">Cardholder Name</label>
                                <input type="text" name="details[cardholder_name]" required>
                                <button type="submit">Update Payment Option</button>
                            </form>
                        </div>
                    @endforeach
                    <div class="add-payment-option-container">
                        <div class="add-payment-option">
                            <span>+</span>&nbsp;<span>Add new payment option</span>
                        </div>
                        <div class="payment-form">
                            <form action="{{ route('payments.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="for" value="buying">
                                <input type="hidden" name="type" value="card">
                                <label for="card_number">Card Number</label>
                                <input type="text" name="details[card_number]" required>
                                <label for="expiry_date">Expiry Date (MM/YY)</label>
                                <input type="text" name="details[expiry_date]" pattern="\d{2}/\d{2}" required>
                                <label for="cvv">CVV</label>
                                <input type="text" name="details[cvv]" pattern="\d{3}" required>
                                <label for="cardholder_name">Cardholder Name</label>
                                <input type="text" name="details[cardholder_name]" required>
                                <button type="submit">Add Payment Option</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="payment-section">
                    <h3>Payment options for selling tickets</h3>
                    @foreach ($paymentOptions->where('for', 'selling') as $option)
                        @php
                            $details = json_decode($option->details, true);
                        @endphp
                        <div class="payment-option">
                            <div class="field"><span>Card Number:</span> {{ $details['card_number'] }}</div>
                            <div class="field"><span>Expiry Date:</span> {{ $details['expiry_date'] }}</div>
                            <div class="field"><span>Cardholder Name:</span> {{ $details['cardholder_name'] }}</div>
                            <div class="actions">
                                <button class="edit-btn" data-details="{{ $option->details }}">Edit</button>
                                <button class="remove-btn" data-action="{{ route('payments.destroy', $option->id) }}">Remove</button>
                            </div>
                        </div>
                        <div class="payment-form">
                            <form action="{{ route('payments.update', $option->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="for" value="selling">
                                <input type="hidden" name="type" value="card">
                                <label for="card_number">Card Number</label>
                                <input type="text" name="details[card_number]" required>
                                <label for="expiry_date">Expiry Date (MM/YY)</label>
                                <input type="text" name="details[expiry_date]" pattern="\d{2}/\d{2}" required>
                                <label for="cvv">CVV</label>
                                <input type="text" name="details[cvv]" pattern="\d{3}" required>
                                <label for="cardholder_name">Cardholder Name</label>
                                <input type="text" name="details[cardholder_name]" required>
                                <button type="submit">Update Payment Method</button>
                            </form>
                        </div>
                    @endforeach
                    <div class="add-payment-option-container">
                        <div class="add-payment-option">
                            <span>+</span>&nbsp;<span>Add new payment method</span>
                        </div>
                        <div class="payment-form">
                            <form action="{{ route('payments.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="for" value="selling">
                                <input type="hidden" name="type" value="card">
                                <label for="card_number">Card Number</label>
                                <input type="text" name="details[card_number]" required>
                                <label for="expiry_date">Expiry Date (MM/YY)</label>
                                <input type="text" name="details[expiry_date]" pattern="\d{2}/\d{2}" required>
                                <label for="cvv">CVV</label>
                                <input type="text" name="details[cvv]" pattern="\d{3}" required>
                                <label for="cardholder_name">Cardholder Name</label>
                                <input type="text" name="details[cardholder_name]" required>
                                <button type="submit">Add Payment Method</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('footer')
    </div>
</body>

</html>
