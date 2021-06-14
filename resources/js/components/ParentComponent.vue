<template>
        <div class="w3-container">

          <div v-for="(h, i) in histories" :key="i">

            <post-component
            :user="h.feed.user"
            :post="h.feed"
            :date="h.feed.created_at"
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
  props: ["userId", "user", "userType", "history"],


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
      histories: JSON.parse(this.history),
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
