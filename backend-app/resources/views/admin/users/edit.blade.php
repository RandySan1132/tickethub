@extends('layouts.app')

@section('content')
<div class="ManageUser" style="color: white; font-size: 20px; font-family: Poppins; font-weight: 700; word-wrap: break-word; margin-bottom: 20px;">Edit User</div>

<form action="{{ route('admin.users.update', $user->id) }}" method="POST">
  @csrf
  <div style="margin-bottom: 20px;">
    <label for="name" style="color: white; font-size: 17.70px; font-family: Poppins; font-weight: 400;">Name</label>
    <input type="text" name="name" id="name" value="{{ $user->name }}" style="width: 100%; padding: 10px; margin-top: 10px;">
  </div>
  <div style="margin-bottom: 20px;">
    <label for="email" style="color: white; font-size: 17.70px; font-family: Poppins; font-weight: 400;">Email</label>
    <input type="email" name="email" id="email" value="{{ $user->email }}" style="width: 100%; padding: 10px; margin-top: 10px;">
  </div>
  <div style="margin-bottom: 20px;">
    <label for="location" style="color: white; font-size: 17.70px; font-family: Poppins; font-weight: 400;">Location</label>
    <input type="text" name="location" id="location" value="{{ $user->location }}" style="width: 100%; padding: 10px; margin-top: 10px;">
  </div>
  <div style="margin-bottom: 20px;">
    <label for="role" style="color: white; font-size: 17.70px; font-family: Poppins; font-weight: 400;">Role</label>
    <input type="text" name="role" id="role" value="{{ $user->role }}" style="width: 100%; padding: 10px; margin-top: 10px;">
  </div>
  <button type="submit" style="background: #1BD938; color: white; padding: 10px 20px; border: none; border-radius: 5px; font-family: Poppins;">Update</button>
</form>
@endsection
