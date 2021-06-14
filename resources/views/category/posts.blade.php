@extends('layouts.home')


@section('styles')

<link href="{{ asset('css/search-dropdown.css') }}" rel="stylesheet">

@endsection

@section('content')

<div class="w3-cont">
    <div class="w3-row-padding">
        <div class="w3-twothird w3-margin">

            <div class="w3-container">
                <h3> Category | {{ $category->name }} by <a
                        href="{{ route('profile.show', $category->user->username) }}">
                        {{ $category->user->name }} </a> </h3>
            </div>


            
            <div class="w3-container">
            <post-parent-component articles="{{ json_encode($feeds) }}" user-id="{{ Auth::check() ? Auth::user()->id : -1 }}"
                    user="{{ json_encode($user) }}" user-type="{{ Auth::check() ? 'auth' : 'guest' }}">
                        </post-parent-component>
            </div>

            

        </div>

        <div class="w3-third">
        
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
$(document).ready(function() {
    

    

});

// var categoryList = document.getElementByClassNames("category-list");
</script>

@endsection