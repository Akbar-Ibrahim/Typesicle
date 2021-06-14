<!-- Modal for full size images on click-->
<div id="modal01" class="w3-modal w3-black" style="padding-top: 0; z-index: 7;" onclick="this.style.display='none'">
    <span class="w3-button w3-black w3-xlarge w3-display-topright">×</span>
    <div class="w3-modal-content w3-animate-zoom w3-transparent w3-padding-64">
        <form action="{{ route('group.add', $group->id) }}">
            <div class="w3-container">
            <input type="hidden" name="group" value="{{ $group->id }}">
                @foreach($followers as $follower)
                <div class="d-flex my-4">
                <div>
                <profile-picture-component
              user="{{ json_encode($follower->user) }}"
              size="height: 35px; width: 35px;"
            ></profile-picture-component>
                </div>
                <div class="flex-grow-1">
                    <div>
                    {{ $follower->user->name }}
                    </div>
                    <div>
                        {{ $follower->user->username }}
                    </div>
                </div>
                <div class="btns">
                    <button class="w3-button add">+</button>
                    <button style="display: none;" class="w3-button minus"></button>
                </div>
                </div>
                @endforeach
            </div>

            <button id="send" >Send</button>
        </form>
        <div class="w3-container">
                <button class="w3-button">Add</button>
            </div>
    </div>
</div>