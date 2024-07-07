@extends('layouts.admin')

@section('content')
<h1>Users</h1>
<table>
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Actions</th>
    </tr>
    @foreach ($users as $user)
    <tr>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>
            <a href="{{ route('admin.users.edit', $user->id) }}">Edit</a>
            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?');" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection
