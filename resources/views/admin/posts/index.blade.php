@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4" style="width: 100%;">
    <div class="row justify-content-center">

    <div class="col-md-2">
            @include('includes.admin-sidenav')
        </div>

        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Dashboard | <a href="{{ route('profile.show', Auth::user()->username)}}"> Back to profile </a> </div>

                <div class="card-body">
                    @if (session('post_edit'))
                        <div class="alert alert-success" role="alert">
                            {{ session('post_edit') }}
                        </div>
                    @endif
                </div>

                <div class="card-body">
                    @if (session('deleted_post'))
                        <div class="alert alert-success" role="alert">
                            {{ session('deleted_post') }}
                        </div>
                    @endif
                </div>

                <div class="pl-4 py-4">
                    Posts ({{ count(Auth::user()->posts) }})
                </div>

            </div>

<div>
    @foreach($posts as $post )
    @if($post->user->username == Auth::user()->username)
      <div class="py-2">

        <div class="pl-2" style="font-size: 27px;"> <a href="{{route('home.post', [$post->url, $post->id])}}">  {{$post->title}} </aa> </div>
        <div class="pl-2"> 
            <span class="pl-1"> 
                <a href="{{ route('category.name', [$post->category->id, $post->category->url]) }}"> {{ $post->category->name ?? 'Uncategorized'}} </a> 
            </span>

            <span class="pl-1"> 
                {{ $post->created_at->diffForHumans() ?? ''}} 
            </span>

            <span class="pl-1"> 
                {{ $post->updated_at->diffForHumans() ?? ''}}
            </span>
        
            <span class="pl-1"> 
                <a href="{{route('posts.edit', $post->id)}}"> Edit </a> |
            </span>

            <span class="pl-1"> 
                <a href="{{route('comments.show', $post->id) }}"> {{ count($post->likes) == 1 ? '1 like' : count($post->likes) . ' likes' }} </a> |
            </span>

            <span class="pl-1"> 
                <a href="{{route('comments.show', $post->id) }}"> {{ count($post->comments) == 1 ? '1 comment' : count($post->comments) . ' comments' }}  </a> 
            </span>
    </div>
</div>
      @endif
      @endforeach
      </div>
            
        </div>
    </div>
</div>
@endsection
