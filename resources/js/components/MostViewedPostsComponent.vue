<template>
  <div class="w3-container">
    <h4> Popular on typesicle </h4>
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
              <a
                :href="`/post/${post.user.username}/${post.url}/${post.feed.id}`"
                >{{ post.title }}</a
              >
            </div>
            <div>
              by <a :href="`/${post.user.username}`"> {{ post.user.name }} </a>
              <span v-if="post.category !== null">
                in <a href=""> {{ post.category.name }} </a>
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: [],

created() {
    // this.fetchPosts();
  },
  mounted() {
    this.fetchPosts();
  },
  data() {
    return {
      posts: [],
    };
  },
  methods: {
    fetchPosts() {
      let url = "/api/most-viewed";
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
