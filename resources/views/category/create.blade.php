@extends('layouts.home')


@section('styles')

<link href="{{ asset('css/search-dropdown.css') }}" rel="stylesheet">

@endsection

@section('content')

<div class="w3-container w3-margin">

<div style="width: 60%; margin: auto;">
<createcategory-component username="{{ Auth::user()->username }}"></createcategory-component>
</div>

</div>

@endsection

@section('scripts')
<script>
$(document).ready(function() {
    $('#list').click(function() {

        $(".category-list").removeClass("w3-half");
        $("#seeMorePostsDropdown").css("width", "50%")
        $("#seeMorePostsDropdown").addClass("w3-left")

    });

    $('#grid').click(function() {

        $(".category-list").addClass("w3-half");
        $("#seeMorePostsDropdown").css("width", "100%")
        $("#seeMorePostsDropdown").removeClass("w3-left")
    });

    // if($(".category-list").hasClass("w3-half")){
    //     $("#grid").attr("disabled", true);
    // }

});

// var categoryList = document.getElementByClassNames("category-list");
</script>

@endsection