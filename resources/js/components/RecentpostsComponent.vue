<template>
  <div v-if="JSON.parse(posts).length > 0">
    <div class="w3-container my-3">
      <h4>Recent Articles</h4>
    </div>

    <div
      v-for="(feed, i) in JSON.parse(posts)"
      :key="i"
      :route="`/${feed.user.username}`"
      style="cursor: pointer"
    >
      <div v-if="feed !== null" class="my-4" style="padding-left: 18px">
        <div class="d-flex">
          <div class="px-2">
            <profile-picture-component
              :user="feed.post.user"
              size="height: 35px; width: 35px;"
            ></profile-picture-component>
          </div>

          <div class="flex-grow-1">
            <div>
            <a :href="`/post/${feed.post.user.username}/${feed.post.url}/${feed.id}`">{{
              feed.post.title
            }}</a>
            </div>
            <div>
              by  <a :href="`/${feed.post.user.username}`"> {{ feed.post.user.name }} </a> 
              <span v-if="feed.post.category !== null" > in <a href=""> {{ feed.post.category.name }} </a> </span>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["posts"],

  mounted() {
    
  },
  data() {
    return {
      
      // posts: [],
    };
  },
  methods: {
  },
};
</script>
