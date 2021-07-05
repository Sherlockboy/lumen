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
        $user = User::findOrFail($id);

        return response()->json($user, 200);
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|email'
        ]);
        
        $user = User::create($request->only('name', 'email'));

        return response()->json($user, 201);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|email'
        ]);
        
        User::findOrFail($id)->update($request->only('name', 'email'));

        return response()->json("Updated!", 200);
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();

        return response()->json("Deleted!", 200);
    }
}
