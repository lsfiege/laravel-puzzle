@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        Crear post
                    </div>

                    <div class="card-body">

                        <form method="POST" action="{{ route('posts.store') }}">
                            {{--TODO: add fields--}}
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
