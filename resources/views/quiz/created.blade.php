@foreach($questions as $question)
<div class="quizWrap w3-border w3-margin-bottom" style="border-radius: 20px;">
    <div class="w3-container quizBox" unique_id="{{ $question->id }}">
        <div class="w3-row-padding">
            <div class="w3-col s11">


                <div class="quizContainer w3-margin">
                    <div class="w3-container" style="margin-bottom: 30px;">
                        <div class="questionBox" style="margin-bottom: 30px;">
                            <input style="display: none;" class="unique" type="text" value="{{ $question->id ?? '' }}">
                            <h4 class="questionHeader" style="display: none;"></h4>
                            <input class="question requiredQuestionInput" style="width: 80%;" type="text"
                                placeholder="Question" value="{{ $question->question }}">
                            <p class="inputError emptyQuestionError" style="display: none;"></p>

                            @if($question->image)
                            <img src="{{ $question->image }}" class="w3-border questionImage" alt="" width="100%"
                                height="400px" onclick="showImage(this)" style="object-fit: cover; ">
                            @endif
                        </div>
                        <textarea style="display: none;" class="imageString">  </textarea>

                        <div class="options">
                            <div class="w3-margin-bottom">
                                <input {{ $question->option_one == $question->correct_answer ? 'checked' : '' }}
                                    class="optionRadio" type="radio" name="myChoice{{ $question->id ?? '' }}"
                                    value="optionRadio1">
                                <input class="option requiredQuestionInput optionInput" type="text"
                                    placeholder="option1" value="{{ $question->option_one }}"> <label
                                    class="optionLabel" style="display:none" for=""></label>
                            </div>
                            <div class="w3-margin-bottom">
                                <input {{ $question->option_two == $question->correct_answer ? 'checked' : '' }}
                                    class="optionRadio" type="radio" name="myChoice{{ $question->id ?? '' }}"
                                    value="optionRadio2">
                                <input class="option requiredQuestionInput optionInput" type="text"
                                    placeholder="option2" value="{{ $question->option_two }}"> <label
                                    class="optionLabel" style="display:none" for=""></label>
                            </div>
                            <div class="w3-margin-bottom">
                                <input {{ $question->option_three == $question->correct_answer ? 'checked' : '' }}
                                    class="optionRadio" type="radio" name="myChoice{{ $question->id ?? '' }}"
                                    value="optionRadio3">
                                <input class="option requiredQuestionInput optionInput" type="text"
                                    placeholder="option3" value="{{ $question->option_three }}"> <label
                                    class="optionLabel" style="display:none" for=""></label>
                            </div>
                            <div class="w3-margin-bottom">
                                <input {{ $question->option_four == $question->correct_answer ? 'checked' : '' }}
                                    class="optionRadio" type="radio" name="myChoice{{ $question->id ?? '' }}"
                                    value="optionRadio4">
                                <input class="option requiredQuestionInput optionInput" type="text"
                                    placeholder="option4" value="{{ $question->option_four }}"> <label
                                    class="optionLabel" style="display:none" for=""></label>
                            </div>
                            <p class="inputError missingOptionError" style="display: none;"></p>
                            <p class="inputError uniqueOptionError" style="display: none;"></p>
                            <p class="uncheckedOptionError" style="display: none;"></p>

                            <input style='display: none;' class='choice' type='text' value='choice'>

                            <input style='display: none;' class='correct-answer-hidden requiredQuestionInput option'
                                type='text' value='{{ $question->correct_answer }}'><br>

                        </div>

                    </div>
                </div>


                <div class="quizScaffolding">
                    <textarea style="display: none;" class="quizSource" cols="50" rows="10"></textarea>
                </div>

                <div class="w3-container">
                    <div class="w3-right">
                        <input style="cursor: pointer; float: left;" class="done w3-padding w3-border" type="button"
                            value="Done">
                        <input style="cursor: pointer; float: left;" class="addQuiz w3-padding w3-border"
                            type="button" value="+">
                    </div>
                </div>

            </div>


            <div class="w3-col s1">
                <div class="w3-margin-bottom w3-margin-top w3-center" style="">
                    <!-- <input style="cursor: pointer;" type="button" class="remove" value="X"> -->
                    <button style="display: none;" class="w3-button remove"> <i class="far fa fa-times"></i> </button>
                </div>

                <div>
                    <input style="display: none;" id="upload_pic" class="upload_pic" type="file"
                        onchange="encodeImagetoBase64(this)">
                    <button class="w3-button clickFileUpload"><i class="fas fa fa-image"></i></button>
                </div>
            </div>

        </div>
    </div>

</div>



@endforeach