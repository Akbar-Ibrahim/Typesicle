@extends('layouts.home')


@section('styles')

<style>
.content {
    max-width: 800px;
    margin: auto;
}

input[type=text],
input[type=password] {
    width: 80%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
    border: none;
}
</style>


@endsection

@section('content')

<div class="w3-container content w3-border">
    <div class="w3-row">

        <!-- <div class="w3-col l4">


        </div> -->

        <h1> Edit Profile </h1>

        <div class="w3-col l12" style="margin-bottom: 100px;">

            <div class="w3-container " style="width: 60%; margin: auto;">
                <div id="image-preview-container" class="mb-4 w3-display-container w3-hide-small"
                    style="width: 50%; margin-left: auto; margin-right: auto; margin-top: 100px; ">
                    <img id="img_preview"
                        src="{{ $user->profile->picture == 'avatar.png' ? '/images/avatar.png' : '/images/'.$user->id.'/profile_pic/'.$user->profile->picture}}"
                        alt="" class="postImage " width="100%" height="200px" style="object-fit: cover; ">

                    <div id="removeCoverImage" class="w3-display-topright"
                        style="cursor: pointer; top: 8px; right: 16px; font-size: 37px;" class="top-right py-2 px-2">X
                    </div>
                </div>


                <div id="image-preview-container-small" class="mb-4 w3-display-container w3-hide-large"
                    style="margin-top: 100px;">
                    <img id="img_preview_small"
                        src="{{ $user->profile->picture == 'avatar.png' ? '/images/avatar.png' : '/images/'.$user->id.'/profile_pic/'.$user->profile->picture}}"
                        alt="" class="postImage " width="100%" height="200px" style="object-fit: cover; ">

                    <div id="removeCoverImageSmall" class="w3-display-topright"
                        style="cursor: pointer; top: 8px; right: 16px; font-size: 37px;" class="top-right py-2 px-2">X
                    </div>
                </div>

                <div class="w3-center">
                    <button class="w3-button " id="clickImageInput">Upload</button>
                </div>
            </div>




            <div class="" style="margin: auto; margin-top: 100px; border: 2px">
                <form action="{{ route('profile-edit') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <input type="file" class="form-control-file profile_pic " name="image" value="" id="upload_pic"
                        style="display: none;">
                    <input type="hidden" name="user_id" value="{{ $user->id }}"> <br>
                    <table style="width:100%">

                        <tr>
                            <td><label>Name</label< /td>
                            <td><input type="text" name="name" value="{{ $user->name }}"> <br></td>

                        </tr>
                        <tr>
                            <td><label>Username</label></td>
                            <td><input type="text" name="username" value="{{ str_replace('@', '', $user->username) }}">
                                <br>
                            </td>

                        </tr>
                        <tr>
                            <td><label>Bio</label></td>
                            <td>
                                
                                <textarea style="width: 100%; resize: none;"
                                    rows="5" class="py-2 px-2 " name="bio"> {{ $user->profile->bio ?? '' }} </textarea>
                            </td>
                        </tr>
                    </table>





                    <div class="my-4">Links</div>

                    <div>
                        <table style="width:100%">

                            <tr>

                                <td>Website</td>
                                <td><input type="text" name="website" placeholder="Website" value=""> <br></td>
                            </tr>
                            <tr>
                                <td><label>Facebook</label></td>
                                <td><input type="text" name="facebook" placeholder="Facebook" value=""> <br></td>
                            </tr>
                            <tr>
                                <td><label>Twitter</label></td>
                                <td><input type="text" name="twitter" placeholder="Twitter" value=""> <br></td>
                            </tr>
                            <tr>
                                <td>Instagram</td>
                                <td><input type="text" name="instagram" placeholder="Instagram" value=""> <br></td>
                            </tr>
                        </table>
                        
                    </div>

                    <div class="w3-margin-top w3-center">
                        <button class="w3-button" id="save">Save</button>
                    </div>
                </form>
            </div>

        </div>

    </div>
</div>

@endsection

@section('scripts')
<script src="{{ asset('js/preview-image.js') }}"></script>

<script>
$(document).ready(function() {
    $('#clickImageInput').click(function() {
        $("#upload_pic").click();
    });

    $('#removeCoverImage').click(function() {

        $('#img_preview').attr('src', '/images/avatar.png');
        $('#img_preview_small').attr('src', '/images/avatar.png');

        $("#upload_pic").val("");

    });

    $('#removeCoverImageSmall').click(function() {

        $('#img_preview').attr('src', '/images/avatar.png');
        $('#img_preview_small').attr('src', '/images/avatar.png');

        $("#upload_pic").val("");

    });


});
</script>


@endsection