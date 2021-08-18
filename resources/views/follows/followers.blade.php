@extends('layouts.home')

@section('styles')

<style>
.content {
    max-width: 1000px;
    margin: auto;
}
</style>

@endsection

@section('content')


<div class=" content">
    <div class="w3-row">

        <div class="w3-col m9 w3-border">
            <div class="w3-container w3-border">
                <h3> <a href="{{ route('profile.show', $user->username) }}"> {{ $user->username }}</a>'s Followers |
                        {{ count($followers) }} 
                </h3>
            </div>

            @foreach($followers as $follower)
            <div class="w3-margin w3-padding w3-border">
                <user-component current-user="{{ $follower->user_id }}" user-id="{{ Auth::user()->id }}"
                    usertype="auth" user="{{ json_encode($follower->user) }}" 
                    status="{{Auth::user()->isFollowing($follower->user->profile->id) ? 1 : 0}}" page="follow">
                </user-component>
            </div>
            @endforeach



        </div>
    

    <!-- Right side -->

    <div class="w3-col m3">

    </div>


</div>

</div>


@endsection

@section('scripts')


@endsection