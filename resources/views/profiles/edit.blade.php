<html lang="en">

<head>

    <title>Edit Profile</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link href="{{ asset('css/w3-css.css') }}" rel="stylesheet">


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
    input[type=text],
    input[type=password] {
        width: 80%;
        padding: 12px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        box-sizing: border-box;
    }
    </style>

</head>


<body>

    <div class="w3-container">
        <div class="w3-row-padding">

            <div class="w3-container" style="width: 90%; margin: auto;">
                <div class="w3-quarter">

                    <div class="w3-container w3-right" style="width: 80%;">
                        <div id="image-preview-container" class="mb-4 w3-display-container w3-border"
                            style="margin-top: 100px;">
                            <img id="img_preview"
                                src="{{ $user->profile->picture == 'avatar.png' ? '/images/avatar.png' : '/images/'.$user->id.'/profile_pic/'.$user->profile->picture}}"
                                alt="" class="postImage " width="100%" height="200px" style="object-fit: cover; ">
                            <div id="removeCoverImage" class="w3-display-topright"
                                style="cursor: pointer; top: 8px; right: 16px; font-size: 37px;"
                                class="top-right py-2 px-2">X
                            </div>
                        </div>
                        <button id="clickImageInput" >Upload</button>
                    </div>

                </div>

                <div class="w3-threequarter">
                    <div class="w3-container" style="width: 80%; margin: auto; margin-top: 100px;">
                        <form action="{{ route('profile-edit') }}" method="post" enctype="multipart/form-data">
                            @csrf

                            <input type="file" class="form-control-file profile_pic " name="image" value=""
                                id="upload_pic" style="display: none;">

                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                            <input type="text" name="name" value="{{ $user->name }}">
                            <input type="text" name="username" value="{{ str_replace('@', '', $user->username) }}">
                            <input type="text" name="bio" value="{{ $user->profile->bio }}">



                            <div class="my-4">Links</div>
                            
                            <div>
                                <input type="text" name="website" placeholder="Website" value="">
                                <input type="text" name="facebook" placeholder="Facebook" value="">
                                <input type="text" name="twitter" placeholder="Twitter" value="">
                                <input type="text" name="instagram" placeholder="Instagram" value="">
                            </div>

                            <div class="w3-margin-top">
                                <button id="save">Save</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

</body>
<script src="{{ asset('js/preview-image.js') }}"></script>

<script>
$(document).ready(function() {
    $('#clickImageInput').click(function() {
        $("#upload_pic").click();
    });
});
</script>

</html>