@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        Posts del usuario {{ $user->name }}
                    </div>

                    <div class="card-body">

                        <table class="table">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Título</th>
                                <th>Extracto</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($posts as $post)
                                <tr>
                                    <td scope="row">
                                        {{ $post->id }}
                                    </td>
                                    <td>
                                        {{ $post->title }}
                                    </td>
                                    <td>
                                        {{ $post->excerpt }}
                                    </td>
                                    <td>
                                        <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-outline-info"
                                           title="Editar">
                                            <i class="fas fa-edit  "></i>
                                        </a>

                                        <form method="POST" action="{{ route('posts.destroy', $post->id) }}" class="d-inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-outline-danger"
                                                    title="Eliminar">
                                                <i class="fas fa-trash  "></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
