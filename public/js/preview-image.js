


function readImg(input,img){
  if(input.files && input.files[0]){

      if(checkImage(input)){
          var reader=new FileReader();
          reader.onload=function (ev) {
              img.src=ev.target.result;
                           
              img.classList.remove('d-none');
          };

          reader.readAsDataURL(input.files[0]);


      }
  }

}

function checkImage(input){

  var file=input.files[0];
  //checkfileType
  if( !( (file.type === "image/jpeg")  ||  (file.type === "image/gif") || (file.type === "image/png") ) ){

      // openNotify({color:'red', message:'File type not supported', type:'closed'});
      $("#errorModal").css("display", "block");
      
      input.value="";
      return false;

  }

  return true;

}

$(document).ready(function(){
  $('#upload_pic').change(function () {

    var img_preview = document.getElementById("img_preview");
    var input=$(this);
    readImg(input[0], img_preview);
    // $("#img_preview").css("display", "block");
    $("#image-preview-container").css("display", "block")
    
    var picture = $(this).val();
    
    
  });

});

