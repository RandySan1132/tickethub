@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4 text-center" style="color: white;">Sales Analytics Dashboard</h1>
    <div class="Dash" style="width: 1080px; height: 296px; position: relative; margin-bottom: 50px;">
        <div class="Vector" style="width: 1080px; height: 296px; left: 0px; top: 0px; position: absolute; background: #282828; border-radius: 10px;"></div>
        <div class="Insights" style="left: 219px; top: 35.50px; position: absolute; color: white; font-size: 20px; font-family: Source Sans Pro; font-weight: 700; word-wrap: break-word">Insights</div>

        <div class="Group" style="width: 48px; height: 48px; left: 218px; top: 92px; position: absolute">
            <div class="Vector" style="width: 48px; height: 48px; left: 0px; top: 0px; position: absolute; background: #1BD938; border-radius: 50%;"></div>
            <div class="Frame" style="width: 48px; height: 48px; left: 0px; top: 0px; position: absolute">
                <img src="{{ asset('images/tickets-sold.png') }}" alt="Tickets Sold" style="width: 48px; height: 48px; object-fit: cover; border-radius: 50%;">
            </div>
        </div>
        <div class="TotalOrders" style="left: 219px; top: 155px; position: absolute; color: white; font-size: 20px; font-family: Source Sans Pro; font-weight: 700; word-wrap: break-word">Total Orders</div>
        <div style="left: 219px; top: 177px; position: absolute; color: white; font-size: 48px; font-family: Source Sans Pro; font-weight: 700; word-wrap: break-word">{{ $totalOrders }}</div>

        <div class="Group" style="width: 48px; height: 48px; left: 493px; top: 92px; position: absolute">
            <div class="Vector" style="width: 48px; height: 48px; left: 0px; top: 0px; position: absolute; background: #1BD938; border-radius: 50%;"></div>
            <div class="Frame" style="width: 48px; height: 48px; left: 0px; top: 0px; position: absolute">
                <img src="{{ asset('images/total-revenue.png') }}" alt="Total Revenue" style="width: 48px; height: 48px; object-fit: cover; border-radius: 50%;">
            </div>
        </div>
        <div class="TotalSales" style="left: 480px; top: 155px; position: absolute; color: white; font-size: 20px; font-family: Source Sans Pro; font-weight: 700; word-wrap: break-word">Total Sales</div>
        <div class="27600" style="left: 448px; top: 177px; position: absolute; color: white; font-size: 48px; font-family: Source Sans Pro; font-weight: 700; word-wrap: break-word">${{ number_format($totalSales, 2) }}</div>

        <div class="Group" style="width: 48px; height: 48px; left: 769px; top: 92px; position: absolute">
            <div class="Vector" style="width: 48px; height: 48px; left: 0px; top: 0px; position: absolute; background: #1BD938; border-radius: 50%;"></div>
            <div class="Frame" style="width: 48px; height: 48px; left: 0px; top: 0px; position: absolute">
                <img src="{{ asset('images/net-balance.png') }}" alt="Net Balance" style="width: 48px; height: 48px; object-fit: cover; border-radius: 50%;">
            </div>
        </div>
        <div class="TicketsSold" style="left: 770px; top: 155px; position: absolute; color: white; font-size: 20px; font-family: Source Sans Pro; font-weight: 700; word-wrap: break-word">Tickets Sold</div>
        <div style="left: 770px; top: 177px; position: absolute; color: white; font-size: 48px; font-family: Source Sans Pro; font-weight: 700; word-wrap: break-word">{{ $totalTicketsSold }}</div>
    </div>

    <div class="card mb-4">
        <div class="card-header bg-dark text-white">
            Sales by Event
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>Event</th>
                            <th>Total Sales</th>
                            <th>Total Orders</th>
                            <th>Total Tickets Sold</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($salesByEvent as $event)
                            <tr>
                                <td>{{ $event->name }}</td>
                                <td>${{ number_format($event->total_sales, 2) }}</td>
                                <td>{{ $event->total_orders }}</td>
                                <td>{{ $event->total_tickets_sold }}</td>
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
    padding: 15px;
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
    font-weight: bold;
    font-size: 20px;
}

.card-body {
    padding: 20px;
    text-align: center;
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
    background-color: #f1f1f1;
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
