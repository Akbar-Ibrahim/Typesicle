<template>
        <div class="w3-container">

          <div v-for="(feed, i) in feeds" :key="i">

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
        </div>
</template>

<script>
export default {
  props: ["userId", "user", "userType", "articles"],


created() {
Echo.private("like-channel").listen("LikeFeed", (event) => {
      
      this.$emit("likechannelreceived", event);

    });

    Echo.private("share-channel").listen("ShareFeed", (event) => {
    
      this.$emit("sharechannelreceived", event);

    });

},


  data() {
    return {
      feeds: JSON.parse(this.articles),
      bus: this,
    };
  },

  mounted() {
    
  },

  methods: {
    

    
  },

  computed: {
    
  }
};
</script>
