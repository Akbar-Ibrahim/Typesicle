@extends('layouts.home')


@section('styles')

<link href="{{ asset('css/search-dropdown.css') }}" rel="stylesheet">

@endsection

@section('content')

<div class="w3-container w3-margin">

    <header class="w3-container mb-4 py-4" style="padding-top:22px">
        <!-- <h5><b><i class="fa fa-dashboard"></i> My Dashboard</b></h5> -->
        <h5><b><i class="fa fa-list-alt"></i> All Categories</b></h5>
    </header>

    @auth
    <div class="w3-container w3-margin w3-padding">
        <button class="w3-padding" route="{{ route('category.create') }}"
            onclick="location.href=this.getAttribute('route')">Create
            Category</button>
    </div>
    @endauth

    <div class="w3-container">

        <div class="w3-hide-small">

            @if(count($categories) > 0)
            <table class="w3-table w3-bordered">
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                @foreach($categories as $category)
                <tr>
                    <td style="width: 30%"> <a
                            href="{{ route('category-name', [$category->user->username, $category->url]) }}">
                            {{ $category->name }} </a> </td>
                    <td> <a href="{{ route('category-name', [$category->user->username, $category->url]) }}">
                            {{ count($category->posts) }} {{ count($category->posts) == 1 ? ' post' : ' posts' }}
                        </a>
                    </td>
                    <td>
                        <img src="/images/{{ $category->user->id }}/profile_pic/{{ $category->user->profile->picture }}"
                            alt="" style="width:35px;" class="w3-circle">
                        <a href="{{ route('profile.show', $category->user->username) }}">
                            {{ $category->user->name }}
                        </a>

                    </td>
                </tr>
                @endforeach
            </table>
            @else

            <div class="w3-container">
                <h5 class="w3-center mt-4 pt-4"> No categories :) </h5>
            </div>
            @endif

        </div>

    </div>

    <div class="w3-container w3-hide-large">
        @if(count($categories) > 0)
        @foreach($categories as $category)
        <div class="d-flex py-1">
            <div class="flex-grow-1">
                <a href="{{ route('category-name', [$category->user->username, $category->url]) }}">
                    {{ $category->name }} </a>
            </div>
            <div> {{ count($category->posts) }} {{ count($category->posts) == 1 ? ' post' : ' posts' }} </div>
        </div>
        @endforeach
        @endif

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