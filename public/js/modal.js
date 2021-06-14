

var modals = document.getElementsByClassName('w3-modal');
var target;


// When the user clicks anywhere outside of the modal, close it
window.onclick = function (event) {
    target=event.target;

    for(var index in modals) {
         if(target  == modals[index]){
          target.style.display="none";
          break;
        }
    }

   
}


