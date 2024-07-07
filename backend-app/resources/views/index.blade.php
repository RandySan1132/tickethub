@extends('layouts.app')

@section('content')
<div>
    <h1>All Events</h1>
    <button onclick="window.location.href='{{ route('events.create') }}'" class="btn btn-primary">Add an Event</button>
    <div class="events-grid" style="display: flex; flex-wrap: wrap; gap: 20px; margin-top: 20px;">
        @foreach($events as $event)
        <div class="event-box">
            <p style="font-weight: bold;">{{ $event->name }}</p>
            <p>Date: {{ $event->date }}</p>
            <p>Time: {{ $event->time }}</p>
            <p>Location: {{ $event->location }}</p>
            <div class="event-actions">
                <a href="{{ route('events.show', $event->id) }}" class="btn">View</a>
                <form action="{{ route('events.destroy', $event->id) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn delete" onclick="return confirm('Are you sure you want to delete this event?')">Delete</button>
                </form>
            </div>
        </div>
        @endforeach
    </div>

</div>
@endsection

<style>
    .event-actions .btn {
        display: inline-block;
        padding: 0px 10px;
        text-decoration: none;
        margin-right: 10px;
        text-align: center;
        line-height: 40px;
        
    }

</style>