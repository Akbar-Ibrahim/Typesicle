<template>
  <div class=" w3-center">
    <!-- <div class="w3-padding">Click to read another article by this author</div> -->
<button :route="route"
        class="btn btn-primary lawngreen" @click="goToRoute"
        style="font-size: 22px; width: 100%; border: 1px solid white; color: white;">
        Read a random post

    </button>    
  </div>
</template>

<script>
export default {
  props: ["postId", "userId"],

  mounted() {
    this.fetchRandomPost();
  },
  data() {
    return {
      message: "",
      post: [],
      route: ""
    };
  },
  methods: {
    goToRoute(){
      location.href = `${this.route}`;
    },

    fetchRandomPost() {
      let url = `/api/random-post/user/${this.userId}/post/${this.postId}`;
      fetch(url)
        .then((response) => {
          return response.json();
        })
        .then((result) => {
          this.post = result;
          this.route = `/post/${this.post.post.user.username}/${this.post.post.url}/${this.post.id}`

          console.log(result);
        });
    },
  },
};
</script>
