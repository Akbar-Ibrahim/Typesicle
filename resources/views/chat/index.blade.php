@extends('layouts.home')

@section('styles')


<style>

.panel-body {
    overflow-y: scroll;
    height: 150px;
}

::-webkit-scrollbar-track {
    -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
    background-color: #F5F5F5;
}

::-webkit-scrollbar {
    width: 12px;
    background-color: #F5F5F5;
}

::-webkit-scrollbar-thumb {
    -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, .3);
    background-color: #555;
}
</style>
@endsection

@section('content')
<div id="spinner" class="w3-container w3-center" style="margin-top: 200px;">
    <div class="spinner-border"></div>
</div>
<div class="" id="wrapper" style="display: none;">
    <chat-component status="{{ $chatted }}" me="{{ json_encode(Auth::user()) }}" users="{{ json_encode($users) }}"
        chatting-with="{{ json_encode($user) }}"></chat-component>
</div>

@endsection

<script>
delayChatArea();

function delayChatArea() {
    setTimeout(showChat, 2000);
}

function showChat() {
    document.getElementById("spinner").style.display = "none";
    document.getElementById("wrapper").style.display = "block";
}
</script>

@section('scripts')


@endsection