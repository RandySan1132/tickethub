@extends('layouts.app')

@section('content')
<div class="form-container">
    <h1>Create Event</h1>
    @if ($errors->any())
        <div class="error-container">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
                @foreach (session('errors') as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="image-container">
            <div class="form-group">
                <label for="thumbnail_image">Thumbnail Image:</label>
                <input type="file" id="thumbnail_image" name="thumbnail_image" class="form-control" accept="image/*" required>
                <img id="thumbnail_preview" src="#" alt="Thumbnail Preview" class="image-preview">
            </div>

            <div class="form-group">
    <label for="event_map_image">Event Map Image:</label>
    <input type="file" id="event_map_image" name="event_map_image" class="form-control" accept="image/*" required>
    <img id="event_map_preview" src="#" alt="Event Map Preview" class="image-preview">
</div>

        </div>

        <div class="main-container">
            <div class="details-container">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea id="description" name="description" class="form-control" required></textarea>
                </div>

                <div class="form-group">
                    <label for="location">Location:</label>
                    <input type="text" id="location" name="location" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="category">Category:</label>
                    <select id="category" name="category" class="form-control" required>
                        <option value="Sports">Sports</option>
                        <option value="Concerts">Concerts</option>
                        <option value="Theater">Theater</option>
                        <option value="Festivals">Festivals</option>
                    </select>
                </div>
            </div>

            <div class="date-time-container">
                <div class="form-group">
                    <label for="date">Date:</label>
                    <input type="date" id="date" name="date" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="time">Time:</label>
                    <input type="time" id="time" name="time" class="form-control" required>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Create Event</button>
    </form>
</div>
@endsection

<head>
    <!-- Other head content -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
</head>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        flatpickr("#date", {
            dateFormat: "Y-m-d",
            altInput: true,
            altFormat: "F j, Y"
        });
        flatpickr("#time", {
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            time_24hr: true
        });

        // Thumbnail preview
        document.getElementById('thumbnail_image').addEventListener('change', function() {
            var file = this.files[0];
            if (file) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('thumbnail_preview').src = e.target.result;
                    document.getElementById('thumbnail_preview').style.display = 'block';
                }
                reader.readAsDataURL(file);
            }
        });

        // Event map preview
        document.getElementById('event_map_image').addEventListener('change', function() {
            var file = this.files[0];
            if (file) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('event_map_preview').src = e.target.result;
                    document.getElementById('event_map_preview').style.display = 'block';
                }
                reader.readAsDataURL(file);
            }
        });
    });
</script>

<style>
    body {
        background-color: #121212;
        color: #FFFFFF;
        font-family: 'Arial', sans-serif;
    }

    .form-container {
        max-width: 1200px;
        margin: 0px auto;
        background-color: #1e1e1e;
        padding: 20px;
        border-radius: 10px;
    }

    .form-container h1 {
        text-align: center;
        font-size: 2em;
        margin-bottom: 20px;
    }

    .error-container ul {
        list-style-type: none;
        padding: 0;
        color: #ff4d4d;
    }

    .image-container {
        display: flex;
        justify-content: center;
        gap: 50px;
        margin-bottom: 20px;
    }

    .main-container {
        display: flex;
        justify-content: space-between;
    }

    .details-container, .date-time-container {
        width: 48%;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-group label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }

    .form-group input,
    .form-group textarea,
    .form-group select {
        width: 100%;
        padding: 10px;
        box-sizing: border-box;
        background-color: #333;
        border: none;
        border-radius: 5px;
        color: #fff;
    }

    .form-group input[type="file"] {
        padding: 5px;
    }

    .image-preview {
        display: none;
        max-width: 100%;
        max-height: 200px;
        margin-top: 10px;
        border: 2px solid #fff;
        border-radius: 5px;
    }

    .btn-primary {
        display: block;
        width: 100%;
        background-color: #00c853;
        color: #fff;
        border: none;
        padding: 15px;
        font-size: 18px;
        cursor: pointer;
        border-radius: 5px;
        text-align: center;
        margin-top: 20px;
    }

    .btn-primary:hover {
        background-color: #00b14a;
    }

    .btn-primary:active {
        background-color: #009624;
    }
</style>
