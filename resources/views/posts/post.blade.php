@extends('layouts.home')

@section('styles')
<style>

</style>
@endsection


@section('content')
@include('includes.urls')

<div class="w3-container">
    <div class="w3-row-padding" style="margin-top: 100px;">
        <div class="w3-col l8">
            <!-- Start of post div -->


            <div class="w3-container">
                <postsearch-component></postsearch-component>
            </div>

            <!-- Main Post/Article -->
            <div class="my-4 ">

                @if($feed)
                <div style="margin-bottom: 70px;">
                    <view-component post="{{ json_encode($feed) }}"
                        user-id="{{ auth()->check() ? auth()->user()->id : -1 }}" user="{{ json_encode($user) }}"
                        user-type="{{ auth()->check() ? 'auth' : 'guest' }}">
                    </view-component>
                </div>
                <hr>

                <div class="w3-container"
                    style="max-width: 600px; margin: auto; margin-top: 50px; margin-bottom: 50px;">
                    <div> Know someone who might enjoy reading this? Mail the post to them </div>
                    <form method="POST" action="{{ route('email-post') }}" class="emailPost">
                        @csrf
                        <input type="hidden" name="feed_id" value="{{ $feed->id }}">
                        <input type="hidden" name="post_id" value="{{ $feed->post->id }}">

                        <input class="py-1" type="email" name="recipient" placeholder="Enter email"
                            style="width: 80%; border: none; ">
                        <button style="background-color: #04AA6D; color: white;" class="emailPost btn btn-default">Send</button>
                    </form>
                </div>

                <div class="w3-container" style="margin-top: 50px; margin-bottom: 70px">
                    <div class="w3-container w3-padding">
                        <h4>Author</h4>
                    </div>
                    <div class="d-flex">
                        <div>
                            @if ($feed->user->profile->picture !== "avatar.png")
                            <img src="/images/{{ $feed->post->user->id }}/profile_pic/{{ $feed->post->user->profile->picture }}"
                                alt="" class="w3-circle" style="width: 105px; height: 105px;">
                            @else
                            <img src="/images/avatar.png" alt="" class="w3-circle" style="width: 105px; height: 105px;">
                            @endif
                        </div>

                        <div class="flex-grow-1 px-4">
                            <div style="font-size: 21px;" class="mt-2">
                                <a href="/{{ $user->username }}"> {{ $user->name }} </a>
                            </div>
                            <div>
                                {{ $user->profile->bio }}
                            </div>
                        </div>

                        @auth
                        @if ($user->profile->id !== Auth::user()->profile->id)
                        <div>
                            <follow-component user="{{ Auth::user()->id }}" profile="{{ $user }}"
                                status="{{ Auth::user()->isFollowing($user->profile->id) ? 1 : 0 }}">
                            </follow-component>
                        </div>
                        @endif
                        @endauth
                    </div>
                </div>
                @auth
                <div class="w3-container" style="max-width: 800px; margin: auto; margin-top: 100px;">
                    <div class="w3-row">
                        <div class="">
                            <form method="GET" action="{{ route('write.create') }}">
                                <input type="hidden" name="responding_to" value="{{ $feed->post->id }}">
                                <button style="font-size: 21px;" class="w3-button w3-padding"> Reply this post with one
                                    of
                                    yours</button>
                            </form>
                        </div>

                    </div>
                </div>
                @endauth
                @guest
                <div class="w3-containerw3-padding w3-center">
                    <a style="font-size: 23px; background-color: #04AA6D; color: white" href="/login" class="btn btn-default btn-large w3-text-white">Sign In to
                        drop
                        a comment</a>
                </div>

                @endauth
                <div class="w3-container my-4 " style="margin-top: 50px;">
                    <comment-container-component user-id="{{ auth()->check() ? auth()->user()->id : -1 }}"
                        authuser="{{ json_encode(Auth::user()) }}" post-id="{{ $feed->id }}"
                        comment-count="{{ count($feed->comments) }}">
                    </comment-container-component>


                    <!-- <comment-component user-id="{{ auth()->check() ? auth()->user()->id : -1 }}"
                        user="{{ json_encode(Auth::user()) }}" post-id="{{ $feed->id }}"
                        num-of-comments="{{ count($feed->comments) }}">
                    </comment-component> -->
                </div>
                @else
                <div>This post is no longer available</div>
                @endif
            </div>


            <!-- End of post div -->
        </div>


        <!--  -->
        <!--  -->
        <!--  -->
        <!--  -->
        <!--  -->


        <div class="w3-col l4 w3-hide-small w3-hide-medium">
            <div class="">
                <userrandompostexcept-component post-id="{{ $user->id }}" user-id="{{ $user->id }}">
                </userrandompostexcept-component>
            </div>

            <div class="w3-container w3-margin-top">
                <recentposts-component username="{{ $user->username }}" user-id="{{ $user->id }}"
                    posts="{{ json_encode($recentPosts) }}">
                </recentposts-component>
            </div>

            <div class="w3-container w3-margin-top ">
                <popular-component username="{{ $user->username }}" user-id="{{ $user->id }}">
                </popular-component>
            </div>

            @auth
            <div class="w3-container w3-margin-top">
                <accounts-component accounts="{{ json_encode($accounts) }}" username="{{ Auth::user()->username }}"
                    user-id="{{ Auth::user()->id }}" status="{{Auth::user()->isFollowing($user->profile->id) ? 1 : 0}}">
                </accounts-component>
            </div>
            @endauth
        </div>
    </div>
</div>


@endsection

@section('scripts')

<!-- <script src="{{ asset('js/emailPostOverlay.js') }}" defer></script> -->
<!-- <script src="{{ asset('js/modal.js') }}"></script> -->

@endsection