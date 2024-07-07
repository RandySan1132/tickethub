<!-- resources/views/orders.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">All Orders</h1>
        <a href="{{ route('dashboard') }}" class="btn btn-secondary">Back to Dashboard</a>
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
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
                        <td>{{ $order->user->name }}</td>
                        <td>{{ $order->listing->event->name }}</td>
                        <td>{{ $order->listing->ticket_type }}</td>
                        <td>{{ $order->quantity }}</td>
                        <td>${{ number_format($order->price, 2) }}</td>
                        <td>${{ number_format($order->quantity * $order->price, 2) }}</td>
                        <td>
                            <span class="badge badge-{{ $order->status === 'completed' ? 'success' : 'warning' }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>
                        <td>{{ $order->paymentOption->type }}</td>
                        <td>{{ $order->created_at->format('Y-m-d H:i:s') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('styles')
<style>
    .container {
        margin-top: 30px;
    }

    h1 {
        font-size: 2rem;
        font-weight: bold;
    }

    .table-responsive {
        margin-top: 20px;
    }

    .table {
        width: 100%;
        margin-bottom: 1rem;
        color: #212529;
    }

    .table th,
    .table td {
        padding: 1rem;
        vertical-align: top;
        border-top: 1px solid #dee2e6;
    }

    .table thead th {
        vertical-align: bottom;
        border-bottom: 2px solid #dee2e6;
    }

    .table tbody + tbody {
        border-top: 2px solid #dee2e6;
    }

    .badge-success {
        background-color: #28a745;
    }

    .badge-warning {
        background-color: #ffc107;
    }
</style>
@endsection
