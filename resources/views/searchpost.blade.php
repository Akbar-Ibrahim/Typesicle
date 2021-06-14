@extends('layouts.home')

@section('styles')

<link href="{{ asset('css/search-dropdown.css') }}" rel="stylesheet">

@endsection

@section('content')



<div>


    <!-- Header -->
    <header class="w3-container" style="padding-top:22px">
        <!-- <h5><b><i class="fa fa-dashboard"></i> My Dashboard</b></h5> -->
        <h5><b><i class="fa fa-search"></i> Search</b></h5>
    </header>



    <div class="w3-row-padding w3-margin-bottom">
        <div class="w3-twothird">


            <div id="app">

                @if($searchterm == '')

                <postsearch-component></postsearch-component>
                <div class="w3-container my-4">
                    <h5> No search query. </h5>
                </div>

                @elseif(count($posts) > 0)

                <postsearch-component></postsearch-component>

                <div class="w3-container my-4">
                    <h5> Search results for <b> "{{ $searchterm }}" are </h5>
                </div>

                @auth
                <post-parent-component articles="{{ json_encode($feeds) }}" user-id="{{ Auth::user()->id }}"
                    user="{{ json_encode($user) }}" user-type="auth">
                </post-parent-component>
                @else
                <post-parent-component articles="{{ json_encode($searchResult) }}" user-id="0"
                    user="{{ json_encode($guest) }}" user-type="guest">
                </post-parent-component>
                @endauth


                @elseif(count($posts) == 0)

                <search-component></search-component>
                <h1> There are no results for <b> "{{ $searchterm }}" </b> </h1>

                @endif
            </div>

        </div>

        <div class="w3-third">


        </div>

    </div>



</div>

@endsection