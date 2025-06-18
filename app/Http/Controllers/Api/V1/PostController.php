<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Post::all();
    }

    // Other methods ...



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // Create a new post
        // $post = Post::create([
        //     'title' => $request->title,
        //     'description' => $request->description,
        //     'user_id' => $request->user_id,
        // ]);

        // return response()->json([
        //     'status' => 'success',
        //     'data' => $post
        // ], 201);


        $posts = new Post();
        $posts->title = $request->title;
        $posts->description = $request->description;
        $posts->user_id = $request->user_id;
        $posts->save();

        return response()->json($posts, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
         $posts = Post::find($id);

        if (!$posts) {
            return response()->json(['message' => 'User not found'], 404);
        }

        return response()->json(['status' => 'success', 'data'   => $posts]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    
}
