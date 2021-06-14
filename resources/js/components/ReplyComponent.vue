<template>
  <div class="w3-container">
    <h1 ref="show"></h1>
    <div class="">
      <button class="w3-button" @click="showReplyContainer">Like</button>
      <button class="w3-button" @click="showReplyContainer">Reply</button>
      <button class="w3-button" @click="fetchReplies">View Replies</button>
      
    </div>

    <div ref="replyContainer">
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
        <button @click="handleReply">Send</button>
        <button @click="hideReplyContainer">Close</button>
      </div>
    </div>

    <div class="replies w3-margin-bottom" v-if="replies">
      <div class="reply" v-for="reply in replies" :key="reply.id">
        
        <header-component
          :user="reply.user"
          :date="reply.created_at"
          size="width: 20px"
          fontsize="font-size: 12px;"
        >
        </header-component>
        <div>
          <div class="w3-container" v-html="reply.body"></div>
        </div>
      </div>
    </div>

    <!-- <!-- <div class="w3-row-padding"> -->
      <button class="w3-button">
        Show more replies
      </button>
    </div> 
    
  </div>
</template>

<script>
export default {
  props: ["replies", "userId", "commentId", "comment", "user", "numOfComments"],

  created() {
    // this.hideReplyContainer();
  },

  mounted() {
    this.hideReplyContainer();
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
    hideReplyContainer() {
      this.$refs.replyContainer.style.display = "none";
    },

    showReplyContainer() {
      this.$refs.replyContainer.style.display = "block";
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
        // this.closeReplyBox();
        this.hideReplyContainer();
      }

    },

    fetchReplies() {
      let url = `/api/replies/commentt/${this.commentId}`;
      fetch(url)
        .then((response) => {
          return response.json();
        })
        .then((result) => {
          // this.replies = result;
this.$refs.show.innerHTML = result;
          console.log(result);
        });
    },

  },
};
</script>