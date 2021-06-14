@extends('layouts.home')

@section('styles')


@endsection

@section('content')

<div class="w3-container">
    @foreach($groups as $group)
    <h3>
        <a href="{{ route('group.name', $group->group_id) }}">
            {{ $group->group->name }}
        </a>
    </h3>
    @foreach($group->group->messages as $message)
    @if($loop->first)
    <div> {{ $message->user->name }} </div>
    <div> {{ $message->message }} </div>
    @endif
    @endforeach
    @endforeach
</div>

@endsection

@section('scripts')



@endsection