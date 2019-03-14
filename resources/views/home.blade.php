@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        Usuarios y posts

                        {{--TODO: enlazar a ruta para crear post--}}
                        <a href="" class="btn btn-primary float-right">
                            <i class="fas fa-paper-plane  "></i>
                            Crear post
                        </a>
                    </div>

                    <div class="card-body">

                        <table class="table">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>Cantidad Posts</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td scope="row">
                                        #{{ $user->id }}
                                    </td>
                                    <td>
                                        {{ $user->name }}
                                    </td>
                                    <td>
                                        {{ $user->email }}
                                    </td>
                                    <td>
                                        {{--TODO: mostrar cantidad de posts de usuario--}}
                                    </td>
                                    <td>
                                        {{--TODO: mostrar enlace para ver posts de usuario si tiene--}}
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>

                        {{--TODO: Paginar--}}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
