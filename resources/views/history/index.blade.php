@extends('layouts.home')

@section('styles')

<link href="{{ asset('css/search-dropdown.css') }}" rel="stylesheet">

@endsection

@section('content')


<div class="w3-container">

    <div class="w3-row-padding">

        <div class="w3-col m9">
            <div class="w3-container">

                <div class="w3-container my-4">
                    @if(count($history) !== 0)
                    <form method="POST" action="{{ route('history.delete') }}">
                        @csrf

                        <input type="hidden" name="_method" value="delete">

                        <button> Clear history </button>
                    </form>
                    @endif
                </div>

                <div style="margin-top: 50px;">
                    <parent-component history="{{ json_encode($history) }}" user-id="{{ Auth::user()->id }}"
                        user="{{ json_encode($user) }}" user-type="auth">
                    </parent-component>
                </div>

                @if(count($history) < 1) <div class="w3-container w3-center" style="margin-top: 120px;">
                    <div class="w3-container" style="width: 70%; margin: auto;">
                        <h2> You haven't read any posts yet </h2>
                        <h4>Start below</h4>
                        <random-post-component></random-post-component>
                    </div>
            </div>
            @endif


        </div>
    </div>

    <!-- Right side -->

    <div class="w3-col m3">

    </div>

</div>

</div>


@endsection

@section('scripts')
<!-- <script src="{{ asset('js/app.js') }}"></script> -->


@endsection