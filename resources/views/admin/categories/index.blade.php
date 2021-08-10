@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Create category</div>

                <div class="card-body">
                    @if (session('deleted_user'))
                        <div class="alert alert-success" role="alert">
                            {{ session('deleted_user') }}
                        </div>
                    @endif
                </div>



<div class="row">
<div class="col-md-6">

<form method="POST" action="/admin/categories">
                        @csrf

                        <div style="width: 50%; margin-left: auto; margin-right: auto;">

                        <div class="form-group row">
                            <div class="col-md-12">
                            <input id="name" type="text" placeholder="create category" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        </div>

                        
                            <div class="col-md-6 d-none">
                            <input id="url" type="text" class="form-control @error('url') is-invalid @enderror" name="url" value="{{ old('url') }}" autocomplete="url" autofocus>

                                @error('url')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>


                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Create Category') }}
                                </button>
                            </div>
                        </div>
                    </form>

</div>

<div class="col-md-6">
<table class="table">
    <thead>
      <tr>
        <th> Id </th>
        <th> Category </th>
      </tr>
    </thead>
    <tbody>
    @if($categories)
    @foreach($categories as $category )
    @if($category->user->id == Auth::user()->id)
      <tr>
        <td> {{$category->id}} </td>
        <td> {{$category->name}} </td>
        <td> <a href="{{route('categories.edit', $category->id)}}"> {{$category->name ? 'Edit' : 'no'}} </a> </td>
        <td>

        <form method="POST" action="/admin/categories/{{$category->id}}">
                        @csrf
                        <input type="hidden" name="_method"value="DELETE">

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary btn-danger">
                                    {{ __('Delete') }}
                                </button>
                            </div>
                        </div>
                </form>
        
        </td>

      </tr>
    @endif
      @endforeach
      @endif
    </tbody>

    
  </table>
  </div>
</div>




            </div>
        </div>
    </div>
</div>
@endsection
