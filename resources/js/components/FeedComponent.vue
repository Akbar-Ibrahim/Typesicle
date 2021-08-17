<template>
  <div class="">
    <div class="w3-container w3-center">
      <div class="w3-row-padding">
        <div class="w3-col s4">
    <button ref="allRef" style="width: 100%; background-color: #212121, color: white" class="tabs w3-button" @click="getFeeds">All</button>
    </div>
    <div class="w3-col s4">
    <button ref="postsRef" style="width: 100%;" class="tabs w3-button" @click="getPosts">Posts</button>
    </div>
    <div class="w3-col s4">
    <button ref="shortiesRef" style="width: 100%;" class="tabs w3-button" @click="getShorties">Shorties</button>
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
          <my-thread-component :thread="feed.thread" :usertype="userType" :auth-user="JSON.parse(user)" :user-id="userId" :feed="feed" :bus="bus"></my-thread-component>
          <!-- <my-thread-component :feed="feed"></my-thread-component> -->
        </div>
        <!--  -->
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["posts", "userId", "user", "userType", "page"],

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

    Echo.private("delete-channel").listen("DeletePost", (event) => {
      console.log(event)
      this.$emit("deletechannelreceived", event);

      console.log("...received event");
    });

  },

  mounted() {
     
  },
  data() {
    return {
      feeds: JSON.parse(this.posts),
      this_user: JSON.parse(this.user),
      allposts: [],
      shorties: [],
      bus: this,
    };
  },
  
  methods: {
    getFeeds() {
      
      this.$refs.allContainer.style.display = "block";
      this.$refs.postContainer.style.display = "none";
      this.$refs.shortieContainer.style.display = "none";

      this.$refs.allRef.style.backgroundColor =  "#212121";
      this.$refs.allRef.style.color =  "white";
      this.$refs.postsRef.style.backgroundColor =  "white";
      this.$refs.postsRef.style.color =  "black";
      this.$refs.shortiesRef.style.backgroundColor =  "white";
      this.$refs.postsRef.style.color =  "black";



      this.feeds = [];


      let url = "/feeds/" + this.page + "/" + this.this_user.id;
      fetch(url)
        .then((response) => {
          return response.json();
        })
        .then((result) => {
          this.feeds = result;
        });
    },

    getPosts() {
      this.$refs.allContainer.style.display = "none";
      this.$refs.shortieContainer.style.display = "none";
      this.$refs.postContainer.style.display = "block";


      this.$refs.allRef.style.backgroundColor =  "white";
      this.$refs.allRef.style.color =  "black";
      this.$refs.postsRef.style.backgroundColor =  "#212121";
      this.$refs.postsRef.style.color =  "white";
      this.$refs.shortiesRef.style.backgroundColor =  "white";
      this.$refs.postsRef.style.color =  "black";



      this.allposts = [];

      let url = "/allposts/" + this.page + "/" + this.this_user.id;
      fetch(url)
        .then((response) => {
          return response.json();
        })
        .then((result) => {
          this.allposts = result;
        });
    },

    getShorties() {
      this.$refs.allContainer.style.display = "none";
      this.$refs.postContainer.style.display = "none";
      this.$refs.shortieContainer.style.display = "block";

      this.$refs.allRef.style.backgroundColor =  "white";
      this.$refs.allRef.style.color =  "black";
      this.$refs.postsRef.style.backgroundColor =  "white";
      this.$refs.postsRef.style.color =  "black";
      this.$refs.shortiesRef.style.backgroundColor =  "#212121";
      this.$refs.postsRef.style.color =  "white";



      this.shorties = [];

      let url = "/allshorties/" + this.page + "/" + this.this_user.id;
      fetch(url)
        .then((response) => {
          return response.json();
        })
        .then((result) => {
          this.shorties = result;
        });
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