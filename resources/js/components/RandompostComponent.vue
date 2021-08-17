<template>
  <div class="">
<button 
        class="btn btn-default btn-lg w3-text-white" @click="goToRoute"
        style="background-color: #7CFC00;">
        Pick a random post for me!
    </button>    
  </div>
</template>

<script>
export default {
  props: [],

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
          this.route = `/post/${this.post.user.username}/${this.post.url}/${this.post.feed.id}`

          console.log(result);
        });
    },
  },
};
</script>
