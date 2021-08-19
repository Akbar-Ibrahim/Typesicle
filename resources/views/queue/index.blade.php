@extends('layouts.home')

@section('styles')

<style>
.content {
max-width: 800px;
margin: auto;
}
</style>

@endsection

@section('content')
@include('includes.urls')

<div class="w3-container content">
    <div class="w3-row-padding">

        @if(count($user->queues) !== 0)
        <div class="">

            <span id="deleteReadLaterUrl" url="{{ route('delete.queue') }}" class="d-none"> </span>
            <div class="w3-container my-4">
                <form method="POST" action="{{ route('delete.queue') }}">
                    @csrf

                    <input type="hidden" name="_method" value="delete">

                    <button style="background-color: #04AA6D;" class="w3-hide-small w3-hide-medium btn btn-default btn-lg"> Clear Queues </button>
                    <button style="background-color: #04AA6D; width: 100%;" class="w3-hide-large btn btn-default"> Clear Queues </button>
                </form>
                @endif
            </div>
        </div>

        <!--  -->

        <div style="margin-top: 50px;">
            <parent-component history="{{ json_encode($history) }}" user-id="{{ Auth::user()->id }}"
                user="{{ json_encode($user) }}" user-type="auth">
            </parent-component>
        </div>


        <!--  -->

        @if(count($user->queues) < 1) 
        <div class="w3-hide-small w3-hide-medium w3-container w3-center" style="margin-top: 100px;">
            <div class="w3-container" style="width: 70%; margin: auto;">
                <h1> You have not queued any posts. When you do, they'll show up here! </h1>
            </div>
    </div>

    <div class="w3-hide-large w3-container w3-center" style="margin-top: 100px;">
            <div class="w3-container" style="width: 70%; margin: auto;">
                <h1 style="font-size: 60px;"> <b> You have not queued any posts. When you do, they'll show up here! </b> </h1>
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