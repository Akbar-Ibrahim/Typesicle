<template>
  <div class="">
    <div v-if="feed.status === 'Shortie'">
    <my-shortie-component :usertype="userType" :auth-user="JSON.parse(user)" :user-id="userId" :feed="feed" :bus="bus"></my-shortie-component>
    </div>
    <div v-else-if="feed.status === 'Thread'">
      <div v-for="(f, i) in feeds" :key="i">
    <my-shortie-component :usertype="userType" :auth-user="JSON.parse(user)" :user-id="userId" :feed="f" :bus="bus"></my-shortie-component>
    </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["userId", "user", "userType", "shortie", "shorties"],

  mounted() {
    this.fetchFeed();
    
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
  data() {
    return {
      feed: JSON.parse(this.shortie),
      feeds: JSON.parse(this.shorties),
      bus: this,
    };
    
  },
  methods: {
fetchFeed () {
let url = `/api/shortie/feeds/${this.feed.thread.id}`;
this.feeds = [];
      fetch(url)
        .then((response) => {
          return response.json();
        })
        .then((result) => {
          this.feeds = result;

          
        });
    },    
  },

  computed: {
    buttonText() {
      
        
    },
  },
};
</script>
