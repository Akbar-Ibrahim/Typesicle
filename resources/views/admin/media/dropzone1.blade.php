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

                <form method="POST" action="{{ route('media.store') }}" enctype="multipart/form-data" id="my-awesome-dropzone" class="dropzone">
                @csrf
  <div class="dropzone-previews"></div> <!-- this is were the previews should be shown. -->
  
  <!-- Now setup your input fields -->
  <input type="email" name="username" />
  <input type="password" name="password" />

  <button type="submit">Submit data and files!</button>
</form>




                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js">
</script> -->

<script>

 Dropzone.options.myAwesomeDropzone = { // The camelized version of the ID of the form element

// The configuration we've talked about above
autoProcessQueue: false,
uploadMultiple: true,
parallelUploads: 100,
maxFiles: 100,

// The setting up of the dropzone
init: function() {
  var myDropzone = this;

  // First change the button to actually tell Dropzone to process the queue.
  this.element.querySelector("button[type=submit]").addEventListener("click", function(e) {
    // Make sure that the form isn't actually being sent.
    e.preventDefault();
    e.stopPropagation();
    myDropzone.processQueue();
  });

  // Listen to the sendingmultiple event. In this case, it's the sendingmultiple event instead
  // of the sending event because uploadMultiple is set to true.
  this.on("sendingmultiple", function() {
    // Gets triggered when the form is actually being sent.
    // Hide the success button or the complete form.
  });
  this.on("successmultiple", function(files, response) {
    // Gets triggered when the files have successfully been sent.
    // Redirect user or notify of success.
  });
  this.on("errormultiple", function(files, response) {
    // Gets triggered when there was an error sending the files.
    // Maybe show form again, and notify user of error
  });
}
</script>

@endsection

