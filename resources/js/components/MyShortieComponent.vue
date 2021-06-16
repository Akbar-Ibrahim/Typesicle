<template>
  <div ref="postContainer" class="w3-container" style="margin-bottom: 50px;">

    
    <shortie-component
      :date="feed.created_at"
      :shortie="feed.shortie"
      :feed="feed"
    >
    </shortie-component>

    <div v-if="feed.shortie.quoted > 0">
      <div class="w3-container w3-border" style="width: 80%; margin: auto">
        <shortie-component
          :date="feed.created_at"
          :shortie="feed.shortie.quoted_shortie"
          :feed="feed"
        >
        </shortie-component>
      </div>
    </div>

    <div class="w3-container" style="margin-top: 30px;">
      <div class="w3-col s3">
        <feed-controls-component
          :user-id="userId"
          :my-feed="feed"
          :bus="bus"
          :type="usertype"
        ></feed-controls-component>
      </div>

      <div class="w3-col s3">
        <share-component
          :user-id="userId"
          :my-feed="feed"
          :bus="bus"
          @remove-post="removePost"
          :type="usertype"
        ></share-component>
      </div>

      <div class="w3-col s3">
        
        <shortie-options-component
      :shortie="feed.shortie"
      :numOfReplies="replyCount"
      @write-reply="writeReply"
      :bus="bus"
    ></shortie-options-component>
      </div>
    </div>

    
    <!-- <shortie-controls-component
      :shortie-id="feed.shortie_id"
    ></shortie-controls-component> -->

    <div ref="replyContainer" style="display: none">
      <div>
        <textarea class="form-control" ref="replyField"></textarea>
      </div>
      <div>
        <div class="w3-left">
          <span ref="remaining" :id="feed.shortie.id">240</span> characters
          remaining
        </div>
        <div class="w3-right w3-border">
          <button @click="closeReply">Cancel</button>
          <button ref="reply" @click="reply">Reply</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["feed", "bus", "userId", "authUser", "usertype"],

  mounted() {
    // this.showRest();
    var reply = this.$refs.reply;
    reply.disabled = true;

    var maxLength = 240;
    var uniqueId = this.feed.shortie.id;
    var chars = this.$refs.remaining;

    $(this.$refs.replyField).summernote({
      toolbar: [],
      // airMode: true,
      callbacks: {
        onKeyup: function (e) {
          // alert('Key is released: ' + e.keyCode);

          var length = $(this)
            .summernote("code")
            .replace(/<\/p>/gi, "\n")
            .replace(/<br\/?>/gi, "\n")
            .replace(/<\/?[^>]+(>|$)/g, "")
            .trim().length;

          var length = maxLength - length;
          chars.innerText = length;

          if (length < 240 && length > 0) {
            reply.disabled = false;
          } else {
            reply.disabled = true;
          }
        },
      },
    });
  },
  data() {
    return {
      shorties: [],
      replyCount: "",
    };
  },
  methods: {
    removePost(data) {
      if (this.usertype === "auth") {
      if (this.authUser.id == this.userId) {
      this.$refs.postContainer.remove();
      }
      } else {
        location.href = "/register";
      }
    },

    writeReply() {
      // this.$refs.replyField.value = "";
      this.$refs.replyField.value = "";
      // $(".note-editable:visible").html("");
      this.$refs.replyContainer.style.display = "block";
    },

    reply() {
      let url = "/shortie/comment";

      var data = {
        shortie_id: this.feed.shortie.id,
        shortie: this.$refs.replyField.value,
      };

      data = JSON.stringify(data);

      fetch(url, {
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
          this.replyCount = result.replies;
        });

      this.$refs.replyField.value = "";
      $(this.$refs.replyField).summernote("code", "");
      this.$refs.replyContainer.style.display = "none";
    },

    closeReply() {
      // this.$refs.pump.innerHTML = $(this.$refs.replyField)
      //   .summernote("code")
      //   .replace(/<\/p>/gi, "\n")
      //   .replace(/<br\/?>/gi, "\n")
      //   .replace(/<\/?[^>]+(>|$)/g, "")
      //   .trim();

      // alert(this.$refs.pump.textContent.length);

      this.$refs.replyContainer.style.display = "none";
      this.$refs.replyField.value = "";
      $(this.$refs.replyField).summernote("code", "");
    },

    getShortieComments() {
      let url = "/api/shortie-comments/" + this.feed.shortie.id;

      fetch(url)
        .then((response) => {
          return response.json();
        })
        .then((result) => {
          this.shorties = result;

          console.log(result);
        });
    },
  },

  computed: {
    buttonText() {},
  },
};
</script>
