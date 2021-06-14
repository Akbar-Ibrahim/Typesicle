<template>
  <div class="container my-4">
    
    <div class>
      <div class="comments">
        <div class="comment" v-for="comment in comments" :key="comment.id">
          <div class="w3-container">
            Under <a :href="`/post/${comment.post_look_up.post.user.username}/${comment.post_look_up.post.url}/${comment.post_look_up.id}`">
             {{ comment.post_look_up.post.title ? comment.post_look_up.post.title : '' }}
             </a>
          </div>
          <div class="row my-4">
            <div class="col-sm-2 text-center">
              <a :href="`/${comment.user.username}`">
                <img
                  :src="`/images/${comment.user.id }/profile_pic/${comment.user.profile.profile_pic}`" class="img-circle w3-circle"
                  height="65"
                  width="65"
                  alt="Avatar"
                />
              </a>
            </div>

            <div class="col-sm-10">
              <div>
                <a :href="`/${comment.user.username}`">{{ comment.user.username }}</a>
              </div>
              <div>{{ comment.created_at }}</div>
              <div v-html="comment.body"></div>
            </div>
          </div>

        </div>
      </div>

    </div>
  </div>
</template>

<script>
export default {
  props: [ "userId"],

  mounted() {
    
    this.fetchComments();
  },
  data() {
    return {
      message: "",
      comments: []
    };
  },
  methods: {
    fetchComments() {
      let url = `/api/comments/user/${this.userId}`;
      fetch(url)
        .then(response => {
          return response.json();
        })
        .then(result => {
          this.comments = result;

          console.log(result);
        });
    },

  }
};
</script>
