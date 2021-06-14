<div class="w3-container content">
    <div class="w3-row-padding">
        <div class="w3-col m8">


            <!-- Post search -->
            <div class="w3-container w3-margin w3-padding">
                <postsearch-component></postsearch-component>
            </div>


            <!-- Profile -->


            <!-- <h1 class="w3-center" id="loader" style="font-size: 60px;">...</h1> -->
            <div id="profile-main">



                @if($feeds)
                <div style="margin-top: 50px;">
                    @foreach($feeds as $feed)
                    @if($feed->post)
                    @if($feed->post->is_published == "yes")
                    <div style="margin-top: 50px;">
                        
                        

                        <post-component feed-Id="{{ $feed->id}}" user-id="{{ Auth::user()->id }}"
                            post="{{ json_encode($feed) }}" user="{{ $feed->user }}"
                            date="{{ $feed->created_at->toFormattedDateString() }}" size="width: 35px">

                            <template v-slot:action>
                            @include('includes.feedActions')
                            </template>
                        </post-component>


                        



                    </div>
@endif
                    @elseif($feed->status == 'Shortie')
                    <div class="" style="margin-top: 50px;">
                        <header-component user="{{ json_encode($feed->shortie->user) }}"
                            date="{{ $feed->shortie->created_at->toFormattedDateString() }}" size="width: 35px">
                        </header-component>

                        <shortie-component shortie-id="{{ $feed->shortie_id }}" user-id="{{ Auth::user()->id }}"
                            shortie="{{ json_encode($feed->shortie) }}" @if($feed->shortie->thread)
                            route="{{ route('shortie.url', [$feed->user->username, $feed->shortie->thread->feed->id])  }}#{{ $feed->shortie_id }}"
                            @else
                            route="{{ route('shortie.url', [$feed->user->username, $feed->id])  }}"
                            @endif
                            height="{{ count($feed->shortie->shortiePhoto) == 1 ? '500px' : '250px' }}"
                            smallscreen-height="{{ count($feed->shortie->shortiePhoto) == 1 ? '300px' : '150px' }}">

                        </shortie-component>

                        @if($feed->shortie->quoted > 0)
                        <div class="mb-4 w3-margin-top " style="width: 80%; margin: auto;">
                            <header-component
                                user="{{ json_encode($feed->shortie->quotedShortie->user) }}"
                                date="{{ $feed->shortie->quotedShortie->created_at->toFormattedDateString() }}"
                                size="width: 25px" fontsize="font-size: 11px;">
                            </header-component>

                            <shortie-component shortie-id="{{ $feed->shortie->quotedShortie->id }}"
                                route="{{ route('shortie.url', [$feed->shortie->quotedShortie->user->username, $feed->shortie->quotedShortie->feed->id]) }}"
                                user-id="{{ $feed->shortie->quotedShortie->user->id }}"
                                shortie="{{ json_encode($feed->shortie->quotedShortie) }}"
                                height="{{ count($feed->shortie->quotedShortie->shortiePhoto) == 1 ? '450px' : '200px' }}"
                                smallscreen-height="{{ count($feed->shortie->quotedShortie->shortiePhoto) == 1 ? '250px' : '100px' }}">

                            </shortie-component>
                        </div>
                        @endif
                        @if($feed->shortie->thread)
                        <div class="w3-padding"
                            route="{{ route('shortie.url', [$feed->shortie->user->username, $feed->shortie->thread->feed->id]) }}"
                            onclick="location.href=this.getAttribute('route')" style="cursor: pointer;">
                            Read Thread
                        </div>
                        @endif

                        <div class="w3-margin">
                            <shortieoptions-component quoted="{{ $feed->shortie_id }}"
                                shortie-id="{{ $feed->shortie_id }}">
                                @csrf
                            </shortieoptions-component>
                        </div>
                    </div>

                    @elseif($feed->thread)
                    <thread-component thread-id="{{ $feed->thread->id }}">


                        <template v-slot:initial>
                            @foreach($feed->thread->shorties as $shortie)

                            @if($loop->index < 2) <header-component user="{{ json_encode($feed->user) }}"
                                user-id="{{ $feed->user_id }}" date="{{ $feed->created_at->toFormattedDateString() }}"
                                size="width: 35px">
                                </header-component>
                                <shortie-component shortie="{{ json_encode($shortie) }}"
                                    route="{{ route('shortie.url', [$feed->user->username, $shortie->thread->feed->id])  }}"
                                    height="{{ count($shortie->shortiePhoto) == 1 ? '500px' : '250px' }}"
                                    smallscreen-height="{{ count($shortie->shortiePhoto) == 1 ? '300px' : '150px' }}">
                                </shortie-component>

                                @if($shortie->quoted > 0)
                                <div class="mb-4 w3-margin-top w3-border" style="width: 80%; margin: auto;">
                                    <header-component user="{{ json_encode($shortie->quotedShortie->user) }}"
                                        date="{{ $shortie->quotedShortie->created_at->toFormattedDateString() }}"
                                        size="width: 25px" fontsize="font-size: 11px;">
                                    </header-component>

                                    <shortie-component
                                        route="{{ route('shortie.url', [$shortie->quotedShortie->user->username, $feed->thread->shorties[0]->quotedShortie->feed->id]) }}"
                                        shortie="{{ json_encode($shortie->quotedShortie) }}"
                                        height="{{ count($shortie->quotedShortie) == 1 ? '500px' : '250px' }}"
                                        smallscreen-height="{{ count($shortie->quotedShortie->shortiePhoto) == 1 ? '250px' : '100px' }}">
                                    </shortie-component>
                                </div>
                                @endif

                                <shortieoptions-component quoted="{{ $shortie->id }}"
                                    shortie-id="{{ $shortie->id }}">
                                    @csrf
                                </shortieoptions-component>
                                @endif
                                @endforeach
                        </template>


                        <template v-slot:rest>
                            
                                @include('includes.thread')
                            
                        </template>

                    </thread-component>
                    @elseif($feed->quiz)
                    <div style="margin-top: 50px;">
                        <header-component username="{{ $feed->user->username }}" user-id="{{ $feed->user_id }}"
                            user="{{ json_encode($feed->user) }}" name="{{ $feed->user->name }}"
                            photo="/images/{{ $feed->user->id }}/profile_pic/{{ $feed->user->profile->picture }}"
                            date="{{ $feed->created_at->toFormattedDateString() }}" size="width: 35px">
                        </header-component>

                        <quiz-component username="{{ $feed->user->username }}" user-id="{{ $feed->user_id }}"
                            title="{{ $feed->quiz->title }}" description="{{ $feed->quiz->description }}"
                            route="{{ route('quiz.show', [$feed->quiz->id]) }}" quiz-id="{{ $feed->quiz->id }}">
                        </quiz-component>
                    </div>
                    @endif


                    @endforeach
                    @endif
                </div>

                <div>
                    <div class="w3-container w3-border w3-center">
                        {{ $feeds->links() }}
                    </div>
                </div>

                <!-- Hey -->
            </div>

        </div>

        <div class="w3-col m4 w3-hide-small">

            <div class="w3-container w3-center">

                <profile-component current-user="{{ $user->id }}" user-id="{{ Auth::user()->id }}"
                    user="{{ json_encode($user) }}" status="{{Auth::user()->isFollowing($user->profile->id) ? 1 : 0}}">
                </profile-component>
            </div>

            @if(count($user->posts) > 2)
            <div class="w3-container w3-margin-top">
                <userrandompost-component user-id="{{ $user->id }}"></userrandompost-component>
            </div>
            @endif

            @if(count($photos) > 0)
            <div class="w3-container w3-margin-top">
                <div class="w3-padding w3-margin">
                    <h4>Photos</h4>
                </div>
                <div class="scrollmenu">
                    @foreach($photos as $photo)
                    <div class="horizontal-image-gallery" style="width: 100px;">
                        <img src="{{ '/images/' . $photo->user_id . '/'. $photo->photo }}" onclick="showImage(this)"
                            style="height: 70px; width: 100%; object-fit: cover; cursor: pointer;">
                    </div>
                    @endforeach
                </div>

            </div>
            @endif

            <div class="w3-container w3-margin-top">

                <recentposts-component posts="{{ json_encode($recentPosts) }}">
                </recentposts-component>
            </div>

            <div class="w3-container w3-margin-top">
                <accounts-component user-id="{{ Auth::user()->id }}" accounts="{{ json_encode($accounts) }}"
                    status="{{Auth::user()->isFollowing($user->profile->id) ? 1 : 0}}">
                </accounts-component>
            </div>
        </div>

    </div>
    <!-- End Middle Column -->
</div>	