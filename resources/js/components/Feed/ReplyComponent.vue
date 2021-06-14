<template>
  <div
    class="container"
    style="width: 85%; margin-left: auto; margin-right: auto"
  >
    <div class="replies w3-margin-bottom" v-if="replies">
      <div class="reply" v-for="reply in replies" :key="reply.id">
        <header-component
          :user="reply.user"
          :date="reply.created_at"
          size="width: 35px"
        >
        </header-component>
        <div>
          <div v-html="reply.body"></div>
        </div>
      </div>
    </div>

    <!-- <div class="w3-row-padding">
      <button @click="openReplyModal" class="replyModalButton w3-hover-opacity">
        Reply
      </button>
    </div> -->

    <div>
        <div>
        <textarea
          ref="textArea"
          :id="textBoxId"
          v-model="message"
          cols="10"
          rows="10"
        ></textarea>
        </div>

      <div class="w3-right">
        <button @click="handleReply">Post</button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["replies", "userId", "commentId", "comment", "user"],

  mounted() {
    $(this.$refs.textArea).summernote({
      placeholder: "Reply to this comment",
      toolbar: [],
    });
  },

  computed: {
    replyBoxId() {
      return `replyBox_${this.commentId}`;
    },
    textBoxId() {
      return `txt_${this.commentId}`;
    },
  },

  data() {
    return {
      pagination: "",
      message: "",
    };
  },

  methods: {
    openReplyModal() {
      this.$refs.replyBox.style.display = "block";
    },

    closeReplyBox() {
      this.$refs.replyBox.style.display = "none";
    },

    handleReply() {
      this.message = this.message || this.$refs.textArea.value;
      var data = {
        commentId: this.commentId,
        userId: this.userId,
        body: this.message,
      };

      data = JSON.stringify(data);

      if (this.message) {
        fetch("/api/comment-reply", {
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
            this.replies.push(result);
          });
        this.message = "";
        $(".note-editable:visible").html("");
        this.closeReplyBox();
      }
    },
  },
};
</script>