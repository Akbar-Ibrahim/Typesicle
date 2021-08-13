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



<div class="content w3-border">


    <!-- Header -->
    <header class="w3-container" style="padding-top:22px">
        <!-- <h5><b><i class="fa fa-dashboard"></i> My Dashboard</b></h5> -->
        <!-- <h5><b><i class="fa fa-search"></i> Search</b></h5> -->
        <search-component></search-component>
    </header>

    <div class="w3-row-padding w3-margin-bottom">

    </div>

    <div class="w3-row-padding w3-margin-bottom">
        <div class="w3-col l12">
            
            <div id="app">
                @if($searchterm == '')

                <!-- <search-component></search-component> -->
                <div class="w3-container my-4">
                    <h5> No search query. </h5>
                </div>

                @elseif(count($users) > 0)

                <!-- <search-component></search-component> -->

                <div class="w3-container my-4">
                    <h5> Search results for <b> "{{ $searchterm }}" are </h5>
                </div>


                @foreach($users as $user)

                <div class="w3-margin w3-padding w3-border">
                <user-component current-user="{{ $user->id }}" user-id="{{ Auth::user()->id }}"
                    usertype="auth" user="{{ json_encode($user) }}"
                    status="{{Auth::user()->isFollowing($user->profile->id) ? 1 : 0}}">
                </user-component>
                </div>
                @endforeach


                @elseif(count($users) == 0)

                
                <h1> There are no results for <b> "{{ $searchterm }}" </b> </h1>

                @endif
            </div>

        </div>

        
    </div>


</div>

@endsection