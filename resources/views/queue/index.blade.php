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
        <h5><b><i class="fa fa-home"></i> Queues </b></h5>
    </header>

    <div class="w3-row-padding w3-margin-bottom">

    </div>

    <div class="w3-row-padding w3-margin-bottom">
        @if(count($user->queues) !== 0)
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

            
            <div style="margin-top: 50px;">                    
                    <parent-component history="{{ json_encode($history) }}" user-id="{{ Auth::user()->id }}"
                    user="{{ json_encode($user) }}" user-type="auth">
                        </parent-component>
                </div>

        </div>

        @if(count($user->queues) < 1)
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