 <!-- Trigger/Open the Modal -->
 
 <!-- The Modal -->
 <div id="coverPhotoModal" class="w3-modal">
     <div class="w3-modal-content">
         <div class="w3-container">
             <span onclick="document.getElementById('coverPhotoModal').style.display='none'"
                 class="w3-button w3-display-topright">&times;</span>
             <div class="w3-container w3-padding w3-center w3-margin ">
                 <div class="w3-container" style="margin-top: 100px; margin-bottom: 100px;">
                     <button id="addCoverImage" class="w3-padding w3-margin">From Computer</button>
                     <button onclick="photosOverlay(this)" class="w3-padding w3-margin">From Uploaded Photos</button>
                 </div>
             </div>
         </div>
     </div>
 </div>