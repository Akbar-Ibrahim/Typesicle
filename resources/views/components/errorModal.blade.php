<div id="errorModal" class="w3-modal errorModal">
    <div class="w3-modal-content w3-card-4 w3-border" style="width: 35%">
      <header class="w3-container w3-teal"> 
        <span onclick="document.getElementById('errorModal').style.display='none'" 
        class="w3-button w3-display-topright">&times;</span>
        <h2><i class="fas fa fa-exclamation-triangle"></i> Error</h2>
      </header>
      <div class="w3-container">
        {{ $slot }}
      </div>
      <footer class="w3-container w3-teal w3-center my-4">
        <button class="w3-button" onclick="document.getElementById('errorModal').style.display='none'" class="px-4 py-2">Got it!</button>
      </footer>
    </div>
  </div>
