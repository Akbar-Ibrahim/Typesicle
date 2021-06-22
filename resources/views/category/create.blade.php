@extends('layouts.home')


@section('styles')

<style>
.content {
    max-width: 600px;
    margin: auto;
}
</style>


@endsection

@section('content')

<div class="w3-container content ">
<div class="w3-row">


<div class="">
<createcategory-component username="{{ Auth::user()->username }}"></createcategory-component>
</div>



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