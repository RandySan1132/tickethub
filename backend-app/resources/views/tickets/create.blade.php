<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Ticket</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700;900&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #fff;
            padding: 20px 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            width: 100%;
        }

        header h1 {
            margin-bottom: 20px;
            font-size: 1.8em;
            text-align: center;
            color: #007bff;
        }

        main {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        label {
            font-weight: 700;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="number"] {
            padding: 10px;
            border: 1px solid #ced4da;
            border-radius: 5px;
            font-size: 1em;
            width: 100%;
        }

        button {
            background-color: #007bff;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 5px;
            font-size: 1em;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #0056b3;
        }

        .error-container {
            background-color: #f8d7da;
            color: #721c24;
            padding: 10px;
            border: 1px solid #f5c6cb;
            border-radius: 5px;
        }

        .error-container ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        .error-container ul li {
            margin: 5px 0;
        }
    </style>
</head>

<body>
    <div class="container">
        <header>
            <h1>Create Ticket for {{ $event->name }}</h1>
        </header>
        <main>
            @if ($errors->any())
                <div class="error-container">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('tickets.store', $event->id) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="ticket_type">Ticket Type:</label>
                    <input type="text" id="ticket_type" name="ticket_type" required>
                </div>
                <div class="form-group">
                    <label for="price">Price:</label>
                    <input type="number" id="price" name="price" required>
                </div>
                <div class="form-group">
                    <label for="seats">Number of Seats:</label>
                    <input type="number" id="seats" name="seats" required>
                </div>
                <button type="submit">Create Ticket</button>
            </form>
        </main>
    </div>
</body>

</html>
