<html lang="en">

<head>

    <title>Edit Profile</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.js"></script>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('css/w3-css.css') }}" rel="stylesheet">

<style>
img {
    display: block;
    max-width: 100%;
}
</style>
</head>


<body>

    <div class="container">

        <div class="panel panel-info">



            <div class="panel-body">


                <div class="row">

                    <div class="col-md-4 text-center">

                        <button onclick="document.getElementById('id01').style.display='block'" class="w3-button">Open
                            Modal</button>


                         <div id="id01" class="w3-modal">
                            <div class="w3-modal-content">
                                <div class="w3-container m">
                                    <span onclick="document.getElementById('id01').style.display='none'"
                                        class="w3-button w3-display-topright">&times;</span>
                                    <p id="m-after">Some text in the Modal..</p>  
                                    <div id="upload-demo"></div>
                                  </div>
                            </div>
                        </div>  



                    </div>

                    <div class="col-md-4" style="padding:5%;">


                        <input class="d-none" type="file" id="image">


                        <button id="upload">Upload</button>
                        <button id="crop">Crop</button>
                        <button id="cropped" class="d-none btn btn-primary btn-block upload-image"
                            style="margin-top:2%">Cropped</button>
                        <form id="myShorties" action="{{ route('upload.image') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <input class="d-none" type="file" id="profile_picture" name="profile_picture">
                            <button id="uncropped" class="d-none btn btn-primary btn-block"
                                style="margin-top:2%">Uncropped</button>
                        </form>
                        <div class="container">
                            <button id="save-cropped" class="btn btn-primary btn-block">Save Cropped</button>
                            <button id="save-uncropped" class="btn btn-primary btn-block">Save Uncropped</button>
                        </div>

                    </div>


                    <div class="col-md-4">

                        <div id="preview-crop-image"
                            style="background:#9d9d9d;width:300px;padding:50px 50px;height:300px;"></div>

                    </div>

                </div>


            </div>

        </div>

    </div>


    <script type="text/javascript">
    $.ajaxSetup({

        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

    });


    var resize = $('#upload-demo').croppie({

        enableExif: true,

        enableOrientation: true,

        viewport: {

            width: 200,

            height: 200,

            type: 'circle'

        },

        boundary: {

            width: 300,

            height: 300

        }

    });


    $('#image').on('change', function() {
        
        

        var reader = new FileReader();

        reader.onload = function(e) {

            resize.croppie('bind', {

                url: e.target.result

            }).then(function() {

                console.log('jQuery bind complete');

            });

        }

        reader.readAsDataURL(this.files[0]);

        document.getElementById("profile_picture").files = this.files;
    });


    $('.upload-image').on('click', function(ev) {

        resize.croppie('result', {

            type: 'canvas',

            size: 'viewport'

        }).then(function(img) {

            $.ajax({

                url: "{{route('upload.image')}}",

                type: "POST",

                data: {
                    "image": img
                },

                success: function(data) {

                    html = '<img src="' + img + '" />';

                    $("#preview-crop-image").html(html);

                }

            });

        });

    });

    $("#save-cropped").click(function() {
        if (document.getElementById("image").files.length > 0) {
            $("#cropped").click();
            // location.href = '/home';
        }
    });

    $("#save-uncropped").click(function() {
        if (document.getElementById("profile_picture").files.length > 0) {
            $("#uncropped").click();
        }
    });

    $("#upload").click(function() {
        $("#image").click();
    });

    $("#save-cropped").attr("disabled", true);
    $("#save-uncropped").attr("disabled", true);
    $(document).on("change", "#image", function() {
        // if (document.getElementById("profile_picture").files.length == 0) {

        // } else {
        $("#save-cropped").attr("disabled", false);
        $("#save-uncropped").attr("disabled", false);
        // }

        $("#crop").click(function(){
            $("#id01").css("display", "block");
        });
    });
    </script>


</body>

</html>