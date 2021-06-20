@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="card" id="post-form" style="border: none;">

    <div class="w3-container">
        <input type="file" class="form-control-file profile_pic " name="photo_id" value="{{ $photo }}" id="upload_pic"
            style="display: none;">

    </div>

    <div class="">
        <div class=" py-2">
            <input style="font-size: 40px; border: none; outline: none;" id="title" type="text" placeholder="Title..."
                class="py-4 form-control @error('title') is-invalid @enderror" name="title" value="{{ $title }}"
                required autocomplete="title" autofocus>

            @error('title')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>

    <div class="w3-container">
        <input style="font-size: 27px; border: 0;" id="categoryId" type="hidden"
            class="py-4 form-control @error('title') is-invalid @enderror" name="category_id"
            value="{{ $category_id }}">

        <p id="categoryName" class="py-2">{{ $category }}</p>
        @error('category_id')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="w3-container">
        {{ $slot }}
    </div>

    <div class="" id="editorComponent" style="display: none;">
        <textarea style="" id="summernote" class="body form-control @error('body') is-invalid @enderror"
            name="body" autocomplete="body" required autofocus>{{ $body }}</textarea>
            

        @error('body')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>




</div>