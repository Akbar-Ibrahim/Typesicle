
var updateFeedStats = {
  Like: function (feedId) {
      document.querySelector('#likes-count-' + feedId).textContent++;
  },

  Unlike: function(feedId) {
      document.querySelector('#likes-count-' + feedId).textContent--;
  }
};


var toggleButtonText = {
  Like: function(button) {
      button.textContent = "Unlike";
  },

  Unlike: function(button) {
      button.textContent = "Like";
  }
};

var actOnFeed = function (event) {
  var feedId = event.target.dataset.feedId;
  var action = event.target.textContent;
  toggleButtonText[action](event.target);
  updateFeedStats[action](feedId);
  axios.post('/posts/' + feedId + '/action',
      { action: action });
};

Echo.private('like-channel')
        .listen('LikeFeed', function (event) {
            console.log(event);
            console.log("...received event");
            var action = event.action;
            updateFeedStats[action](event.feedId);
            
        })

        