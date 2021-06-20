<template>
  <div class="" style="margin-top: 50px;">
<button 
        class="w3-margin w3-padding w3-button" @click="goToRoute"
        style=" font-size: 17px">
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
