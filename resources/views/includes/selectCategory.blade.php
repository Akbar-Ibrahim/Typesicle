<div id="myNav" class="overlay">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <div class="overlay-content">
        <div class="w3-container">

        </div>
        <createcategory-component username="{{ Auth::user()->username }}"></createcategory-component>
    </div>
</div>

<div class="w3-container">
    <button class="w3-button w3-right" style="cursor:pointer" onclick="openNav()"><i class="fas fa fa-angle-down"
            aria-hidden="true"></i>
    </button>
</div>