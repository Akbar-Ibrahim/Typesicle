<template>
  <div v-if="posts.length > 0" class="">
    <div class=" my-3">
      <h4>Popular Articles</h4>
    </div>
    <div
      v-for="(p, i) in posts"
      :key="i"
      class="w3-margin-bottom"
      :route="`/${p.user.username}`"
      style="cursor: pointer"
    >
      <div class="" style="padding-left: 18px">
        <div class="">
          <h5 class="">
            <a :href="`/post/${p.user.username}/${p.url}/${p.feed.id}`">{{
              p.title
            }}</a>
          </h5>
        </div>

        <div class="d-flex">
          <div class="pr-2">by </div>
          <div>
            <a :href="`/${p.user.username}`">
              <img
                :src="`/images/${p.user.id}/profile_pic/${p.user.profile.picture}`"
                class="w3-center w3-circle w3-border"
                style="width: 20px"
              />
            </a>
          </div>

          <div class="flex-grow-1 pl-2">
            <a style="font-size: 15px" :href="`/${p.user.username}`">{{
              p.user.name
            }}</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["userId", "username"],

  mounted() {
    this.fetchPosts();
  },
  data() {
    return {
      message: "",
      posts: [],
    };
  },
  methods: {
    fetchPosts() {
      let url = `/api/popular-posts/user/${this.userId}`;
      fetch(url)
        .then((response) => {
          return response.json();
        })
        .then((result) => {
          this.posts = result;

          console.log(result);
        });
    },
  },
};
</script>
