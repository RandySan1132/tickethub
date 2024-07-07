<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sell Tickets for {{ $event->name }} - TicketHub</title>
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
            padding: 0 20px;
            box-sizing: border-box;
        }

        h1 {
            font-size: 32px;
            margin-bottom: 10px;
            text-align: center;
            color: #333;
        }

        .event-details {
            text-align: center;
        }

        .event-details img {
            width: 100%;
            max-width: 600px;
            height: auto;
            margin: 20px 0;
        }

        .form-container {
            margin-top: 20px;
            display: flex;
            justify-content: center;
        }

        .form-container form {
            width: 100%;
            max-width: 600px;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .form-container form input[type="text"],
        .form-container form input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
        }

        .form-container form button {
            width: 100%;
            padding: 15px;
            font-size: 16px;
            background-color: #00911E;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .form-container form button:hover {
            background-color: #007e1a;
        }

        .alert-success {
            color: #155724;
            background-color: #d4edda;
            border-color: #c3e6cb;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">
        @include('header')

        <h1>Sell Tickets for {{ $event->name }}</h1>
        <div class="event-details">
            <img src="http://localhost:8001/storage/{{ $event->thumbnail_image }}" alt="{{ $event->name }}">
            <p>{{ $event->description }}</p>
            <p><strong>Date:</strong> {{ $event->date }}</p>
            <p><strong>Time:</strong> {{ $event->time }}</p>
            <p><strong>Location:</strong> {{ $event->location }}</p>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="form-container">
            <form action="{{ route('listings.store') }}" method="POST">
                @csrf
                <input type="hidden" name="event_id" value="{{ $event->id }}">
                <div>
                    <label for="ticket_type">Ticket Type:</label>
                    <input type="text" id="ticket_type" name="ticket_type" required>
                </div>
                <div>
                    <label for="price">Price:</label>
                    <input type="number" id="price" name="price" required>
                </div>
                <div>
                    <label for="quantity">Quantity:</label>
                    <input type="number" id="quantity" name="quantity" required>
                </div>
                <button type="submit">List Tickets</button>
            </form>
        </div>

        @include('footer')
    </div>
</body>

</html>
