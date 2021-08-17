@extends('layouts.master')

@section('styles')
<style>
body {
    font-family: Arial, Helvetica, sans-serif;
}

* {
    box-sizing: border-box
}

/* Full-width input fields */
input[type=text],
input[type=email],
input[type=password] {
    width: 100%;
    padding: 15px;
    margin: 5px 0 22px 0;
    display: inline-block;
    border: none;
    background: #f1f1f1;
}

input[type=text]:focus,
input[type=password]:focus {
    background-color: #ddd;
    outline: none;
}

hr {
    border: 1px solid #f1f1f1;
    margin-bottom: 25px;
}

/* Set a style for all buttons */
button {
    background-color: #04AA6D;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
    opacity: 0.9;
}

button:hover {
    opacity: 1;
}

/* Extra styles for the cancel button */
.cancelbtn {
    padding: 14px 20px;
    background-color: #f44336;
}

/* Float cancel and signup buttons and add an equal width */
.cancelbtn,
.signupbtn {
    float: left;
    width: 50%;
}

/* Add padding to container elements */
.container {
    padding: 16px;
}

/* Clear floats */
.clearfix::after {
    content: "";
    clear: both;
    display: table;
}

/* Change styles for cancel button and signup button on extra small screens */
@media screen and (max-width: 300px) {

    .cancelbtn,
    .signupbtn {
        width: 100%;
    }
}

.content {
    max-width: 700px;
    margin: auto;
}
</style>
@endsection

@section('content')
<div class="w3-container content">

    <div class="w3-row">
    
        <div class="w3-container">
            <div class="">

                <div class="container w3-border">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="container">
                            <h1>Sign Up</h1>
                            <p>Please fill in this form to create an account.</p>
                            <hr>

                            <label for="name">{{ __('Name') }}</label>
                            <input id="name" type="text" class="@error('name') is-invalid @enderror" name="name"
                                value="{{ old('name') }}" required autocomplete="name" autofocus>

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                            <label for="username">{{ __('Username') }}</label>
                            <input id="username" type="text" class="@error('username') is-invalid @enderror"
                                name="username" value="{{ old('username') }}" required autocomplete="username"
                                autofocus>

                            @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                            <label for="email">{{ __('E-Mail Address') }}</label>
                            <input id="email" type="email" class="@error('email') is-invalid @enderror" name="email"
                                value="{{ old('email') }}" required autocomplete="email">

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <br><br>
                            <label for="password">{{ __('Password') }}</label>
                            <input id="password" type="password" class="@error('password') is-invalid @enderror"
                                name="password" required autocomplete="new-password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror


                            <label for="password-confirm">{{ __('Confirm Password') }}</label>
                            <input id="password-confirm" type="password" class="" name="password_confirmation" required
                                autocomplete="new-password">




                            <p>By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms &
                                    Privacy</a>.</p>

                            <div class="clearfix">
                                <button onclick="location.href='/register'" type="button"
                                    class="cancelbtn">Restart</button>
                                <button type="submit" class="signupbtn">Sign Up</button>
                            </div>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection