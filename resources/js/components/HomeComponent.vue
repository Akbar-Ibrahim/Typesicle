<template>
  <div class="">
    <div class="w3-container w3-center">
      <div class="w3-row-padding">
        <div class="w3-col s4">
    <button ref="allTabButton" style="width: 100%;" class="tabs w3-button" @click="getFeeds">All</button>
    </div>
    <div class="w3-col s4">
    <button ref="postTabButton" style="width: 100%;" class="tabs w3-button" @click="getPosts">Posts</button>
    </div>
    <div class="w3-col s4">
    <button ref="shortieTabButton" style="width: 100%;" class="tabs w3-button" @click="getShorties">Shorties</button>
    </div>
    </div>
</div>

    <div ref="allContainer">
      <div v-for="(feed, i) in feeds" :key="i">
        <div v-if="feed.post !== null" class="my-4">
          <post-component
            :user="feed.user"
            :post="feed"
            :date="feed.date"
            size="width: 35px"
            :user-id="userId"
            :auth-user="JSON.parse(user)" 
            :bus="bus"
            :usertype="userType"
          ></post-component>
        </div>

        <div v-else-if="feed.status === 'Shortie' && feed.thread == null" class="w3-container">
          <my-shortie-component :shortie="feed.shortie" :usertype="userType" :auth-user="JSON.parse(user)" :user-id="userId" :feed="feed" :bus="bus"></my-shortie-component>
        </div>

        <div v-else-if="feed.thread !== null">
          <my-thread-component :thread="feed.thread" :usertype="userType" :auth-user="JSON.parse(user)" :user-id="userId" :feed="feed" :bus="bus"></my-thread-component>
        </div>

        <!--  -->
      </div>

      <infinite-loading  @distance="1" @infinite="getFeeds"></infinite-loading>
     
    </div>

    <!-- Post container -->

    <div ref="postContainer" style="display: none">
      <!--  -->
      <div v-for="(feed, i) in allposts" :key="i">
        <post-component
          :user="feed.user"
          :post="feed"
          :date="feed.created_at"
          size="width: 35px"
          :user-id="userId"
          :auth-user="JSON.parse(user)" 
          :bus="bus"
          :usertype="userType"
        ></post-component>

      </div>
      <!--  -->
      <div class="w3-container w3-center" style="margin-top: 50px;">
        <button class="w3-button" @click="getPosts">Load More</button>
      </div>
    </div>

    <!-- Shortie container -->

    <div ref="shortieContainer" style="display: none">
      <div v-for="(feed, i) in shorties" :key="i">
        <!--  -->
        <div v-if="feed.status == 'Shortie'">
          
          <my-shortie-component :shortie="feed.shortie" :usertype="userType" :auth-user="JSON.parse(user)" :user-id="userId" :feed="feed" :bus="bus"></my-shortie-component>
        </div>
        <!--  -->
        <div v-else>
          <my-thread-component :feed="feed"></my-thread-component>
        </div>
        <!--  -->
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["posts", "userId", "user", "userType"],

  created() {
     //var instance= this;
     Echo.private("like-channel").listen("LikeFeed", (event) => {
      console.log(event)
      this.$emit("likechannelreceived", event);

      console.log("...received event");
    });

    Echo.private("share-channel").listen("ShareFeed", (event) => {
      console.log(event)
      this.$emit("sharechannelreceived", event);

      console.log("...received event");
    });

    Echo.private("shortie-reply-channel").listen("ShortieReplyEvent", (event) => {
      console.log(event)
      this.$emit("shortiereply", event);

      console.log("...received event");
    });
  },

  mounted() {
     this.getFeeds();
    //  this.getPosts();
  },
  data() {
    return {
      // feeds: JSON.parse(this.posts),
      feeds: [],
      this_user: JSON.parse(this.user),
      allposts: [],
      shorties: [],
      bus: this,
      feedsPagination: 1,
      postsPagination: 1,
      shortiesPagination: 1,
      
    };
  },
  
  methods: {
    getFeeds() {
      this.$refs.allContainer.style.display = "block";
      this.$refs.postContainer.style.display = "none";
      this.$refs.shortieContainer.style.display = "none";
      // this.feeds = [];

      var page = 1;

      let url = "/api/home-feeds?page=" + this.feedsPagination;
      fetch(url)
        .then((response) => {
          return response.json();
        })
        .then((result) => {
          for (var i = 0; i < result.data.length; i++) {
            this.feeds.push(result.data[i]);
          }
          // this.feeds = result.data;
          
        });

      // this.$http.get('/api/home-feeds?page=' + this.page)
      //               .then(res => {
      //                   return res.json();
      //               }).then(res => {
      //                   $.each(res.data, (key, value) => {
      //                       this.feeds.push(value);
      //                   });
                        
      //               });
        this.feedsPagination = this.feedsPagination + 1;
    },

    getPosts() {
      this.$refs.allContainer.style.display = "none";
      this.$refs.shortieContainer.style.display = "none";
      this.$refs.postContainer.style.display = "block";
      
      // this.allposts = [];

    

      let url = "/api/home-posts?page=" + this.postsPagination;
      fetch(url)
        .then((response) => {
          return response.json();
        })
        .then((result) => {
          // this.allposts = result.data;
          for (var i = 0; i < result.data.length; i++) {
            this.allposts.push(result.data[i]);
          }
        });
        this.postsPagination = this.postsPagination + 1;
    },

    getShorties() {
      this.$refs.allContainer.style.display = "none";
      this.$refs.postContainer.style.display = "none";
      this.$refs.shortieContainer.style.display = "block";
      // this.shorties = [];

  var page = 1;
      let url = "/api/home-shorties?page=" + this.shortiesPagination;
      fetch(url)
        .then((response) => {
          return response.json();
        })
        .then((result) => {
          // this.shorties = result.data;
          for (var i = 0; i < result.data.length; i++) {
            this.shorties.push(result.data[i]);
          }
        });
        this.shortiesPagination = this.shortiesPagination + 1
    },

    // likeFeed(feed_id, text) {

    //   let url = "/api/post-like?feed_id=" + feed_id + "&user_id=" + this.userId;
    //   fetch(url)
    //   .then(response => {
    //         return response.json();
    //       })
    //       .then(result => {

    //           // if (result === ""){
    //           //   text = "Like";
    //           //   this.$refs.buttonToggle.innerHTML = text;
    //           // } else {
    //             text = "Unlike";
    //             this.$refs.buttonToggle.innerHTML = text;
    //           // }

    //       });

    // },
  },
  computed: {
    buttonText() {
      
    },
  },
};
</script>

<style>
.tabs {
  /* margin-right: 50px;
    padding: 10px 20px; */
  font-size: 21px;
}
</style>