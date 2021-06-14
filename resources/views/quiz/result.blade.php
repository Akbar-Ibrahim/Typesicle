<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="utf-8">

    <title>Play Quiz</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
    /* label {
        border: 2px solid black;
    } */
    input {
        border: none;
    }

    .options {
        margin-bottom: 20px;
    }
    </style>

    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>


</head>

<body>

    <h1 class="w3-center"> {{ $quiz->name ?? '' }} </h1>
    

    <div class="w3-container">
        <div class="w3-row-padding">
            <div class="w3-col l6 w3-center">
                <h1> Total: {{ $stat->correct. '/' .$stat->total }} </h1>
                <h1> Correct Answers: {{ $stat->correct }} </h1>
                <h1> Wrong Answers: {{ $stat->wrong }} </h1>
                <h1> Unanswered: {{ $stat->unanswered }}  </h1>

            </div>

            <div class="w3-col l6">

            </div>
        </div>
    </div>
    
</body>
<script src="{{ asset('js/profiles.js') }}" defer></script>


</html>