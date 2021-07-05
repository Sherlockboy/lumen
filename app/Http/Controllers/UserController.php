<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return response()->json(User::all('id', 'name', 'email'), 200);
    }

    public function show($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json("User not found!", 404);
        }

        return response()->json($user, 200);
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6'
        ]);

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => app('hash')->make($request->input('password'))
        ]);

        return response()->json($user, 201);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string'
        ]);

        $user = User::find($id);

        if (!$user) {
            return response()->json("User not found!", 404);
        }

        $user->update($request->only('name'));

        return response()->json("Updated!", 200);
    }

    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json("User not found!", 404);
        }

        $user->delete();

        return response()->json("Deleted!", 200);
    }
}
