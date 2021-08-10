<!DOCTYPE html>

<html>

<head>

    <title>Laravel Ajax Multiple Image Upload with Preview Example</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.min.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

    <style type="text/css">
    input[type=file] {

        display: inline;

    }

    #image_preview {

        border: 1px solid black;

        padding: 10px;

    }

    #image_preview img {

        width: 200px;

        padding: 5px;

    }
    </style>


</head>

<body>


    <div class="container">

        <h1>Laravel Ajax Multiple Image Upload with Preview Example</h1>

        <form action="{{ route('media.store') }}" method="post" enctype="multipart/form-data">

            @csrf

            <div class="w3-container w3-border">
                <input type="file" id="uploadFile1" name="uploadFile1" />
                <input type="file" id="uploadFile2" name="uploadFile2" style="display: none;" />
                <input type="file" id="uploadFile3" name="uploadFile3" style="display: none;" />
                <input type="file" id="uploadFile4" name="uploadFile4" style="display: none;" />
            </div>

            <input type="submit" class="btn btn-success" name='submitImage' value="Upload Image" />
            <div id="filesToSend"></div>

        </form>


        <br />

        <div id="image_preview"></div>

        <div class="w3-container">
            <div class="w3-row-padding">

                <div id="img_previewbox1" class="w3-col s3" style="display: none;">
                    <div class="w3-container">
                        <img id="img_preview1" src="" class="w3-border well-sm " alt="" height="200px" width="100%"
                            style="object-fit: cover">
                    </div>
                    <div class="w3-container">
                        <button id="removeImgPreview1" style="font-size: 30px;">x</button>
                    </div>
                </div>

                <div id="img_previewbox2" class="w3-col s3" style="; display: none;">
                    <div class="w3-container">
                        <img id="img_preview2" src="" class="w3-border well-sm " alt="" height="200px" width="100%"
                            style="object-fit: cover">
                    </div>
                    <div class="w3-container">
                        <button id="removeImgPreview2" style="font-size: 30px;">x</button>
                    </div>
                </div>

                <div id="img_previewbox3" class="w3-col s3" style="display: none;">
                    <div class="w3-container">
                        <img id="img_preview3" src="" class="w3-border well-sm " alt="" height="200px" width="100%"
                            style="object-fit: cover">
                    </div>
                    <div class="w3-container">
                        <button id="removeImgPreview3" style="font-size: 30px;">x</button>
                    </div>
                </div>


                <div id="img_previewbox4" class="w3-col s3" style="display: none;">
                    <div class="w3-container">
                        <img id="img_preview4" src="" class="w3-border well-sm " alt="" height="200px" width="100%"
                            style="object-fit: cover">
                    </div>
                    <div class="w3-container">
                        <button id="removeImgPreview4" style="font-size: 30px;">x</button>
                    </div>
                </div>



            </div>
        </div>

    </div>

</body>


<script src="{{ asset('js/shortie.js') }}" defer></script>

</html>