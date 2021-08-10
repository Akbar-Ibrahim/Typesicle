@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Upload Media') }}</div>

                <div class="card-body">
                <table class="table">
    <thead>
      <tr>
        <th> Id </th>
        <th> Name </th>
        <th> Created </th>
        
      </tr>
    </thead>
    <tbody>
    @if($photos)
    @foreach($photos as $photo )
    
      <tr>
        <td> {{$photo->id}} </td>
        <td> <img src="{{$photo->file ? $photo->file : '/images/kj.png'}}" height="50"> </td>
        <td> {{$photo->created_at ? $photo->created_at : 'No Date'}} </td>

        <td>

        <form method="POST" action="/admin/media/{{$photo->id}}">
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
      @endforeach
      @endif
    </tbody>
  </table>



                </div>
            </div>
        </div>
    </div>
</div>
@endsection

