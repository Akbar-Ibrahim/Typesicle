@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Comments') }} under <a href="{{ route('home.post', [$post->url, $post->id]) }}"> {{ $post->title }} </a></div>

                <div>
@if(count($comments) > 0)

    @if($comments)
    @foreach($comments as $comment)
    <div class="container">
      <div class="row pl-4 pt-4">
      <div> <img class="rounded-circle" src="{{$comment->photo ?? '/images/kj.png'}}" height="50" alt=""> <a href="{{ route('profile.show', $comment->user->username) }}">
         {{ $comment->user->username }} </a>  commented on <a href="{{ route('home.post', [$comment->post->url, $comment->post->id]) }}"> {{$comment->post->title}} </a> 
          on {{ $comment->created_at }} 
         | <a href="{{route('replies.show', $comment->id)}}"> Replies </a>  </div>
      </div>
      <div class="row my-4">
      <div class="py-4 pl-4"> {{$comment->body}} </div>
    </div>

    <div class="row">
    <div class="col-md-1">
      @if($comment->is_active == 1)
           {!! Form::open(['method'=> 'PATCH', 'action'=> ['PostCommentsController@update', $comment->id]]) !!}

                <input type="hidden" name="is_active" value="0">

                <div class="form-group row">
                    {!! Form::submit('Unapprove', ['class' => 'form-control']) !!}
                </div>


            {!! Form::close() !!}
        @else

        {!! Form::open(['method'=> 'PATCH', 'action'=> ['PostCommentsController@update', $comment->id]]) !!}

<input type="hidden" name="is_active" value="1">

<div class="form-group row">
    {!! Form::submit('Approve', ['class' => 'form-control']) !!}
</div>

{!! Form::close() !!}
@endif
        </div>
        <div class="col-md-1">
        {!! Form::open(['method'=> 'DELETE', 'action'=> ['PostCommentsController@destroy', $comment->id]]) !!}

            <input type="hidden" name="is_active" value="1">

            <div class="form-group row">
            {!! Form::submit('Delete', ['class' => 'form-control']) !!}
            </div>

        {!! Form::close() !!}        
        </div>

        </div>
        </div>
      @endforeach
      @endif
    
  @else 
  <div class="text-center py-4"> No Comments under <a href="{{ route('home.post', [$post->url, $post->id]) }}">{{ $post->title }} </a> </div>
  @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

