<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation - TicketHub</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700;900&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
            background-color: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            width: 100%;
            max-width: 600px;
            padding: 20px;
            box-sizing: border-box;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            border-radius: 10px;
        }
        h1 {
            font-size: 32px;
            color: #333;
            margin-bottom: 20px;
        }
        p {
            font-size: 16px;
            color: #666;
            margin-bottom: 20px;
        }
        .cta-button {
            display: inline-block;
            padding: 15px 30px;
            font-size: 16px;
            background-color: #00911E;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }
        .cta-button:hover {
            background-color: #007e1a;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Order Confirmed!</h1>
        <p>Your order has been successfully placed.</p>
        <a href="{{ route('home') }}" class="btn btn-primary">Back to Events</a>
        </div>
</body>
</html>
