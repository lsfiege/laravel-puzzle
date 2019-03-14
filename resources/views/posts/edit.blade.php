@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        Editar post
                    </div>

                    <div class="card-body">

                        {{--TODO Fix this--}}
                        <form method="POST" action="">
                            @include('posts._fields')
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
