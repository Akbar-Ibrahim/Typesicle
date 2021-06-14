@extends('layouts.home')

@section('styles')

<style>
/* Full-width input fields */
input[type=text],
input[type=password] {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
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
}

button:hover {
    opacity: 0.8;
}


/* Center the image and position the close button */
/* .imgcontainer {
    text-align: center;
    margin: 24px 0 12px 0;
    position: relative;
} */

img.avatar {
    width: 40%;
    border-radius: 50%;
}
</style>

@endsection


@section('content')

<div class="w3-container">
    <div class="w3-container">
        <div class="w3-container" style="width: 50%; margin: auto;">

            <div class="w3-container w3-margin-bottom w3-center">
                <h3> Create Group </h3>
            </div>

            <form method="POST" action="/group-create">
                @csrf
                <!-- 
            <div class="imgcontainer">
                <img src="img_avatar2.png" alt="Avatar" class="avatar">
            </div> 
-->

                <div class="w3-container">
                    <label for="name"><b>Group Name</b></label>
                    <input type="text" placeholder="Group name" name="name" required>

                    <label for="description"><b>Description</b></label>
                    <input type="text" placeholder="Enter Password" name="description">

                    <button type="submit">Create Group</button>

                </div>

            </form>
        </div>
    </div>
</div>



@endsection

@section('scripts')


@endsection