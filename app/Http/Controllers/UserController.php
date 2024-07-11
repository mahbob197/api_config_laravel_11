<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function create()
    {
        return view('admin.add_edit_user', ['title' => 'Create User']);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:50',
            'email' => 'required|email|max:50',
            'photo' => 'nullable|image|max:2048',
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $filename);
            $user->photo = $filename;
        }

        $user->save();

        return redirect()->route('user.create')->with('success', 'User created successfully.');
    }

    public function edit($id)
    {
        $edit = User::findOrFail($id);
        return view('users.create', ['edit' => $edit, 'title' => 'Edit User']);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:50',
            'email' => 'required|email|max:50',
            'photo' => 'nullable|image|max:2048',
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->hasFile('photo')) {
            // Supprimer l'ancienne image si elle existe
            if ($user->photo && Storage::exists('uploads/' . $user->photo)) {
                Storage::delete('uploads/' . $user->photo);
            }

            $file = $request->file('photo');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $filename);
            $user->photo = $filename;
        }

        $user->save();

        return redirect()->route('user.edit', $id)->with('success', 'User updated successfully.');
    }
}
