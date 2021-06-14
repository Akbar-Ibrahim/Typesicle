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


                

            </div>
        </div>

        <!-- Right side -->

        <div class="w3-col m3">
            <h1> Right Side </h1>
        </div>

    </div>

</div>


@endsection

@section('scripts')
<!-- <script src="{{ asset('js/app.js') }}"></script> -->


@endsection