<template>
  <div class=" w3-center">
    <div class="w3-padding">Click to read another article by this author</div>
<button :route="route"
        class="w3-button w3-border" @click="goToRoute"
        style="font-size: 22px">
        <i class="fa fa-newspaper-o" aria-hidden="true"></i>

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
