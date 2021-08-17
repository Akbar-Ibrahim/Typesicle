<template>
  <div v-if="posts.length > 0" class="">
    <div class=" my-3">
      <h4>Popular Articles</h4>
    </div>
    
    <div
      v-for="(post, i) in posts"
      :key="i"
      :route="`/${post.user.username}`"
      style="cursor: pointer"
    >
      <div v-if="post !== null" class="my-4" style="padding-left: 18px">
        <div class="d-flex">
          <div class="px-2">
            <profile-picture-component
              :user="post.user"
              size="height: 35px; width: 35px;"
            ></profile-picture-component>
          </div>

          <div class="flex-grow-1">
            <div>
            <a :href="`/post/${post.user.username}/${post.url}/${post.feed.id}`">{{
              post.title
            }}</a>
            </div>
            <div>
              by  <a :href="`/${post.user.username}`"> {{ post.user.name }} </a> 
              <span v-if="post.category !== null" > in <a href=""> {{ post.category.name }} </a> </span>
            </div>
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
