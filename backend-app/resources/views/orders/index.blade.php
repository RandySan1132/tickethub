@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4" style="color: white;">Orders Dashboard</h1>
    <div class="card mb-4">

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>Order ID</th>
                            <th>User</th>
                            <th>Event</th>
                            <th>Ticket Type</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Total Price</th>
                            <th>Status</th>
                            <th>Payment Type</th>
                            <th>Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->user ? $order->user->name : 'N/A' }}</td>
                                <td>{{ $order->listing && $order->listing->event ? $order->listing->event->name : 'N/A' }}</td>
                                <td>{{ $order->listing ? $order->listing->ticket_type : 'N/A' }}</td>
                                <td>{{ $order->quantity }}</td>
                                <td>${{ number_format($order->price, 2) }}</td>
                                <td>${{ number_format($order->quantity * $order->price, 2) }}</td>
                                <td>{{ ucfirst($order->status) }}</td>
                                <td>{{ $order->paymentOption ? $order->paymentOption->type : 'N/A' }}</td>
                                <td>{{ $order->created_at->format('Y-m-d H:i:s') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

<style>
.container {
    max-width: 1200px;
    margin: 20px auto;
    padding: 20px;
}

.card {
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

.card-header {
    background-color: #007bff;
    color: white;
    padding: 15px;
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
}

.table {
    margin-top: 20px;
}

.table thead {
    background-color: #343a40;
    color: white;
}

.table td, .table th {
    vertical-align: middle;
    padding: 12px 15px;
}

.table-hover tbody tr:hover {
    background-color: green;
}

.table-responsive {
    padding: 10px;
    border-radius: 5px;
    background-color: none;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

h1 {
    font-size: 2.5rem;
    margin-bottom: 20px;
    color: #333;
    text-shadow: 1px 1px 2px rgba(0,0,0,0.1);
}

</style>
