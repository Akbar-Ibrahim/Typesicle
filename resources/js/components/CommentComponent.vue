<template>
  <div class="my-4">
    
    <div class="">
      <div class="comments">
        <h1> <span ref="commentCount">{{ numOfComments }}</span> Comments </h1>
        <div
          class="comment "
          v-for="comment in comments"
          :key="comment.id"
        >
          <div class="w3-row my-4 w w3-border">
            <header-component
              :user="comment.user"
              :date="comment.date"
              size="width: 25px"
              fontsize="font-size: 12px;"
            >
            </header-component>

            <div class="w3-padding" v-html="comment.body"></div>

            <reply-component
              :comment="comment"
              :comment-id="comment.id"
              :user-id="userId"
              :replies="comment.replies"
              :user="user" 
              :num-of-comments="numOfComments"
              :bus="bus"
            ></reply-component>


          </div>
        </div>
      </div>
    </div>

<div @click="loadMoreComments" style="display: none; cursor: pointer" ref="showMore"> Show more comments </div>


    <div class="w3-container" v-if="userId != -1">
      <div class="my-4">
        <h3 class="w3-padding">Leave a comment</h3>
      </div>

      <div>
        <textarea
          class="form-control"
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
  props: ["postId", "userId", "user", "numOfComments", "bus", "feedId"],



  mounted() {

    this.bus.$on("commentchannelreceived", (data) => {
      
          this.comments.push(data.comment);
          this.$refs.commentCount.textContent = data.numOfComments;
        
      
    });

    $(this.$refs.message).summernote({
      placeholder: "Leave a comment",
      // height: 100,
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

    loadMoreComments(){
let url = `/api/loadMorecomments/post/${this.feedId}`;
      // fetch(url)
      //   .then(response => {
      //     return response.json();
      //   })
      //   .then(result => {
      //     this.comments = result;

      //     console.log(result);
      //   });

      alert(this.numOfComments)
    },
    
    fetchComments() {
      let url = `/api/comments/post/${this.feedId}`;
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
        postId: this.feedId,
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
            // this.comments.push(result);
          });
        this.message = "";
        $(".note-editable:visible").html("");
        
      }
    },
  },
};
</script>
