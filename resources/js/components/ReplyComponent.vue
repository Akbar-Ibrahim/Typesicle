<template>
  <div class="w3-container">

    <div class="">
      <button class="w3-button" @click="showReplyContainer">Like</button>
      <button class="w3-button" @click="showReplyContainer">Reply</button>
      <button ref="crl" class="w3-button" @click="fetchReplies"> {{ comment.replies.length }} </button>
      <button style="display:none;" ref="rCount">  {{ comment.replies.length }} </button>
      
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
          :date="reply.date"
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
      <button @click="loadMoreReplies" style="display: none;" ref="showRepliesButton" class="w3-button">
        Show replies
      </button>
    
    
  </div>
</template>

<script>
export default {
  props: [
    "replies",
    "userId",
    "commentId",
    "comment",
    "user",
    "numOfComments",
    "bus",
  ],

  created() {
    // this.hideReplyContainer();
  },

  mounted() {
    
    this.bus.$on("replychannelreceived", (data) => {
      // this.replies.push(data.reply);
      this.$refs.crl.textContent = data.numOfReplies;
    var id = parseInt(this.userId);
      if (this.comment.id == data.reply.comment_id) {
        if (id !== data.reply.user_id) {
          this.$refs.showRepliesButton.style.display = "block";
          var recent = data.numOfReplies - this.replies.length;
          this.$refs.showRepliesButton.textContent = "Show " + recent + " new replies";
        }
      }

    });

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
          
          console.log(result);
        });
    },

    loadMoreReplies() {
      
      var currentCount = this.replies.length;
      var replier = parseInt(this.userId)
      let url = `/api/replies/comment/more/${this.commentId}/${currentCount}/${replier}`;
      fetch(url)
        .then((response) => {
          return response.json();
        })
        .then((result) => {
          // this.replies = result;
          for (var i = 0; i < result.length; i++) {
            this.replies.push(result[i]);
          }
         this.$refs.showRepliesButton.style.display = "none"; 
          currentCount = currentCount + result.length;
          console.log(result);
        });
    },
  },
};
</script>