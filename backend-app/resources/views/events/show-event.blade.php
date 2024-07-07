<!-- resources/views/events/show-event.blade.php -->

@extends('layouts.app')

@section('content')
<div>
    <h1>{{ $event->name }}</h1>
    <div class="image-container">
        <div class="image-wrapper">
            <img src="{{ url('http://localhost:8001/storage/' . $event->thumbnail_image) }}" alt="Thumbnail" class="preview-image">
            <p>Thumbnail</p>
            <form action="{{ route('events.updateImage', [$event->id, 'thumbnail']) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <input type="file" name="image" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Change Thumbnail</button>
            </form>
        </div>
        <div class="image-wrapper">
            <img src="{{ url('http://localhost:8001/storage/' . $event->event_map_image) }}" alt="Event Map" class="preview-image">
            <p>Event Map</p>
            <form action="{{ route('events.updateImage', [$event->id, 'event_map']) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <input type="file" name="image" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Change Event Map</button>
            </form>
        </div>
    </div>
    <p>{{ $event->description }}</p>
    <p>Date: {{ $event->date }}</p>
    <p>Time: {{ $event->time }}</p>
    <p>Location: {{ $event->location }}</p>

    <h2>Tickets</h2>
    <a href="#" id="add-ticket-button" class="btn btn-primary">Add Ticket</a>
    <div id="ticket-form-container" style="display: none;">
        <form id="ticket-form" action="{{ route('events.storeTicket', $event->id) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="ticket_type">Ticket Type:</label>
                <input type="text" id="ticket_type" name="ticket_type" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="price">Price:</label>
                <input type="number" id="price" name="price" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="quantity">Quantity:</label>
                <input type="number" id="quantity" name="quantity" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Ticket</button>
        </form>
    </div>

    <div class="ticket-options">
        <label for="sort-tickets">Sort by:</label>
        <select id="sort-tickets" class="form-control">
            <option value="type">Type</option>
            <option value="price">Price</option>
            <option value="quantity">Quantity</option>
        </select>
        <form action="{{ route('tickets.destroyAll', $event->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete All Tickets</button>
        </form>
    </div>

    <table class="table ticket-table">
        <thead>
            <tr>
                <th>Type</th>
                <th>Price</th>
                <th>Available Quantity</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="ticket-list">
            @foreach ($groupedTickets as $ticketType => $ticketData)
                <tr class="ticket-item">
                    <td>{{ $ticketType }}</td>
                    <td>${{ $ticketData['price'] }}</td>
                    <td>{{ $ticketData['available_quantity'] }}</td>
                    <td>
                        <form action="{{ route('tickets.destroyAllByType', [$event->id, $ticketType, $ticketData['price']]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete All</button>
                        </form>
                        <form action="{{ route('tickets.destroyByType', [$event->id, $ticketType, $ticketData['price']]) }}" method="POST" style="display:inline;">
                            @csrf

                        </form>
                        <button class="btn btn-info" onclick="editTicket('{{ $ticketType }}', '{{ $ticketData['price'] }}', '{{ $ticketData['total_quantity'] }}')">Edit</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div id="edit-ticket-form-container" style="display: none;">
        <form id="edit-ticket-form" action="{{ route('tickets.update', $event->id) }}" method="POST">
            @csrf
            @method('PATCH')
            <input type="hidden" id="edit_ticket_type" name="ticket_type">
            <input type="hidden" id="edit_ticket_price" name="ticket_price">
            <div class="form-group">
                <label for="new_price">New Price:</label>
                <input type="number" id="new_price" name="new_price" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="new_quantity">New Quantity:</label>
                <input type="number" id="new_quantity" name="new_quantity" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Ticket</button>
        </form>
    </div>



    <a href="{{ route('events.index') }}" class="btn btn-secondary">Back to Events</a>
</div>
@endsection

<style>
.preview-image {
    width: 300px;
    height: 300px;
    object-fit: cover;
    margin: 10px;
}

.image-container {
    display: flex;
    justify-content: space-between;
}

.image-wrapper {
    text-align: center;
    width: 45%;
}

.btn-primary, .btn-secondary {
    display: inline-block;
    background-color: #007bff;
    color: #fff;
    padding: 10px 20px;
    text-align: center;
    text-decoration: none;
    border-radius: 5px;
    margin-top: 20px;
}

.btn-primary:hover {
    background-color: #0056b3;
}

.btn-secondary {
    background-color: #6c757d;
}

.btn-secondary:hover {
    background-color: #5a6268;
}

.btn-danger {
    background-color: #dc3545;
    color: #fff;
    border: none;
    padding: 5px 10px;
    cursor: pointer;
    border-radius: 5px;
}

.btn-danger:hover {
    background-color: #c82333;
}

.btn-info {
    background-color: #17a2b8;
    color: #fff;
    border: none;
    padding: 5px 10px;
    cursor: pointer;
    border-radius: 5px;
}

.btn-info:hover {
    background-color: #138496;
}

.form-group {
    margin-bottom: 15px;
}

.form-group label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
}

.form-group input {
    width: 100%;
    padding: 10px;
    box-sizing: border-box;
    border: 1px solid #ced4da;
    border-radius: 5px;
}

#ticket-form-container, #edit-ticket-form-container {
    margin-top: 20px;
    background-color: none;
    padding: 20px;
    border-radius: 5px;
}

.ticket-options {
    margin-top: 20px;
}

.ticket-table, .sold-ticket-table {
    width: 100%;
    margin-top: 20px;
    border-collapse: collapse;
}

.ticket-table th, .ticket-table td, .sold-ticket-table th, .sold-ticket-table td {
    border: 1px solid #ced4da;
    padding: 10px;
    text-align: left;
}

.ticket-table th, .sold-ticket-table th {
    background-color: none;
}

.ticket-table td, .sold-ticket-table td {
    background-color: none;
}

.ticket-list, .sold-ticket-list {
    margin-top: 20px;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('add-ticket-button').addEventListener('click', function() {
        var ticketFormContainer = document.getElementById('ticket-form-container');
        if (ticketFormContainer.style.display === 'none') {
            ticketFormContainer.style.display = 'block';
        } else {
            ticketFormContainer.style.display = 'none';
        }
    });

    document.getElementById('sort-tickets').addEventListener('change', function() {
        var sortValue = this.value;
        var ticketList = document.getElementById('ticket-list');
        var rows = Array.from(ticketList.querySelectorAll('.ticket-item'));

        rows.sort(function(a, b) {
            var aValue = a.querySelector(`td:nth-child(${getColumnIndex(sortValue)})`).innerText;
            var bValue = b.querySelector(`td:nth-child(${getColumnIndex(sortValue)})`).innerText;

            if (sortValue === 'price' || sortValue === 'quantity') {
                return parseFloat(aValue) - parseFloat(bValue);
            } else {
                return aValue.localeCompare(bValue);
            }
        });

        ticketList.innerHTML = '';
        rows.forEach(function(row) {
            ticketList.appendChild(row);
        });
    });

    function getColumnIndex(sortValue) {
        switch (sortValue) {
            case 'type': return 1;
            case 'price': return 2;
            case 'quantity': return 3;
        }
    }

    window.editTicket = function(ticketType, ticketPrice, ticketQuantity) {
        document.getElementById('edit_ticket_type').value = ticketType;
        document.getElementById('edit_ticket_price').value = ticketPrice;
        document.getElementById('new_price').value = ticketPrice;
        document.getElementById('new_quantity').value = ticketQuantity;

        var editTicketFormContainer = document.getElementById('edit-ticket-form-container');
        editTicketFormContainer.style.display = 'block';
    }
});
</script>
