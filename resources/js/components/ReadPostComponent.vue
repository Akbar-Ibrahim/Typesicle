<template>
  <div ref="postContainer" class="mt-4">

    <div v-if="feed.post.responding_to > 0">
        <header-component :user="feed.user" :date="date" size="width: 35px">
        </header-component>
        <div class="w3-padding">
          In response to
          <a href=""> {{ feed.post.in_response_to.title }} </a> by
          <a href=""> {{ feed.post.in_response_to.user.name }} </a>
        </div>
      </div>

    <div v-if="feed.repost_message !== null">
      <!-- If article is a published response -->

        <header-component :user="feed.user" :date="date" size="width: 35px">
        </header-component>      

      <div
        class="w3-container w3-padding w3-margin"
        v-html="feed.repost_message"
      ></div>
    </div>

    <div class="w3-container">
      <header-component :user="feed.post.user" :date="date" size="width: 35px">
      </header-component>

      <div class="w3-container">
        <h1 class="w3-hide-small">{{ feed.post.title }}</h1>
        <h4 class="w3-hide-large">{{ feed.post.title }}</h4>
      </div>
    </div>

<div v-if="feed.post.category !== null" class="w3-container w3-margin w3-padding">
  <a :href="`/${feed.post.user.username}/category/${feed.post.category.url}`"> {{ feed.post.category.name }} </a>
</div>

    <!-- <div v-if="feed.repost_message">
      <div class="w3-container my-4">
        <div class="w3-container">
          {{ feed.user.name }} reposted this article with the text below
        </div>
        <hr class="w3-clear" />
        <div id="thought" class="w3-container" v-html="feed.repost_message"></div>
        <hr class="w3-clear" />
      </div>
    </div>
     -->
    <!-- Cover Image -->
    <div v-if="feed.post.photo">
      <div class="w3-container my-4">
        <div class="w3-center">
          <img
            :src="`/images/${feed.post.user.id}/${feed.post.photo.photo}`"
            width="100%"
          />
        </div>
      </div>
    </div>

    <div class="w3-container my-4" v-html="feed.post.body"></div>

<div class="w3-container d-flex">
<div class="w3-col l3 ">
    <feed-controls-component
      :user-id="userId"
      :my-feed="feed"
      :bus="bus"
      :type="usertype"
    ></feed-controls-component>
</div>


<div class="w3-col l3">
    <share-component
      :user-id="userId"
      :my-feed="feed"
      :bus="bus"
      @remove-post="removePost"
      :type="usertype"
    ></share-component>
    </div>
    </div>


  </div>
</template>

<script>
export default {
  props: ["post", "user", "date", "size", "userId", "bus", "status", "usertype"],

  mounted() {},
  data() {
    return {
      feed: this.post,
    };
  },
  methods: {
    removePost(data) {
      // alert("hello " + data);
      if (this.authUser.id == this.userId) {
      this.$refs.postContainer.remove();
      }
    },
  },
};
</script>
