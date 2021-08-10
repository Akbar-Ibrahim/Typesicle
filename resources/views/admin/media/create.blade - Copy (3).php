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
                    <form action="{{ route("media.store") }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        <input type="text" id="firstname" name="firstname" />
                        <input type="text" id="lastname" name="lastname" />
                        <div class="dropzone" id="myDropzone"></div>
                        <button type="submit" id="submit-all"> upload </button>
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
Dropzone.options.myDropzone = {
    url: '{{ route("media.store") }}',
    autoProcessQueue: false,
    uploadMultiple: true,
    parallelUploads: 5,
    maxFiles: 5,
    maxFilesize: 1,
    acceptedFiles: 'image/*',
    addRemoveLinks: true,
    init: function() {
        dzClosure = this; // Makes sure that 'this' is understood inside the functions below.

        // for Dropzone to process the queue (instead of default form behavior):
        document.getElementById("submit-all").addEventListener("click", function(e) {
            // Make sure that the form isn't actually being sent.
            // e.preventDefault();
            e.stopPropagation();
            dzClosure.processQueue();
        });

        //send all the form data along with the files:
        this.on("sendingmultiple", function(data, xhr, formData) {
            formData.append("firstname", jQuery("#firstname").val());
            formData.append("lastname", jQuery("#lastname").val());
        });
    }
}
</script>
@endsection
