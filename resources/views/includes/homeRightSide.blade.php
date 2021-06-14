<div class="w3-container " style="margin-bottom: 40px;">
<randompost-component></randompost-component>
</div>

<div class="w3-container my-4">
    @if($top_categories)
    <div class="w3-container py-2">
        <h4> Top Categories </h4>
    </div>

    <div class="row-padding">
        <div class="w3-col s10">
            <div id="firstTen" class="w3-container topCategory">
                @foreach($top_categories->take(10) as $category)

                <div class="w3-container py-2">
                    <a href="{{ route('category-name', [$category->user->username, $category->url]) }}">
                        {{ $category->name }} </a> by
                    <a href="{{ route('profile.show', $category->user->username) }}">
                        {{ $category->user->name }} </a>
                </div>
                @endforeach
            </div>

            <div id="secondTen" class="w3-container topCategory" style="display: none;">
                @foreach($top_categories->skip(10)->take(10) as $category)

                <div class="w3-container py-2">
                    <a href="{{ route('category-name', [$category->user->username, $category->url]) }}">
                        {{ $category->name }} </a> by
                    <a href="{{ route('profile.show', $category->user->username) }}">
                        {{ $category->user->name }} </a>
                </div>
                @endforeach
            </div>

            <div id="thirdTen" class="w3-container topCategory" style="display: none;">
                @foreach($top_categories->take(10) as $category)

                <div class="w3-container py-2">
                    <a href="{{ route('category-name', [$category->user->username, $category->url]) }}">
                        {{ $category->name }} </a> by
                    <a href="{{ route('profile.show', $category->user->username) }}">
                        {{ $category->user->name }} </a>
                </div>
                @endforeach
            </div>


        </div>

        <div class="w3-col s2 w3-border">

            <div style="cursor: pointer;" class="w3-container w3-border py-2" onclick="topCategories('firstTen')">
                1
            </div>
            @if(count($top_categories) > 10)
            <div style="cursor: pointer;" class="w3-container w3-border py-2" onclick="topCategories('secondTen')">
                2
            </div>
            @elseif(count($top_categories) > 20)
            <div style="cursor: pointer;" class="w3-container w3-border py-2" onclick="topCategories('thirdTen')">
                3
            </div>
            @endif
        </div>
    </div>
    @endif
</div>


<div class="w3-container">
    @if($most_read)
    <div class="w3-container py-3">
        <h4> Most popular posts </h4>
    </div>
    @foreach($most_read as $mr)

    <div class="pt-3">

        <div class="">
        <div class="d-flex ">
                            <div class="px-2">
                                <a href="{{ route('profile.show', $mr->postLookUp->post->user->username) }}">
                                    <img src="/images/{{ $mr->postLookUp->user->id }}/profile_pic/{{ $mr->postLookUp->user->profile->profile_pic }}"
                                        alt="Avatar" class="w3-center w3-circle w3-border " style="width:25px">
                                </a>
                            </div>

                            <div class="flex-grow-1">
                                <div><a href="{{ route('profile.show', $mr->postLookUp->post->user->username) }}">
                                        {{ $mr->postLookup->post->user->name }}
                                    </a>
                                    @if($mr->postLookUp->post->category)
                                    in
                                    <a
                                        href="{{ route('category-name', [$mr->postLookUp->post->category->user->username, $mr->postLookUp->post->category->url]) }}">
                                        {{ $mr->postLookUp->post->category->name }} </a>
                                    @endif
                                </div>
</div>
</div>
<hr>
            <h6 class="pl-2">
                <a
                    href="{{ route('home.post', [$mr->postLookUp->post->user->username, $mr->postLookUp->post->url, $mr->postLookUp->id]) }}">
                    {{ $mr->postLookUp->post->title }}
                </a>
            </h6>
        </div>


    </div>
    @endforeach
    @endif
</div>