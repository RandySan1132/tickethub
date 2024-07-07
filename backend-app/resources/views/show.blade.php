@extends('layouts.app')

@section('content')
<div class="container">
    <h2>User Details for {{ $user->name }}</h2>

    <div class="user-details">
        <p><strong>Full Name:</strong> {{ $user->name }}</p>
        <p><strong>Email Address:</strong> {{ $user->email }}</p>
        <p><strong>Address:</strong> {{ $user->address ? $user->address->address_line1 . ', ' . $user->address->city : 'N/A' }}</p>
        <p><strong>Joined:</strong> {{ $user->created_at->format('F d, Y') }}</p>
        <p><strong>Role:</strong> {{ ucfirst($user->role) }}</p>
    </div>

    <form action="{{ route('users.update-role', $user->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="role">Edit Role:</label>
            <select name="role" id="role" class="form-control">
                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update Role</button>
    </form>
</div>
@endsection
