function delayLoad() {
    setTimeout(function(){ document.getElementById("block1").style.display = "block" }, 1200);
    setTimeout(function(){ document.getElementById("block2").style.display = "block"; }, 1000);
    setTimeout(function(){ document.getElementById("block3").style.display = "block"; }, 600);
    setTimeout(function(){ document.getElementById("loadBlock").style.display = "none"; }, 1600);
    setTimeout(function(){ document.getElementById("wrapper-div").style.display = "block"; }, 1800);
    setTimeout(function(){ document.getElementById("loadBlockWrapper").style.display = "none"; }, 1800);
    
  }
  
  delayLoad()