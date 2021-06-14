<template>
  <div class="">
<button :route="route"
        class="w3-button" @click="goToRoute"
        style="font-size: 17px">
        Read a random post by this author!
    </button>    
  </div>
</template>

<script>
export default {
  props: ["postId", "userId", "route"],

  mounted() {
    // this.fetchRandomPost();
  },
  data() {
    return {
      post: [],
      
    };
  },
  methods: {
    goToRoute(){
      location.href = `${this.route}`;
    },

    // fetchRandomPost() {
    //   let url = `/api/random-post/user/${this.userId}`;
    //   fetch(url)
    //     .then((response) => {
    //       return response.json();
    //     })
    //     .then((result) => {
    //       this.post = result;
    //       this.route = `/post/${this.post.post.user.username}/${this.post.post.url}/${this.post.id}`

    //       console.log(result);
    //     });
    // },
  },
};
</script>
