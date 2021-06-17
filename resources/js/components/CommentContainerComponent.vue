<template>
  <div class="">
    <comment-component
      :user-id="userId"
      :user="JSON.parse(authuser)"
      :feed-id="postId"
      :num-of-comments="commentCount"
      :bus="bus"
    >
    </comment-component>
  </div>
</template>

<script>
export default {
  props: ["postId", "userId", "authuser", "commentCount"],

  created() {
    
    //var instance= this;
    Echo.private("comment-channel").listen("CommentEvent", (event) => {
      this.$emit("commentchannelreceived", event);
      
    });

    Echo.private("reply-channel").listen("ReplyEvent", (event) => {
      this.$emit("replychannelreceived", event);
      
      
    });
  },

  mounted() {},
  data() {
    return {
      // feed: JSON.parse(this.post),
      bus: this,
    };
  },

  methods: {},
  computed: {
    buttonText() {},
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