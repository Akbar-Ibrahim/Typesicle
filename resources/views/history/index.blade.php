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


<div class="w3-container content">
    <div class="w3-row">
        <div class="">

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
                <div class="w3-container w3-hide-small w3-hide-medium" style="width: 70%; margin: auto;">
                    <h2> You haven't read any posts yet </h2>
                    <h4>Start below</h4>
                    <random-post-component></random-post-component>
                </div>

                <div class="w3-container w3-hide-large" style="width: 70%; margin: auto;">
                    <h2 style="font-size: 70px;"> <b> You haven't read any posts yet </b> </h2>
                    <h4 style="font-size: 40px;">Start below</h4>
                    <random-post-component></random-post-component>
                </div>

                @endif


        </div>



    </div>

</div>


@endsection

@section('scripts')



@endsection