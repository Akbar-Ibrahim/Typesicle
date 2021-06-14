@extends('layouts.home')

@section('styles')

<link href="{{ asset('css/search-dropdown.css') }}" rel="stylesheet">

@endsection

@section('content')
@include('includes.urls')

<div class="w3-main" style="margin-top:43px;">


    <!-- Header -->
    <header class="w3-container" style="padding-top:22px">
        <!-- <h5><b><i class="fa fa-dashboard"></i> My Dashboard</b></h5> -->
        <h5><b><i class="fa fa-home"></i> Home</b></h5>
    </header>

    <div class="w3-row-padding w3-margin-bottom">

    </div>

    <div class="w3-row-padding w3-margin-bottom">
        @if(count($queues) !== 0)
        <div class="w3-col l9">


            <span id="deleteReadLaterUrl" url="{{ route('delete.queue') }}" class="d-none"> </span>

            <div class="w3-container my-4">

                <form method="POST" action="{{ route('delete.queue') }}">
                    @csrf

                    <input type="hidden" name="_method" value="delete">

                    <button> Clear Queues </button>
                </form>
                @endif
            </div>

            
            @if(count($queues) > 0)
            @foreach(Auth::user()->queues as $queue)

            <div style="margin-top: 50px;">
                <header-component user="{{ jsone_encode($queue->feed->user) }}"
                    date="{{ $queue->feed->created_at->toFormattedDateString() }}" size="width: 35px">
                </header-component>
                <post-component feed-Id="{{ $queue->feed->id}}" user-id="{{ Auth::user()->id }}" post="{{ json_encode($queue->feed) }}">
                        </post-component>
            </div>

            @endforeach

        </div>
        @else
        
        
        <div class="w3-container w3-center" style="margin-top: 120px;">
        <div class="w3-container" style="width: 70%; margin: auto;">
            <h1> You have not queued any posts. When you do, they'll show up here! </h1>
            </div>
        </div>
        @endif
    </div>


</div>

@endsection

@section('scripts')
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/queue.js') }}"></script>

@endsection