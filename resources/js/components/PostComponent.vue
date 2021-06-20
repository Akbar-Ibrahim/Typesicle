<template>
  <div ref="postContainer" class="w3-container" style="margin-bottom: 50px">
    <header-component
      :user="feed.user"
      :date="date"
      size="width: 35px; height: 35px;"
    >
    </header-component>

    <div class="w3-row">
      <div
        v-if="feed.status === 'Reposted' || feed.status === 'rwc'"
        class="pl-4 my-2"
      >
        <div>
          Reposted: Originally by
          <a :href="`/${feed.post.user.username}`">{{ feed.post.user.name }}</a>
        </div>
        <div
          v-if="feed.repost_message !== null"
          v-html="feed.repost_message.substring(0, 250)"
        ></div>
      </div>

      <div v-if="feed.post.responding_to > 0" class="pl-2">
        Responding to
        <a
          :href="`/post/${feed.post.in_response_to.user.username}/${feed.post.in_response_to.url}/${feed.post.in_response_to.feed.id}`"
        >
          {{ feed.post.in_response_to.title }}
        </a>
        by
        <a :href="`/${feed.post.in_response_to.user.username}`">
          {{ feed.post.in_response_to.user.name }}
        </a>
      </div>
    </div>

    <div class="w3-row">
      <div class="w3-col s9 pl-2">
        <div class="w3-container">
          <h4 class="pl-3" >
            <a
              :href="`/post/${feed.user.username}/${feed.post.url}/${feed.id}`"
            >
              {{ feed.post.title }}
            </a>
          </h4>

          <div v-if="feed.post.category_id !== null" class="w3-container">
            Category:
            <a
              :href="`/${feed.post.user.username}/category/${feed.post.category.url}`"
            >
              {{ feed.post.category.name }}
            </a>
          </div>
        </div>

      </div>

      <div v-if="feed.post.photo" class="w3-col s3 w3-center">
        <img
          :src="`/images/${feed.post.user_id}/${feed.post.photo.photo}`"
          style="height: 130px; width: 100%; object-fit: cover" class="w3-hide-small"
        />
        <img
          :src="`/images/${feed.post.user_id}/${feed.post.photo.photo}`"
          style="height: 100px; width: 100%; object-fit: cover" class="w3-hide-large"
        />
      </div>
    </div>

    <!-- <textarea class="form-control " cols="30" rows="10" id="message" ref="message" v-model="message"></textarea>       -->


    <div class="w3-container my-4 py-4" v-if="usertype === 'auth'">
      <div class="w3-row">
      <div class="w3-col s3 ">
        <feed-controls-component
          :user-id="userId"
          :my-feed="feed"
          :bus="bus"
          :type="usertype"
        ></feed-controls-component>
      </div>

      <div class="w3-col s3 ">
        <share-component
          :user-id="userId"
          :my-feed="feed"
          :bus="bus"
          @remove-post="removePost"
          :type="usertype"
        ></share-component>
      </div>

      <div class="w3-col s3 ">
        <queue-component
          :user-id="userId"
          :my-feed="feed"
          :type="usertype"
        ></queue-component>
      </div>

      <div class="w3-col s3 " v-if="usertype === 'auth' && user.id == userId">
        <options-component
          :feed-id="feed.id"
          :user-id="userId"
          :my-feed="feed"
          :feed="feed.post.feed"
          :bus="bus"
          :type="usertype"
          @delete-post="deletePost"
        ></options-component>
      </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: [
    "post",
    "user",
    "date",
    "size",
    "userId",
    "bus",
    "authUser",
    "usertype",
  ],

  mounted() {
    // this.fetchFeed();
  },
  data() {
    return {
      feed: this.post,
    };
  },
  methods: {
    deletePost(data) {
      let url = `/delete-post/${data.id}`;
      fetch(url)
        .then((response) => {
          return response.json();
        })
        .then((result) => {
          console.log(result);
        });
      this.$refs.postContainer.remove();
    },

    removePost(data) {

      if (this.usertype === "auth") {
        if (this.authUser.id == this.userId) {
          this.$refs.postContainer.remove();
        }
      } else {
        location.href = "/register";
      }
    },
  },
};
</script>
