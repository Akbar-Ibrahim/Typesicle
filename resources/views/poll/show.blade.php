<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="utf-8">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Play Quiz</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- <script src="{{ asset('js/app.js') }}" defer></script> -->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
    .pollChoices {
        width: 80%;
        text-align: center;
        color: black;
        font-size: 19px;
        border-radius: 50px;

    }

    .choiceContainer {
        margin-bottom: 20px;

    }

    body {
        background-color: white;
    }
    </style>

    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>


</head>

<body>

    <h1>Take Poll</h1>

    <div class="w3-container">
        <div class="w3-row-padding">
            <div class="w3-col l6 choices">

                <div class="w3-container my-4 py-4">
                    <h4 class="w3-center"> {{ $poll->question }} </h4>
                </div>

                <span id="voteStatus" hasVoted="{{ Auth::user()->hasVoted($poll->id) ? 'Yes' : 'No' }}"
                    class="d-none"></span>
                @if($myVote)
                <span id="myChoice" myChoice="{{ $myVote->my_choice }}"></span>
                @endif

                <form id="pollForm" method="POST" action="{{ route('poll.update', $poll->id) }}">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    <input id="poll" type="hidden" value="1">
                    <input id="poll_id" type="hidden" name="poll_id" value="{{ $poll->id }}">


                    <div class="w3-container w3-center">
                        <div class="w3-container w3-center choiceContainer">
                            <button class="pollChoices w3-button py-2" id="first_choice" myChoice="1">
                                {{ $poll->first_choice }}
                                <i class="d-none fas fa fa-check"></i>
                            </button>

                        </div>
                        <div class="w3-container w3-cente choiceContainer">
                            <button class="pollChoices w3-button py-2" id="second_choice" myChoice="2">
                                {{ $poll->second_choice }}
                                <i class="d-none fas fa fa-check"></i>
                            </button>

                        </div>
                        @if($poll->third_choice)
                        <div class="w3-container w3-center choiceContainer">
                            <button class="pollChoices w3-button py-2" id="third_choice" myChoice="3">
                                {{ $poll->third_choice }}
                                <i class="d-none fas fa fa-check"></i>
                            </button>

                        </div>
                        @endif

                        @if($poll->fourth_choice)
                        <div class="w3-container w3-center choiceContainer">
                            <button class="pollChoices w3-button py-2" id="fourth_choice" myChoice="4">
                                {{ $poll->fourth_choice }}
                                <i class="d-none fas fa fa-check"></i>
                            </button>

                        </div>
                        @endif
                    </div>
                </form>
            </div>

            <div class="w3-col l6">
                <h1>Poll Results</h1>

                @if($poll->total > 0)
                <div class="w3-container pollLabels">
                    <p count="{{ $poll->first_choice_total }}" id="1c-label"> {{ $poll->first_choice }} <span>
                            {{ $poll->first_choice_total/$poll->total * 1000 }} </span> </p>
                    <p count="{{ $poll->second_choice_total }}" id="2c-label"> {{ $poll->second_choice }} <span>
                            {{ $poll->second_choice_total/$poll->total * 1000 }} </span> </p>
                    @if($poll->third_choice)
                    <p count="{{ $poll->third_choice_total }}" id="3c-label"> {{ $poll->third_choice }} <span>
                            {{ $poll->third_choice_total/$poll->total * 1000 }} </span> </p>

                    @endif
                    @if($poll->fourth_choice)
                    <p count="{{ $poll->fourth_choice_total }}" id="4c-label"> {{ $poll->fourth_choice }} </p>
                    @endif
                </div>
                @endif
                <canvas id="myChart" width="100%" height="50"></canvas>
                <div class="w3-container">

                </div>

            </div>

        </div>
    </div>

</body>



<script>
$(document).ready(function() {

    $(".pollChoices").click(function() {
        $(this).parents("#pollForm").find("#poll").attr("name", $(this).attr("id"))
        $(this).find("i").removeClass("d-none")
    });

    if ($("#voteStatus").attr("hasVoted") == "Yes") {
        $(".pollChoices").css("pointer-events", "none")
    }

    // var pollChoices = document.getElementsByClassName("pollChoices")
    // var myChoice = document.getElementById("myChoice");
    // for (var i = 0; i < pollChoices.length; i++) {
    //     if (pollChoices[i].getAttribute("myChoice") == myChoice.getAttribute("myChoice")) {
    //         alert(pollChoices[i].getAttribute("myChoice"))
    //     }
    // }
    
    $( ".pollChoices" ).each(function(i) {
    if ($(this).attr("myChoice") == $("#myChoice").attr("myChoice") ) {
        $(this).find("i").removeClass("d-none")
        $(this).css("background-color", "green")
        $(this).css("color", "white")
        }
  });
    



    // $("button").click(function() {
    // $(this).parents(".choices").find("button").attr("disabled", true)
    // });

    // $("#firstChoice").click(function() {
    //     let firstChoiceCount = document.getElementById("firstChoiceCount").innerHTML;
    //     document.getElementById("firstChoiceCount").innerHTML = parseInt(firstChoiceCount) + 1;

    // });

});
</script>

<!-- <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>

<script>
var firstLabel = $("#1c-label").text();
var secondLabel = $("#2c-label").text();
var thirdLabel = $("#3c-label").text();
var fourthLabel = $("#4c-label").text();

var firstCount = $("#1c-label").attr("count");
var secondCount = $("#2c-label").attr("count");
var thirdCount = $("#3c-label").attr("count");
var fourthCount = $("#4c-label").attr("count");

var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [firstLabel, secondLabel, thirdLabel, fourthLabel],
        datasets: [{
            label: 'App stats',
            data: [firstCount, secondCount, thirdCount, fourthCount],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
</script>

</html>