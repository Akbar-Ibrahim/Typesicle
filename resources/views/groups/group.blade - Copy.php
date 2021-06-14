@extends('layouts.home')

@section('styles')


@endsection

@section('content')

<div class="w3-container">


<div class="w3-twothird">
    
    <group-component group="{{ json_encode($group) }}" user="{{ json_encode(Auth::user()->profile) }}" chat="{{ json_encode($chat) }}" ></group-component>


    
</div>

<div class="w3-third">
<h3> {{ $group->name }} </h3>
<div> {{ $group->description }} </div>

<div> Members (<span>{{ count($group->members) }}</span>) </div>
@foreach($group->members as $member)
<header-component :user="{{  json_encode($member->user) }}" :date="{{ json_encode($member->created_at) }}" size="width: 35px">
      </header-component>
@endforeach
</div>
</div>


@endsection

@section('scripts')


@endsection