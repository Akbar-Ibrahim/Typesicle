@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Edit Post') }}</div>

                    <form method="POST" action="/admin/posts/{{$post->id}}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="_method" value="PUT">

                        <div class="form-group row">
                            <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') ?? $post->title }}" required autocomplete="title" autofocus>

                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="col-md-10 d-none">
                                <input id="url" type="text" class="py-4 form-control @error('url') is-invalid @enderror" name="url" value="{{ old('url') }}" autocomplete="url" autofocus>

                                @error('url')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="form-group row">
                            <label for="category_id" class="col-md-4 col-form-label text-md-right">{{ __('Category') }}</label>

                            <div class="col-md-6">
                                    <select id="category_id" type="number" class="form-control @error('category_id') is-invalid @enderror" name="category_id" required autocomplete="category_id">
                                    
                                <option value=""> Select a category </option>
                                    @foreach($categories as $category)
                                    <option value="{{$category->id}}"> {{$category->name}} </option>
                                    @endforeach

                                </select>

                                @error('category_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                            <div class="form-group row">
                                <label for="body" class="col-md-4 col-form-label text-md-right">{{ __('Body') }}</label>

                            <div class="col-md-6">
                                <textarea id="summernote" type="text" class="form-control @error('body') is-invalid @enderror" name="body" required autocomplete="body" autofocus>{{ $post->body }}</textarea>

                                @error('body')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>



                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update Post') }}
                                </button>
                            </div>
                        </div>                    
                    </form>


                    <div class="card-body" style="border: 2px solid black;">
                <form method="POST" action="/admin/posts/{{$post->id}}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="_method"value="DELETE">

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary btn-danger">
                                    {{ __('Delete Post') }}
                                </button>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
