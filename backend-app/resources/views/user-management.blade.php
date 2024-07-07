@extends('layouts.app')

@section('content')
<div class="ManageUser" style="color: white; font-size: 20px; font-family: Poppins; font-weight: 700; word-wrap: break-word; margin-bottom: 20px;">Manage User</div>

<div style="display: flex; gap: 20px; margin-bottom: 20px;">
    <form id="search-form" style="display: flex; gap: 20px;" method="GET" action="{{ route('user-management') }}">
        <div class="Frame4" style="width: 231.63px; height: 41.26px; padding: 13.23px; background: #282828; border-radius: 15px; display: flex; align-items: center;">
            <input type="text" name="search" id="search" class="SearchItems" placeholder="Search items..." value="{{ request('search') }}" style="color: white; font-size: 16px; font-family: Poppins; font-weight: 400; word-wrap: break-word; background: none; border: none; outline: none; width: 100%;" />
        </div>
        <div class="Frame6" style="width: 188.45px; height: 41.26px; padding: 13.23px; background: #282828; border-radius: 12px; display: flex; align-items: center; gap: 10px;">
            <div class="Permissions" style="color: white; font-size: 16px; font-family: Poppins; font-weight: 400; word-wrap: break-word">Permissions</div>
            <select name="role" id="role" style="color: #1BD938; font-size: 16px; font-family: Poppins; font-weight: 400; background: #282828; border: none;">
                <option value="" {{ request('role') == '' ? 'selected' : '' }}>All</option>
                <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>User</option>
            </select>
        </div>
    </form>
</div>

<table style="width: 100%; border-collapse: collapse; background: #282828; border-radius: 10px;">
    <thead>
        <tr style="background: #454545;">
            <th style="color: white; font-size: 16px; font-family: Poppins; font-weight: 400; padding: 10px; text-align: left;">Full Name</th>
            <th style="color: white; font-size: 16px; font-family: Poppins; font-weight: 400; padding: 10px; text-align: left;">Email Address</th>
            <th style="color: white; font-size: 16px; font-family: Poppins; font-weight: 400; padding: 10px; text-align: left;">Address</th>
            <th style="color: white; font-size: 16px; font-family: Poppins; font-weight: 400; padding: 10px; text-align: left;">Joined</th>
            <th style="color: white; font-size: 16px; font-family: Poppins; font-weight: 400; padding: 10px; text-align: left;">Permissions</th>
            <th style="color: white; font-size: 16px; font-family: Poppins; font-weight: 400; padding: 10px; text-align: left;">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
        <tr>
            <td style="color: white; font-size: 16px; font-family: Poppins; font-weight: 400; padding: 10px; display: flex; align-items: center;">
                <img src="{{ asset('images/customer-profile.png') }}" style="border-radius: 50%; margin-right: 10px; width: 26.78px; height: 26.55px" />
                {{ $user->name }}
            </td>
            <td style="color: white; font-size: 16px; font-family: Poppins; font-weight: 400; padding: 10px;">{{ $user->email }}</td>
            <td style="color: white; font-size: 16px; font-family: Poppins; font-weight: 400; padding: 10px;">
                @if($user->address)
                {{ $user->address->address_line1 }}, {{ $user->address->city }}
                @else
                N/A
                @endif
            </td>
            <td style="color: white; font-size: 16px; font-family: Poppins; font-weight: 400; padding: 10px;">{{ $user->created_at->format('F d, Y') }}</td>
            <td style="color: white; font-size: 16px; font-family: Poppins; font-weight: 400; padding: 10px;">
                <div style="background-color: {{ $user->role == 'admin' ? '#008080' : '#0000FF' }}; padding: 5px 10px; border-radius: 5px; text-align: center;">
                    {{ ucfirst($user->role) }}
                </div>
            </td>
            <td style="color: white; font-size: 16px; font-family: Poppins; font-weight: 400; padding: 10px;">
                <a href="{{ route('users.show', $user->id) }}" style="color: #1BD938;">View Details</a>
                <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this user?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" style="color: #FF0000; background: none; border: none;">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchForm = document.getElementById('search-form');
        const searchInput = document.getElementById('search');
        const roleSelect = document.getElementById('role');

        searchInput.addEventListener('keydown', function (e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                searchForm.submit();
            }
        });

        roleSelect.addEventListener('change', function () {
            searchForm.submit();
        });
    });
</script>
@endsection
