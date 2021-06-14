<template>
  <div class="w3-margin">
    <div ref="allContainer">
      <div v-for="(feed, i) in feeds" :key="i">
        <div v-if="feed.post !== null">
          
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

        <div v-else-if="feed.status === 'Shortie'" class="w3-container">
          <my-shortie-component :feed="feed" :bus="bus"></my-shortie-component>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["posts", "userId", "user"],

  created() {
    //var instance= this;
    Echo.private("like-channel").listen("LikeFeed", (event) => {
      console.log(event);
      this.$emit("likechannelreceived", event);

      console.log("...received event");
    });

    Echo.private("share-channel").listen("ShareFeed", (event) => {
      console.log(event);
      this.$emit("sharechannelreceived", event);

      console.log("...received event");
    });

    Echo.private("shortie-reply-channel").listen(
      "ShortieReplyEvent",
      (event) => {
        console.log(event);
        this.$emit("shortiereply", event);

        console.log("...received event");
      }
    );
  },

  mounted() {},
  data() {
    return {
      feeds: JSON.parse(this.posts),
      this_user: JSON.parse(this.user),
      allposts: [],
      shorties: [],
      bus: this,
    };
  },
  methods: {},
  computed: {
    buttonText() {
      return 1 ? "unfollow" : "follow";
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