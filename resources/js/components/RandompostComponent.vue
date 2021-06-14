<template>
  <div class="">
<button :route="route"
        class="py-4 px-4" @click="goToRoute"
        style="border: 2px solid black; font-size: 17px">
        Pick a random post for me!
    </button>    
  </div>
</template>

<script>
export default {
  props: ["postId"],

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
      let url = `/api/random-post`;
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
