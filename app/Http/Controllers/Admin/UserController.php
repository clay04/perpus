<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UserController extends Controller
{

    public function index()
    {
        $users = User::latest()->get();
        return view('pages.admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('pages.admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:tbl_user,username',
            'email' => 'required|string|email|max:255|unique:tbl_user,email',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|in:admin,user',
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->password,
            'role' => $request->role,
        ]);

        return redirect()->route('admin.users')->with('success', 'User created successfully.');
    }

    public function update(Request $request, User $user)
    {
        $validate = $request->validate([
            'name'     => 'required|string|max:255',
            'username' => [
                'required','string','max:50',
                Rule::unique('tbl_user','username')->ignore($user->id)
            ],
            'email'    => [
                'required','email',
                Rule::unique('tbl_user','email')->ignore($user->id)
            ],
            'role'     => 'required|in:admin,user',
        ]);
    }

    public function destroy(User $user)
    {
        if (Auth::id() === $user->id) {
            return redirect()->route('admin.users')
                ->with('error', 'Anda tidak bisa menghapus akun sendiri');
        }

        $user->delete();

        return redirect()->route('admin.users')->with('success', 'User berhasil dihapus');
    }
}
