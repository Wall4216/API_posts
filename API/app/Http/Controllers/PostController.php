<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return response()->json($posts);
    }

    public function show($id)
    {
        $post = Post::find($id);
        return $post ? response()->json($post) : response()->json(['error' => 'Пост не найден'], 404);

    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required'
        ]);

        $post = new Post();
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->save();

        return response()->json($post, 201);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $post = Post::find($id);
        if ($post) {
            $post->title = $request->input('title');
            $post->content = $request->input('content');
            $post->save();

            return response()->json($post);
        } else {
            return response()->json(['error' => 'Пост не найден'], 404);
        }
    }
    public function destroy($id)
    {
        $post = Post::find($id);
        if ($post) {
            $post->delete();
            return response()->json(['message' => 'Пост успешно удален']);
        } else {
            return response()->json(['error' => 'Пост не найден'], 404);
        }
    }
}
