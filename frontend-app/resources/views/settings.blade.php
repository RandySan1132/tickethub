<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TicketHub - Settings</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700;900&display=swap" rel="stylesheet">
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

        .tabs {
            display: flex;
            margin-bottom: 20px;
        }

        .tabs button {
            background: none;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 16px;
        }

        .tabs button.active {
            background-color: #00911E;
            color: white;
            border-radius: 5px;
        }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
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

        .edit-icon {
            margin-left: 10px;
            cursor: pointer;
            color: #00911E;
        }

        .edit-field {
            display: none;
            margin-bottom: 10px;
        }

        .edit-field input {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
            margin-bottom: 10px;
        }

        .edit-buttons {
            text-align: right;
        }

        .styled-button {
            background-color: #00911E;
            color: white;
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

        .delete-button {
            background-color: #D9534F;
        }

        .delete-button:hover {
            background-color: #C9302C;
        }

        .delete-button:active {
            background-color: #AC2925;
        }

        .toggle-switch {
            position: relative;
            display: inline-block;
            width: 34px;
            height: 20px;
        }

        .toggle-switch input {
            display: none;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: 0.4s;
            border-radius: 34px;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 12px;
            width: 12px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            transition: 0.4s;
            border-radius: 50%;
        }

        input:checked + .slider {
            background-color: #00911E;
        }

        input:checked + .slider:before {
            transform: translateX(14px);
        }

        .delete-account-link {
            color: #00911E;
            cursor: pointer;
            display: block;
            margin: 10px 0;
            text-decoration: none;
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0, 0, 0);
            background-color: rgba(0, 0, 0, 0.4);
            padding-top: 60px;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 400px;
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
                    <h2>Settings</h2>
                </div>

                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                <div class="tabs">
                    <button class="tab-button active" data-tab="contact">Contact</button>
                    <button class="tab-button" data-tab="addresses">Addresses</button>
                </div>
                <div id="contact" class="tab-content active">
                    <form action="{{ route('settings.update') }}" method="POST" id="settings-form">
                        @csrf
                        @method('PUT')
                        <div class="profile-info">
                            <label for="name">Full Name</label>
                            <p id="name-display">{{ $user->name }} <span class="edit-icon" data-field="name">✏️</span></p>
                            <div class="edit-field" id="edit-name" style="display:none;">
                                <input type="text" name="name" id="name" value="{{ $user->name }}">
                            </div>
                        </div>
                        <div class="profile-info">
                            <label for="email">Email Address</label>
                            <p id="email-display">{{ $user->email }} <span class="edit-icon" data-field="email">✏️</span></p>
                            <div class="edit-field" id="edit-email" style="display:none;">
                                <input type="email" name="email" id="email" value="{{ $user->email }}">
                            </div>
                        </div>
                        <div class="profile-info">
                            <label for="password">Password</label>
                            <p>******** <span class="edit-icon" data-field="password">✏️</span></p>
                            <div class="edit-field" id="edit-password" style="display:none;">
                                <input type="password" name="password" id="password" placeholder="New Password">
                                <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password">
                            </div>
                        </div>
                        <div class="edit-buttons">
                            <button type="button" class="styled-button" id="save-button">Save Changes</button>
                        </div>
                    </form>
                    <a class="delete-account-link" href="#">Delete My Account</a>
                </div>
                <div id="addresses" class="tab-content">
                    <h2>Addresses</h2>
                    @if($address)
                        <form action="{{ route('addresses.update', $address) }}" method="POST">
                            @csrf
                            <div class="profile-info">
                                <label for="address_line1">Address Line 1</label>
                                <input type="text" name="address_line1" id="address_line1" value="{{ $address->address_line1 }}">
                            </div>
                            <div class="profile-info">
                                <label for="address_line2">Address Line 2</label>
                                <input type="text" name="address_line2" id="address_line2" value="{{ $address->address_line2 }}">
                            </div>
                            <div class="profile-info">
                                <label for="city">City</label>
                                <input type="text" name="city" id="city" value="{{ $address->city }}">
                            </div>
                            <div class="profile-info">
                                <label for="postal_code">Postal Code</label>
                                <input type="text" name="postal_code" id="postal_code" value="{{ $address->postal_code }}">
                            </div>
                            <div class="profile-info">
                                <label for="country">Country</label>
                                <input type="text" name="country" id="country" value="{{ $address->country }}">
                            </div>
                            <div class="edit-buttons">
                                <button type="submit" class="styled-button">Save Changes</button>
                            </div>
                        </form>
                        <form action="{{ route('addresses.destroy', $address) }}" method="POST" style="margin-top: 10px;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="styled-button delete-button">Delete</button>
                        </form>
                    @else
                        <p>No address found. Add a new address below.</p>
                        <form action="{{ route('addresses.store') }}" method="POST">
                            @csrf
                            <div class="profile-info">
                                <label for="address_line1">Address Line 1</label>
                                <input type="text" name="address_line1" id="address_line1">
                            </div>
                            <div class="profile-info">
                                <label for="address_line2">Address Line 2</label>
                                <input type="text" name="address_line2" id="address_line2">
                            </div>
                            <div class="profile-info">
                                <label for="city">City</label>
                                <input type="text" name="city" id="city">
                            </div>
                            <div class="profile-info">
                                <label for="state">State</label>
                                <input type="text" name="state" id="state">
                            </div>
                            <div class="profile-info">
                                <label for="postal_code">Postal Code</label>
                                <input type="text" name="postal_code" id="postal_code">
                            </div>
                            <div class="profile-info">
                                <label for="country">Country</label>
                                <input type="text" name="country" id="country">
                            </div>
                            <div class="edit-buttons">
                                <button type="submit" class="styled-button">Add Address</button>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
        @include('footer')
    </div>

    <!-- Password Confirmation Modal -->
    <div id="passwordModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Confirm Password</h2>
            <p>Please enter your password to confirm changes:</p>
            <input type="password" id="confirmation-password" placeholder="Password">
            <button id="confirm-password-button" class="styled-button">Confirm</button>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const tabButtons = document.querySelectorAll('.tab-button');
            const tabContents = document.querySelectorAll('.tab-content');
            const editIcons = document.querySelectorAll('.edit-icon');
            const saveButton = document.getElementById('save-button');
            const form = document.getElementById('settings-form');
            const modal = document.getElementById('passwordModal');
            const closeModal = document.querySelector('.close');
            const confirmPasswordButton = document.getElementById('confirm-password-button');

            tabButtons.forEach(button => {
                button.addEventListener('click', function () {
                    tabButtons.forEach(btn => btn.classList.remove('active'));
                    this.classList.add('active');

                    tabContents.forEach(content => content.classList.remove('active'));
                    const tab = this.getAttribute('data-tab');
                    document.getElementById(tab).classList.add('active');
                });
            });

            editIcons.forEach(icon => {
                icon.addEventListener('click', function () {
                    const field = this.getAttribute('data-field');
                    document.getElementById(`edit-${field}`).style.display = 'block';
                    document.getElementById(`${field}-display`).style.display = 'none';
                });
            });

            saveButton.addEventListener('click', function (event) {
                event.preventDefault();
                modal.style.display = 'block';
            });

            closeModal.addEventListener('click', function () {
                modal.style.display = 'none';
            });

            window.onclick = function (event) {
                if (event.target === modal) {
                    modal.style.display = 'none';
                }
            };

            confirmPasswordButton.addEventListener('click', function () {
                const password = document.getElementById('confirmation-password').value;
                const xhr = new XMLHttpRequest();
                xhr.open('POST', '{{ route('password.confirm') }}', true);
                xhr.setRequestHeader('Content-Type', 'application/json;charset=UTF-8');
                xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        const response = JSON.parse(xhr.responseText);
                        if (response.success) {
                            modal.style.display = 'none';
                            form.submit();
                        } else {
                            alert('Incorrect password. Please try again.');
                        }
                    }
                };
                xhr.send(JSON.stringify({ password: password }));
            });
        });
    </script>
</body>

</html>
