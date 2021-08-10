@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Replies') }}</div>
<h1>Hey</h1>
                <div>
@if(count($replies) > 0)
<table class="table">
    <thead>
      <tr>
        <th> Id </th>
        <th> Name </th>
        <th> Photo </th>
        <th> Created </th>
      </tr>
    </thead>
    <tbody>
    @if($replies)
    @foreach($replies as $reply)
      <tr>
        <td> {{$reply->id}} </td>
        <td> <a href="/profile/{{$reply->user_id}}"> {{$reply->author ? $reply->author : ''}} </a> </td>
        <td> <img src="{{$reply->photo ? $reply->photo : '/images/kj.png'}}" height="50" alt=""> </td>
        <td> {{$reply->created_at ? $reply->created_at->diffForHumans() : 'No Date'}} </td>
        <td> <a href="{{route('home.post', $reply->comment->post->id)}}"> View Post </a> </td>
        <td>
        @if($reply->is_active == 1)
           {!! Form::open(['method'=> 'PATCH', 'action'=> ['CommentRepliesController@update', $reply->id]]) !!}

                <input type="hidden" name="is_active" value="0">

                <div class="form-group row">
                    {!! Form::submit('Unapprove', ['class' => 'form-control']) !!}
                </div>


            {!! Form::close() !!}
        @else

        {!! Form::open(['method'=> 'PATCH', 'action'=> ['CommentRepliesController@update', $reply->id]]) !!}

<input type="hidden" name="is_active" value="1">

<div class="form-group row">
    {!! Form::submit('Approve', ['class' => 'form-control']) !!}
</div>

{!! Form::close() !!}
@endif
        </td>

        <td>
        {!! Form::open(['method'=> 'DELETE', 'action'=> ['CommentRepliesController@destroy', $reply->id]]) !!}

            <input type="hidden" name="is_active" value="1">

            <div class="form-group row">
                {!! Form::submit('Delete', ['class' => 'form-control']) !!}
            </div>

        {!! Form::close() !!}
        
        
        </td>
      </tr>
      @endforeach
      @endif
    </tbody>
  </table>
  @else 
  <h1> No Replies </h1>
  @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

