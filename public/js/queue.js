
$(document).ready(function(){
  $('.addToQueue').click(function(){

   
      var feed_id = $(this).attr('feed_id');

    
      let url = $('#queueURL').attr('url') + '?feed_id=' + feed_id;
      let token = $('[name = csrf-token]').attr('content');


    $.post(url, { feed_id: feed_id,  _token: token }, function () {


      });

      $(this).hide();

      var queued = document.createElement("BUTTON");
      // queued.setAttribute("class", "queued w3-button w3-theme-d1 w3-margin-bottom")
      queued.setAttribute("class", "queued w3-theme-d1")
      var font_awesome = document.createElement("I");
      var span = document.createElement("SPAN");
      font_awesome.setAttribute("class", "fa fa-list");
      queued.setAttribute("id", "queued");
      var parent =  $(this).parent();
      span.innerHTML = " Queued";
      queued.append(font_awesome, span);
      // queued.innerHTML = "Queued";
      parent.append(queued);
      
      
      // $(this).next().text("Queued");
      // $(this).next().show();

  });
});


$(document).ready(function(){
  $('.deleteQueue').click(function(){
   
      var feed_id = $(this).attr('feed_id');

      let url = $('#deleteQueueURL').attr('url');
      let token = $('[name = csrf-token]').attr('content');


    $.post(url, { feed_id: feed_id,  _token: token }, function () {


      });

      $(this).parents('.queued').remove();
      

  });
});

