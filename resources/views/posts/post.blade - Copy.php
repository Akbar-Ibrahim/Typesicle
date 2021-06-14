@extends('layouts.home')

@section('styles')

@endsection


@section('content')
@include('includes.urls')

<div class="w3-container">
    <div class="w3-row-padding">
        <div class="w3-twothird">
            <!-- Start of post div -->

            @guest

            @else
            <div>
                <a href="{{ route('profile.show', Auth::user()->username) }}"> Back to profile </a>
            </div>
            @endauth




            <div class="w3-container my-4">
                <postsearch-component></postsearch-component>
            </div>

            <!-- Main Post/Article -->
            <div class="w3-container my-4">
                <div class="w3-container">
                    @if($feed->post)



                    @if($feed->repost_message)
                    <div class="w3-container">

                        <div class="d-flex ">
                            <div class="px-2">
                                <a href="{{ route('profile.show', $feed->user->username) }}">
                                    @if($feed->user->profile->picture == 'avatar.png')
                                    <img src="/images/avatar.png" alt="Avatar" class="w3-center w3-circle w3-border "
                                        style="width:35px">
                                    @else
                                    <img src="/images/{{ $feed->user->id }}/profile_pic/{{ $feed->user->profile->picture }}"
                                        alt="Avatar" class="w3-center w3-circle w3-border " style="width:35px">
                                    @endif
                                </a>
                            </div>

                            <div class="flex-grow-1">
                                <div><a href="{{ route('profile.show', $feed->user->username) }}">
                                        {{ $feed->user->name }}
                                    </a>
                                </div>

                                <div>
                                    <div class="d-flex ">
                                        <div style="font-size: 12px;" class="w3-opacity pr-2 pr-1">
                                            {{ $feed->created_at->toFormattedDateString() }} </div>

                                    </div>
                                </div>

                            </div>
                        </div>


                        <hr class="w3-clear">

                        <!-- If article is a published response -->

                        @if($feed->post->responding_to > 0)
                        <div class="w3-padding">In response to <a
                                href="{{ route('post.url', [$respondingTo->user->username, $respondingTo->url, $respondingTo->feed->id ]) }}">
                                {{ $feed->post->respondingTo($feed->post->responding_to)->title }} </a> by
                            <a href="{{ route('profile.show', $respondingTo->user->username) }}">
                                {{ $feed->post->respondingTo($feed->post->responding_to)->user->name }} </a>
                        </div>
                        @endif

                        
                        <div class="w3-container w3-padding w3-margin">
                            {!! $feed->repost_message !!}
                        </div>
                        @endif

                        

                        <div class="w3-container">

                            <div class="d-flex ">
                                <div class="px-2">
                                    <a href="{{ route('profile.show', $feed->user->username) }}">
                                        @if($feed->post->user->profile->picture == 'avatar.png')
                                        <img src="/images/avatar.png" alt="Avatar"
                                            class="w3-center w3-circle w3-border " style="width:35px">
                                        @else
                                        <img src="/images/{{ $feed->post->user_id }}/profile_pic/{{ $feed->post->user->profile->picture }}"
                                            alt="Avatar" class="w3-center w3-circle w3-border " style="width:35px">
                                        @endif
                                    </a>
                                </div>

                                <div class="flex-grow-1">
                                    <div><a href="{{ route('profile.show', $feed->post->user->username) }}">
                                            {{ $feed->post->user->name }}
                                        </a>
                                    </div>

                                    <div>
                                        <div class="d-flex ">
                                            <div style="font-size: 12px;" class="w3-opacity pr-2 pr-1">
                                                {{ $feed->post->created_at->toFormattedDateString() }} </div>

                                        </div>
                                    </div>

                                </div>
                            </div>

                            <hr class="w3-clear">

                            <div class="w3-container">
                                <h1 class="w3-hide-small"> {{ $feed->post->title }} </h1>
                                <h4 class="w3-hide-large"> {{ $feed->post->title }} </h4>
                                <div class="w3-hide-large">


                                </div>

                            </div>

                        </div>
                    </div>

                    <!-- If Reposted -->

                    @if($feed->thought)
                    <div class="w3-container my-4">
                        <div class="w3-container"> {{ $feed->user->name }} reposted this article with the text below
                        </div>
                        <hr class="w3-clear">
                        <div id="thought" class="w3-container">
                            {!! $feed->thought ?? '' !!}
                        </div>
                        <hr class="w3-clear">
                    </div>
                    @endif
                    <!-- Cover Image -->
                    @if($feed->post->photo)
                    <div class="w3-container my-4">
                        <div class="w3-center"> <img
                                src="{{ '/images/' . $feed->post->user->id . '/'. $feed->post->photo->photo }}"
                                width="100%"> </div>
                    </div>
                    @endif




                    <!-- Main Article -->

                    <div class="w3-container my-4">
                        {!! $feed->post->body !!}
                    </div>





                    <div class="w3-container w3-border my-4 py-4">
                        @auth

                        <div class="w3-col s3 w3-center">
                            <like-component :feed="{{ $feed->id }}" :userid="{{ Auth::user()->id }}"
                                :status="{{Auth::user()->isLiked($feed->id) ? 1 : 0}}"></like-component>
                        </div>
                        <div class="w3-col s3 ">
                            <repost-component :userid="{{ Auth::user()->id }}" :postid="{{ $feed->post->id }}"
                                :feedid="{{ $feed->id }}" :feed="`{{ $feed->post->title }}`"
                                :status="{{Auth::user()->isReposted($feed->id) ? 1 : 0}}"></repost-component>
                        </div>
                        <div class="w3-col s3">
                            <div class="w3-container w3-center">
                                <button onclick="emailPostOverlay(this)" class="w3-button"
                                    title="Email this article to a friend"> <i class="fas fa fa-envelope-square"></i>
                                </button>
                            </div>
                        </div>

                        @if($feed->status == "Original" || $feed->status == "Response")
                        <div class="w3-col s3 w3-center">
                            <form action="/write/create">

                                <input type="hidden" name="inResponseTo" value="{{ $feedp->post_id }}">

                                <button class="w3-button" title="Publish a reply to this article"> <i
                                        class="fas fa fa-reply"></i> </button>
                            </form>
                        </div>
                        @endif
                        @endauth
                    </div>


                    <div class="w3-container">
                        <h4 class="w3-center"> More articles by {{ $feed->user->name }} </h4>
                        <div class="w3-container">
                            <div class="w3-row-padding">

                                @if($previous)
                                <div class="w3-col {{ !$next ? 's12' : 's6'}} w3-center">
                                    <a
                                        href="{{ route('post.url', [$previous->user->username, $previous->url, $previous->feed->id]) }}">
                                        <div class="previous_post">❮ Previous post </div>
                                        <div class="previous_post"> {{ $previous->title }} </div>
                                    </a>
                                </div>
                                @endif

                                @if($next)
                                <div class="w3-col {{ !$previous ? 's12' : 's6'}} w3-center ">
                                    <a
                                        href="{{ route('post.url', [$next->user->username, $next->url, $next->feed->id]) }}">
                                        <div class="next_post"> Next post ❯</div>
                                        <div class="next_post"> {{ $next->title }} </div>
                                    </a>
                                </div>
                                @endif

                            </div>
                        </div>

                    </div>



                    <div class="w3-container my-4 ">
                        <comment-component user-id="{{ auth()->check() ? auth()->user()->id : -1 }}"
                            post-id="{{ $feed->id }}">
                        </comment-component>
                    </div>

                    @else
                    <div class="w3-container">
                        This post has been deleted
                    </div>
                    @endif
                    </di>
                </div>


                <!-- End of post div -->
            </div>


            <!--  -->
            <!--  -->
            <!--  -->
            <!--  -->
            <!--  -->


            <div class="w3-third">
                <div class="w3-container w3-margin w3-padding">
                    <userrandompostexcept-component post-id="{{ $feed->id }}" user-id="{{ $user->id }}">
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
                    <accounts-component username="{{ Auth::user()->username }}" user-id="{{ Auth::user()->id }}"
                        status="{{Auth::user()->isFollowing($user->profile->id) ? 1 : 0}}">
                    </accounts-component>
                </div>
                @endauth
            </div>
        </div>
    </div>


    <!-- Modal for full size images on click -->
    <div id="emailPostOverlay" class="w3-modal w3-black" style="padding-top: 0; z-index: 7;">
        <div class="d-flex">
            <div class="flex-grow-1">
            </div>
            <div onclick="document.getElementById('emailPostOverlay').style.display='none'"
                style="font-size: 25px; cursor: pointer;" class="w3-button w3-black w3-xlarge "> &times;</div>
        </div>
        <div class="w3-modal-content w3-animate-zoom w3-center w3-transparent w3-padding-64">

            <div class="w3-container my-4">
                <div> Email this article to a friend </div>
                <form method="POST" action="{{ route('email-post') }}">
                    @csrf
                    <input type="hidden" name="title" value="{{ $feed->post->title }}">
                    <input type="hidden" name="id" value="{{ $feed->id }}">
                    <input type="hidden" name="url" value="{{ $feed->post->url }}">
                    <input type="hidden" name="author" value="{{ $feed->user->username }}">
                    <input type="hidden" name="body" value="{{ $feed->post->body }}">

                    <input class="py-1" type="email" name="recipient" placeholder="Enter email"
                        style="width: 30%; border: none; ">
                    <button class="emailPost w3-button">Send</button>
                </form>
            </div>



        </div>
    </div>

    @endsection

    @section('scripts')
    <script src="{{ asset('js/emailPostOverlay.js') }}" defer></script>


    <script src="{{ asset('js/modal.js') }}"></script>


    @endsection