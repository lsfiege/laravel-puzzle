@if (session('status'))
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            </div>
        </div>
    </div>
@endif
