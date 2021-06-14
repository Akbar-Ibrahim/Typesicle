@extends('layouts.home')

@section('styles')


@endsection

@section('content')

<div class="w3-container">
    <div class="w3-row-padding">

        <div class="w3-twothird">

            

            <div class="w3-margin w3-border" style="height: 100vh">
                <group-component group="{{ json_encode($group) }}" user="{{ json_encode(Auth::user()->profile) }}"
                    chat="{{ json_encode($chat) }}"></group-component>
            </div>

        </div>

        <div class="w3-third">
            <div class="w3-container">
                <h3> {{ $group->name }} </h3>
                <div> {{ $group->description }} </div>
            </div>




            <div class="w3-container w3-margin w3-right"> Members (<span>{{ count($group->members) }}</span>) </div>
            @if($group->creator == Auth::user()->id)
            <div class="w3-container w3-margin" style="margin-bottom: 50px;">
                <send-group-invite-component user-id="{{ Auth::user()->id }}" accounts="{{ json_encode($addToGroup) }}">
                </send-group-invite-component>
            </div>
            @endif

            @foreach($group->members as $member)
            <header-component :user="{{  json_encode($member->user) }}" :date="{{ json_encode($member->created_at) }}"
                size="width: 35px">
            </header-component>
            @endforeach
        </div>
    </div>
</div>

@include('includes.addToGroup')
@endsection

@section('scripts')
<script>


</script>
@endsection