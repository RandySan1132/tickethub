<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
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
