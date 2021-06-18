<template>
  <div class="">
    
    <div ref="allContainer">
        <div v-if="feed.post !== null">
          <read-post-component
            :user="feed.user"
            :post="feed"
            :date="feed.date"
            size="width: 35px"
            :user-id="userId"
            :bus="bus"
            :usertype="userType"
          ></read-post-component>
        </div>

        <div v-else-if="feed.status === 'Shortie'" class="w3-container">
          <my-shortie-component :feed="feed"></my-shortie-component>
        </div>

        <div v-else-if="feed.thread !== null">
          <my-thread-component :feed="feed"></my-thread-component>
        </div>

        <!--  -->

    </div>    

  </div>
</template>

<script>
export default {
  props: ["post", "userId", "user", "userType"],

  created() {
     //var instance= this;
     Echo.private("like-channel").listen("LikeFeed", (event) => {
      console.log(event)
      this.$emit("likechannelreceived", event);

      console.log("...received event");
      //       var action = event.action;
    });
  },

  mounted() {
     
  },
  data() {
    return {
      feed: JSON.parse(this.post),
      this_user: JSON.parse(this.user),
      bus: this,
    };
  },
  methods: {
    
  },
  computed: {
    buttonText() {
      return 1 ? "unfollow" : "follow";
    },
  },
};
</script>
