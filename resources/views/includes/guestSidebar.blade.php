<nav class="w3-sidebar w3-bar-block w3-collapse w3-text-white w3-animate-left w3-card "
    style="z-index:3;width:300px; background-color: #212121" id="mySidebar"><br>
    <div class="w3-container w3-hide-large w3-text-white">
        <a href="javascript:void(0)" style="text-decoration: none; background-color: #212121;" 
            class="w3-right btn btn-default btn-lg w3-margin w3-padding w3-text-white" onclick="w3_close()">X</a>
    </div>

    <div class="w3-container" style="margin-bottom: 40px;">
        <div class="w3-container w3-center" style="margin-bottom: 20px;">
            <a style="width: 100%; background-color: #212121" class="btn btn-default btn-lg w3-border w3-text-white"
                href="/register">Get Started</a>
        </div>

        <div class="w3-container w3-center">
            <a style="width: 100%; background-color: #212121" class="btn btn-default btn-lg w3-text-white"
                href="/login">SIGN IN</a>
        </div>

    </div>
    <div class="w3-bar-block">
        <div class="">

            <div class="w3-container w3-center">
                <a style="width: 100%; border: 1px solid #212121; background-color: #212121;" href="/"
                    class="w3-bar-item btn btn-default btn-lg w3-text-white menu-links">
                    Home</a>
            </div>
            <div class="w3-container w3-center">
                <a style="width: 100%; border: 1px solid #212121; background-color: #212121;" href="{{ route('top-pages') }}"
                    class="w3-bar-item btn btn-default btn-lg  w3-text-white menu-links"> Top
                    Pages</a>
            </div>
            <div class="w3-container w3-center">
                <a style="width: 100%; border: 1px solid #212121; background-color: #212121;" href="{{ route('discover') }}"
                    class="w3-bar-item btn btn-default btn-lg w3-text-white menu-links"> Discover</a>
            </div>
            <div class="w3-container w3-center">
                <a style="width: 100%; border: 1px solid #212121; background-color: #212121;" href="{{ route('popular') }}"
                    class="w3-bar-item btn btn-default btn-lg w3-text-white menu-links"> Popular on Typesicle</a>
            </div>
            <div class="w3-container w3-center">
                <a style="width: 100%; border: 1px solid #212121; background-color: #212121;" href="{{ route('category.index') }}"
                    class="w3-bar-item btn btn-default btn-lg w3-text-white menu-links"> See Categories</a>
            </div>
        </div>
    </div>
</nav>