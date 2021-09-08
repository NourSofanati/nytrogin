<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('users.index', compact(['roles']));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role_id' => $request->role_id,
        ]);
        return redirect()->route('users.index');
    }

    public function edit(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $user->update($request->all());
        $user->save();
        toast('تم حفظ المستخدم', 'success');
        return redirect()->back();
    }
    public function destroy(User $user)
    {
        $user->delete();
        toast('تم حذف المستخدم ' . $user->name, 'danger');
        return redirect()->route('users.index');
    }
}
