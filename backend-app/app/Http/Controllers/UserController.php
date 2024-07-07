<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index(Request $request)
    {
        $query = User::query();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->input('search') . '%')
                  ->orWhere('email', 'like', '%' . $request->input('search') . '%');
        }

        if ($request->filled('role')) {
            $query->where('role', $request->input('role'));
        }

        $users = $query->with('address')->get();

        return view('user-management', compact('users'));
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('show', compact('user'));
    }
    public function editRole($id)
    {
        $user = User::findOrFail($id);
        return view('edit-user-role', compact('user'));
    }

    public function updateRole(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->only('role'));
        return redirect()->route('user-management')->with('success', 'User role updated successfully');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('user-management')->with('success', 'User deleted successfully');
    }

}
