@csrf

<div class="form-group">
    <label for="title">Título</label>
    <input type="text"
           class="form-control"
           name="title"
           value="{{ isset($post) ? $post->title : old('title') }}"
           id="title">
</div>

@if ($errors->has('title'))
    <span class="invalid-feedback d-block" role="alert">
        <strong>{{ $errors->first('title') }}</strong>
    </span>
@endif

<div class="form-group">
    <label for="title">Descripción</label>
    <textarea name="body" id="body" cols="30" rows="10"
              class="form-control">{{ isset($post) ? $post->body : old('body') }}</textarea>

    @if ($errors->has('body'))
        <span class="invalid-feedback d-block" role="alert">
            <strong>{{ $errors->first('body') }}</strong>
        </span>
    @endif
</div>

<button class="btn btn-block btn-primary">
    <i class="fas fa-save  "></i>
    Guardar
</button>
