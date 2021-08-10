
@extends('layouts.admin')

@section('styles')

<link rel="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" class="css">
<link href="{{ asset('css/dropzone.css') }}" rel="stylesheet">

@endsection


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Upload Media') }}</div>

                <div class="card-body">

                    <form method="post" action="{{ route('media.store') }}" enctype="multipart/form-data"
                        class="dropzone" id="my-dropzone">
                        @csrf

                    </form>
                    <button class="btn btn-primary" id="submit-all">Submit all files</button>
                    <!-- <button id="uploadFile">Upload Files</button> -->
                    <!-- 
                    {!! Form::open(['method'=> 'Post', 'action'=>'AdminMediaController@store', 'files' => true, 'class'
                    => 'dropzone'])
                    !!}

                    

                    {!! Form::close() !!} -->


                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js">
</script> -->

<script type="text/javascript">
//  Dropzone.autoDiscover = false;

// var myDropzone = new Dropzone(".dropzone", {

//     autoProcessQueue: false,

//     maxFilesize: 1,

//     acceptedFiles: ".jpeg,.jpg,.png,.gif"

// });


// $(document).ready(function() {
// $('#uploadFile').click(function() {


//     alert("hello")

// });
// });
</script>

@endsection