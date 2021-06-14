@extends('layouts.home')

@section('styles')

<link href="{{ asset('css/shortie.css') }}" rel="stylesheet">
<style>
input {
    border: none;
    padding: 16px 0px 16px 16px;
    width: 100%;
    font-size: 21px;
}
</style>
@endsection


@section('content')



    <h1>Create Poll</h1>
    <div class="w3-container">
        <div class="w3-row-padding">
            <div class="w3-col l6">
                <form method="POST" action="{{ route('poll.store') }}">
                    @csrf
                    <div class="w3-container w3-margin">
                        <textarea name="question" id="" cols="50" rows="5"></textarea>
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    </div>

                    <div class="w3-container choices w3-border w3-margin">
                        <input class="choice" position="1" placeholder="First choice" type="text" name="first_choice">
                        <input class="choice" position="2" placeholder="Second choice" type="text" name="second_choice">
                        <input id="thirdChoice" style="display: none;" class="choice" position="1"
                            placeholder="Third choice" type="text" name="third_choice">
                        <input id="fourthChoice" style="display: none;" class="choice" position="2"
                            placeholder="Fourth choice" type="text" name="fourth_choice">
                    </div>

                    <div class="w3-container w3-center">
                        <button>Create poll</button>
                    </div>
                </form>
                <div class="addPollContainer">
                    <button id="addChoice" style="font-size: 21px; cursor: pointer;"
                        class="w3-right w3-margin-right w3-circle w3-padding">+</button>
                </div>
            </div>



            <div class="w3-col l6">
                Poll results
            </div>
        </div>
    </div>

@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script>
$(document).ready(function() {

    $("#addChoice").click(function() {


        if ($("#thirdChoice").css("display") == "none") {
            $("#thirdChoice").css("display", "block");
        } else if ($("#thirdChoice").css("display") == "block") {
            $("#fourthChoice").css("display", "block");
            $(this).css("display", "none")
        }

    });


});
</script>
<script src="{{ asset('js/autosize.min.js') }}"></script>
<script>
autosize(document.querySelector('textarea'));
</script>
@endsection