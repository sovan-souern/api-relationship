<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function index()
    {
        return User::all();
    }

    public function store(Request $request)
    {

        // $user = User::create([
        //     'name'     => $request->name,
        //     'email'    => $request->email,
        //     'password' => Hash::make($request->password),
        // ]);
        // return response()->json(['data'=>$user ], 201); 

        $users = new User();
        $users->name     = $request->name;
        $users->email    = $request->email;
        $users->password = Hash::make($request->password);
        $users->save();

        return response()->json($users, 201);
    }

    public function show(string $id)
    {
        $users = User::find($id);

        if (!$users) {
            return response()->json(['message' => 'User not found'], 404);
        }

        return response()->json(['status' => 'success', 'data'   => $users]);
    }

    public function update(Request $request, string $id)
    {
        $users = User::find($id);

        if (!$users) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $users->update([
            'name'  => $request->name,
            'email' => $request->email,
        ]);

        return response()->json([
            'status' => 'success',
            'data'   => $users
        ]);
    }

    public function destroy(string $id)
    {
        $users = User::find($id);

        if (!$users) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $users->delete();

        return response()->json([
            'message' => 'User deleted successfully'
        ]);
    }

    public function getAllUserWithPosts(){
        $users = User::with('post')->get();
        return response()->json([
           'status' => 'success',
           'data' => $users
        ],200);
    }
}
