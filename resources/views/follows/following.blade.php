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
@include('includes.loadBlock')
<div class=" content " style="display: none;" id="wrapper-div">

    <div class="w3-row">

        <div class="w3-col m9 w3-border">
            <div class="w3-container w3-border">
                <h3> Profiles <a href="{{ route('profile.show', $user->username) }}"> {{ $user->username }} </a> follow | {{ count($following) }}
                </h3>
            </div>

            @foreach($following as $follow)
            <div class="w3-margin w3-padding w3-border">
                <user-component current-user="{{ $follow->profile->id }}" user-id="{{ Auth::user()->id }}"
                    usertype="auth" user="{{ json_encode($follow->profile->user) }}"
                    status="{{Auth::user()->isFollowing($follow->profile->id) ? 1 : 0}}">
                </user-component>
            </div>
            @endforeach



        </div>
    </div>

    <!-- Right side -->

    <div class="w3-col m3">

    </div>

</div>

</div>


@endsection

@section('scripts')
<script src="{{ asset('js/loadBlock.js') }}"></script>


@endsection