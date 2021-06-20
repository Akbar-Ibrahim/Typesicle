var userProfiles;
$(document).ready(function(){
  if (parseInt($('.like').next().text()) == 0) {
    $('.like').next().text("");
 }  
  $('.like').click(function(){
      var status = parseInt($(this).attr('status'));
      var post_look_up_id = $(this).attr('post_look_up_id');

      if(status == 1){
          $(this).text('Like');
          status = 0;
          $(this).attr('status', status);
          // console.log(status);
      }else{
          $(this).text('Liked');
          status = 1;
          $(this).attr('status', status);
          // console.log(status);
      }

    
      let url = $('#goTo').attr('url') + '?post_look_up_id=' + post_look_up_id + '&status=' + status;
      var defaultImage = document.getElementById('default_image');
      
      var add = parseInt($(this).next().text());
      
      var minus = parseInt($(this).next().text());
      
      $.get(url, function(like){
        userProfiles = document.getElementById('userProfiles_'+post_look_up_id);
  
        if(status == 1) {
        var image = document.createElement('img');

        image.src = like.user.profile.photo ? like.user.profile.photo.file : defaultImage.getAttribute('url');
        image.id = "img_"+like.user.id;
        image.height="40";

        userProfiles.appendChild(image);
        }

        if (status == 0) {
          $(userProfiles).find('#img_'+like).remove();
        }
      });
      

      if (status == 1) {
        
        if(add > 0) {
        parseInt($('.like').next().text(add+1));

        }else{
          parseInt($('.like').next().text(+1));

        }

        
      } else if (status == 0) {

        if(minus > 0) {
        parseInt($('.like').next().text(minus-1))

        }else{
        parseInt($('.like').next().text())

          
        }
      }
      
      if (parseInt($('.like').next().text()) == 0) {
        $('.like').next().text("");
     }  

});
});


var data;
$(document).ready(function(){
  $('.repost').click(function(){
      var status = parseInt($(this).attr('status'));
      var postId = $(this).attr('post_id');

      if(status == 1){
          $(this).text('Repost');
          status = 0;
          $(this).attr('status', status);
          // console.log(status);
      }else{
          $(this).text('Reposted');
          status = 1;
          $(this).attr('status', status);
          // console.log(status);
      }

    
      let url = $('#repost_url').attr('url') + '?post_id=' + postId + '&status=' + status;

      $.get(url, function(repost){

      });

  });
});