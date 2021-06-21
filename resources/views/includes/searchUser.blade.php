<!-- Modal that pops up when you click on "New Message" -->
<div id="id01" class="w3-modal" style="z-index:4">
                <div class="w3-modal-content w3-animate-zoom">
                    <div class="w3-container w3-padding w3-red">
                        <span id="closeSearchModal" onclick="document.getElementById('id01').style.display='none'"
                            class="w3-button w3-red w3-right w3-xxlarge"><i class="fa fa-remove"></i></span>
                        <h2>Search for authors</h2>
                    </div>
                    <div class="w3-panel">
                        <search-component></search-component>
                        <div class="w3-section">
                            <a class="w3-button w3-red"
                                onclick="document.getElementById('id01').style.display='none'">Cancel <i
                                    class="fa fa-remove"></i></a>
                            <a class="w3-button w3-light-grey w3-right"
                                onclick="document.getElementById('id01').style.display='none'">Send <i
                                    class="fa fa-paper-plane"></i></a>
                        </div>
                    </div>
                </div>
            </div>