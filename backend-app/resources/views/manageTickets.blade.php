<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Tickets</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700;900&display=swap" rel="stylesheet">
</head>

<body>
    <div class="container">
        <header>
            <h1>Manage Tickets for {{ $event->name }}</h1>
        </header>
        <main>
            @if ($errors->any())
                <div>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('tickets.store', $event->id) }}" method="POST">
                @csrf
                <label for="type">Ticket Type:</label>
                <input type="text" id="type" name="type" required>

                <label for="price">Price:</label>
                <input type="number" id="price" name="price" required>

                <label for="seat_number">Seat Number:</label>
                <input type="number" id="seat_number" name="seat_number" required>
                
                <button type="submit">Add Ticket</button>
            </form>

            <h2>Existing Tickets</h2>
            <table>
                <thead>
                    <tr>
                        <th>Type</th>
                        <th>Price</th>
                        <th>Seat Number</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tickets as $ticket)
                    <tr>
                        <td>{{ $ticket->type }}</td>
                        <td>{{ $ticket->price }}</td>
                        <td>{{ $ticket->seat_number }}</td>
                        <td>
                            <form action="{{ route('tickets.destroy', $ticket->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </main>
    </div>
</body>

</html>
