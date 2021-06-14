<template>
  <div class="w3-container my-4">
    <div class="w3-container">
      <div class="comments w3-container">
        <div
          class="comment w3-container"
          v-for="comment in comments"
          :key="comment.id"
        >
          <div class="w3-row my-4 w">
            <header-component
              :user="comment.user"
              :date="comment.created_at"
              size="width: 35px"
            >
            </header-component>

            <div v-html="comment.body"></div>

            <reply-component
              :comment="comment"
              :comment-id="comment.id"
              :user-id="userId"
              :replies="comment.replies"
              :user="JSON.parse(user)"

            ></reply-component>
          </div>
        </div>
      </div>
    </div>

    <div class="w3-container" v-if="userId != -1">
      <div class="my-4">
        <h3 class="w3-padding">Leave a comment</h3>
      </div>

      <div>
        <textarea
          class="form-control"
          cols="30"
          rows="10"
          id="message"
          ref="message"
          v-model="message"
        ></textarea>
      </div>

      <div>
        <button class="w3-button" @click="handle">Post</button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["postId", "userId", "user"],

  mounted() {
    $(this.$refs.message).summernote({
      height: 300,
      toolbar: [],
    });
    this.fetchComments();
  },
  data() {
    return {
      message: "",
      comments: [],
    };
  },
  methods: {
    
    fetchComments() {
      let url = `/api/comments/post/${this.postId}`;
      fetch(url)
        .then((response) => {
          return response.json();
        })
        .then((result) => {
          this.comments = result;

          console.log(result);
        });
    },

    handle() {
      this.message = this.message || this.$refs.message.value;

      var data = {
        postId: this.postId,
        userId: this.userId,
        body: this.message,
        // selectedComment: ""
      };

      data = JSON.stringify(data);

      if (this.message) {
        fetch("/api/post-comment", {
          method: "post",
          headers: {
            "Content-Type": "application/json",
          },
          body: data,
        })
          .then((response) => {
            return response.json();
          })
          .then((result) => {
            this.comments.push(result);
          });
        this.message = "";
        $(".note-editable:visible").html("");
      }
    },
  },
};
</script>
