function delayLoad() {
    var x = document.getElementById("txt");
    setTimeout(function(){ document.getElementById("block1").style.display = "block" }, 1600);
    setTimeout(function(){ document.getElementById("block2").style.display = "block"; }, 1200);
    setTimeout(function(){ document.getElementById("block3").style.display = "block"; }, 800);
    setTimeout(function(){ document.getElementById("loadBlock").style.display = "none"; }, 1800);
    setTimeout(function(){ document.getElementById("wrapper-div").style.display = "block"; }, 2000);
    
  }
  
  delayLoad()