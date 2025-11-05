<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Post::latest()->paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
          $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body'  => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('posts', 'public');
        }

        $validated['slug'] = Str::slug($validated['title']) . '-' . Str::random(5);

        Post::create($validated);

        return response()->json($post, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return response()->json(Post::findOrFail($id));
        if (!$post){
            return response()->json([
            'status'=>'error',
            'message'=>'post not found'],404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $post = Post::findorFail($id);
        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'body'  => 'sometimes|required|string',
            'image' => 'nullable|image|max:2048',
        ]);
        //if validation fails, return error response
        if ($validated->fail()){
            $error = " ";
            foreach ($validated->message()->getmessage() as $fieldname => $messages){
                foreach ($messages as $message)
                    {
                    $error .= $message ." ";
                    }
            }
            return response()->json([
                'status'=>'error',
                'message'=>$error],422);
        }

        //handle image upload
        if ($request ->hasFile('image')){
            //delete old image of database if exists
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }
            $validated['image'] = $request->file('image')->store('posts', 'public');
        }

        $post->update($validated);
        return response()->json($post);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //find post by id
        $post - Post::findorFail($id);
        //if post not found return error response
        if(!$post){
            return response()->json([
                'status'=>'error',
                'message'=>'post not found'],404);
        }
        //delete image from storage if exists
        if ($post->image){
            Storage::disk('public')->delete($post->$image);
        }
        $post->delete();
        return response()->json ([
            'status'=>'success',
            'message'=>'post deleted successfully',
        ],200);
    }
}
