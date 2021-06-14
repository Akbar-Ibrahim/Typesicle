<template>
  <div class="w3-container">
    <!-- Modal for full size images on click-->
    <div
      ref="shortieReplyModal"
      id="shortieReplyModal"
      class="w3-modal w3-black"
      style="padding-top: 0; z-index: 7"
    >
      <span class="w3-button w3-black w3-xlarge w3-display-topright">×</span>
      <div
        class="w3-modal-content w3-animate-zoom w3-transparent w3-padding-64"
      >
        <div v-if="comments.length > 0">
          <div v-for="(comment, i) in comments" :key="i">
            <head-component
              :user="comment.user"
              :date="comment.created_at"
              size="width: 35px"
            >
            </head-component>
            <div>{{ comment.shortie }}</div>
            

            <shortie-image-component 
                            :photos="comment.shortie_photo"
                            :height="comment.shortie_photo.length == 1 ? '500px' : '250px'"
                            :smallscreen-height="comment.shortie_photo.length == 1 ? '300px' : '150px'">

                        </shortie-image-component>
          </div>
        </div>

        <div class="w3-center" v-else>No replies</div>
      </div>
    </div>

    <!-- Comment modal -->

    <div
      ref="createReplyModal"
      id="createReplyModal"
      class="w3-modal w3-black"
      style="padding-top: 0; z-index: 7"
    >
      <span class="w3-button w3-black w3-xlarge w3-display-topright">×</span>
      <div
        class="w3-modal-content w3-animate-zoom w3-transparent w3-padding-64"
      >
        <form
          id="myShorties"
          action="shortie/comment"
          method="post"
          enctype="multipart/form-data"
        >
          <slot></slot>

<input id="count" type="hidden" name="count">
          <input type="hidden" name="shortie_id" :value="quoted" />
          <div class="w3-container">
            <div class="w3-container shortie-container w3-border mb-4">
              <div class="w3-container">
                <textarea
                  id="shortie"
                  style="font-size: 21px; width: 100%; resize: none"
                  class="w3-border py-2 px-2 shortie"
                  placeholder="Wata Guan?"
                  name="shortie"
                ></textarea>
                <div
                  style="display: none"
                  class="w3-container py-4 imageLimitError"
                >
                  You cannot upload more than four images
                </div>
              </div>

              <div class="w3-container my-4 media"></div>

              <div class="w3-container my-4 shortie-option">
                <div class="w3-twothird">
                  <!-- Upload Image button -->

                  <input
                    type="button"
                    id="uploadButton"
                    class="uploadButton w3-button"
                    value="Upload Image"
                  />
                  <div class="inputButton">
                    <input
                      identify="uploadFile1"
                      type="file"
                      class="uploadFile1 fileUpload"
                      style="display: none"
                      name="uploadFile1[]"
                      multiple
                    />
                    <input
                      identify="uploadFile2"
                      type="file"
                      class="uploadFile2 fileUpload"
                      style="display: none"
                      name="uploadFile2[]"
                      multiple
                    />
                    <input
                      identify="uploadFile3"
                      type="file"
                      class="uploadFile3 fileUpload"
                      style="display: none"
                      name="uploadFile3[]"
                      multiple
                    />
                    <input
                      identify="uploadFile4"
                      type="file"
                      class="uploadFile4 fileUpload"
                      style="display: none"
                      name="uploadFile4[]"
                      multiple
                    />
                  </div>

                  <div class="toBeRemoved"></div>
                  <div class="counts">
                    <input class="uploadFile1 count1" type="hidden" name="count1" value="0" />
                    <input class="uploadFile2 count2" type="hidden" name="count2" value="0" />
                    <input class="uploadFile3 count3" type="hidden" name="count3" value="0" />
                    <input class="uploadFile4 count4" type="hidden" name="count4" value="0" />
                  </div>
                </div>

                <div class="w3-third"></div>
              </div>
            </div>

            <input
              id="postButton"
              type="submit"
              class="w3-button"
              name="submitImage"
              value="Post"
              style="display: none"
            />
          </div>
          <button @click="send">Go</button>
        </form>


      </div>
    </div>

    <!-- Options below -->

    <div class="d-flex">
      <div class="dropdown">
        <button class="btn btn-primary" type="button" data-toggle="dropdown">
          <i class="fas fa fa-share"></i>
        </button>

        <ul class="dropdown-menu">
          <li>
            <form method="GET" action="/shortie/create">
              <input type="hidden" name="quoted" :value="quoted" />
              <button class="w3-button" style="width: 100%">Quote</button>
            </form>
          </li>
          <li>
            <form method="POST" action="/w/o/shortie">
              <slot></slot>
              <input type="hidden" name="quoted" :value="shortieId" />
              <button class="share w3-button" style="width: 100%">Share</button>
            </form>
          </li>
        </ul>
      </div>
      <div>
        <button @click="showReplies" class="btn btn-primary">
          <i class="fas fa fa-comment"></i>
        </button>
        <button @click="createReply" class="btn btn-primary">Reply</button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["quoted", "shortieId"],

  mounted() {},
  data() {
    return {
      comments: [],
    };
  },
  methods: {
    send() {
      $("#postButton").click();
    },
    showReplies() {
      this.$refs.shortieReplyModal.style.display = "block";
      let url = `/api/shortie-comments/${this.shortieId}`;
      fetch(url)
        .then((response) => {
          return response.json();
        })
        .then((result) => {
          this.comments = result;

          console.log(result);
        });
    },

    createReply() {
      this.$refs.createReplyModal.style.display = "block";
    },
  },
};
</script>
