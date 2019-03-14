<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct()
    {
        //TODO: restringir para que solo usuarios conectados usen este controlador
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        //TODO: validar request y crear un nuevo post para el usuario conectado


        $notification = [
            'status' => 'Post creado!'
        ];

        //TODO redireccionar y notificar
        return redirect();
    }

    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    public function update(Post $post, Request $request)
    {
        //TODO: validar request

        $post->fill($data);

        // TODO: notificar

        return redirect()
            ->route('users.posts', $post->user->id)
            ->with($notification);
    }

    public function destroy($id)
    {
        Post::destroy($id);

        $notification = [
            'status' => 'Post eliminado!'
        ];

        return back()
            ->with($notification);
    }
}
