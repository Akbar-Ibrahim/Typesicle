<template>
  <div class="w3-center">
    
<button 
        class="btn btn-primary w3-text-white lawngreen" @click="goToRoute"
        style="font-size: 17px">
        Read a random post by this author!
    </button>    
  </div>
</template>

<script>
export default {
  props: ["userId"],

  mounted() {
    this.fetchRandomPost();
  },
  data() {
    return {
      feed: [],
      
    };
  },
  methods: {
    goToRoute(){
      location.href = `/post/${this.feed.post.user.username}/${this.feed.post.url}/${this.feed.id}`
    },

    fetchRandomPost() {
      let url = `/api/random-post/user/${this.userId}`;
      this.feed = [];
      fetch(url)
        .then((response) => {
          return response.json();
        })
        .then((result) => {
          this.feed = result;
          

          console.log(result);
        });
    },
  },
};
</script>
