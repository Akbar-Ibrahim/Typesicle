<template>
  <div>
    <div ref="likesModal" id="likesModal" class="w3-modal">
      <div class="w3-modal-content">
        <div class="w3-container">
          <span @click="closeLikesModal" class="w3-button w3-display-topright"
            >&times;</span
          >
          <div v-for="(f, i) in feedLikes" :key="i">
            <div class="profile-card w3-center" style="margin-bottom: 50px">
              <a class="accounts" :href="`/${f.user.username}`">
                <img
                  v-if="f.user.profile.picture == 'avatar.png'"
                  :src="`/images/avatar.png`"
                  class="w3-circle w3-margin-right"
                  style="width: 50px"
                  height="50px"
                />
                <img
                  v-else
                  :src="`/images/${f.user.id}/profile_pic/${f.user.profile.picture}`"
                  class="w3-circle w3-margin-right"
                  style="width: 50px"
                  height="50px"
                />
              </a>
              <a :href="`/${f.user.username}`">
                <h5>{{ f.user.name }}</h5>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="d-flex">
      <div class="">
        <button style="display: none;" class="w3-button" ref="buttonToggle" >
          Like
        </button>
        <button class="w3-button" @click="likeFeed()" ref="buttonIcon"> <i style="border: none; background-color: #7CFC00;" class="fas fa fa-heart"></i> </button>
      </div>
      <div class="">
        <button
          v-if="myFeed.post !== null"
          class="w3-button"
          style="display: none"
          @click="openLikesModal"
          ref="likeCount"
        >
          {{ myFeed.post.likes }}
        </button>

        <button
          v-else-if="myFeed.shortie !== null"
          class="w3-button"
          style="display: none"
          @click="openLikesModal"
          ref="shortieLikeCount"
        >
          {{ myFeed.shortie.likes }}
        </button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["userId", "bus", "myFeed", "type"],

  data() {
    return {
      result: [],
      feedLikes: [],
    };
  },

  mounted() {
    
    this.showLikeCount();
    console.log("Component mounted.");
    this.bus.$on("likechannelreceived", (data) => {
      if (data.feedId == this.myFeed.id) {
        if (data.userId == this.userId) {
          this.toggleLike(data.action);
        }
        // this.likeCounter(data.action)
        this.displayLikeCount(data);
        
      }
    });

    this.liked();
  },

  methods: {

    displayLikeCount (d) {
if (this.myFeed.post !== null){
        this.$refs.likeCount.textContent = d.likeCount;
        if (d.likeCount == 0) {
        this.$refs.likeCount.style.display = "none";
        } else {
          this.$refs.likeCount.style.display = "inline-block";
        }
        } else if (this.myFeed.shortie !== null) {
        this.$refs.shortieLikeCount.textContent = d.likeCount;
        if (d.likeCount == 0) {
        this.$refs.shortieLikeCount.style.display = "none";
        } else {
    this.$refs.shortieLikeCount.style.display = "inline-block";
        }
        }
    },

    showLikeCount() {
      if (this.myFeed.post !== null) {
        if (this.myFeed.post.likes > 0) {
          this.$refs.likeCount.style.display = "inline-block";
        } else {
          this.$refs.likeCount.style.display = "none";
        }
      } else if (this.myFeed.shortie !== null) {
        if (this.myFeed.shortie.likes > 0) {
          this.$refs.shortieLikeCount.style.display = "inline-block";
        } else {
          this.$refs.shortieLikeCount.style.display = "none";
        }
      }
    },

    openLikesModal() {
      if (this.type === "auth") {

      var id;
      if (this.myFeed.post !== null) {
        id = this.myFeed.post_id;
      } else if (this.myFeed.shortie !== null) {
        id = this.myFeed.shortie_id;
      }

      let url = "/api/feed-likes/" + this.myFeed.id;
      fetch(url)
        .then((response) => {
          return response.json();
        })
        .then((result) => {
          this.feedLikes = result;
        });

      this.$refs.likesModal.style.display = "block";
      } else {
        location.href = "/register";
      }
    },

    closeLikesModal() {
      this.$refs.likesModal.style.display = "none";
    },

    liked() {
      if (this.myFeed.post !== null) {
        if (this.myFeed.post.is_liked == 1) {
          this.$refs.buttonToggle.textContent = "Unlike";
          this.$refs.buttonIcon.innerHTML = '<i style="background-color: red;" class="fas fa fa-heart"></i>';
        this.$refs.buttonIcon.style.color = "red";
        this.$refs.buttonIcon.style.border = "none";
        }
      } else if (this.myFeed.shortie !== null) {
        if (this.myFeed.shortie.is_liked == 1) {
          this.$refs.buttonToggle.textContent = "Unlike";
          this.$refs.buttonIcon.innerHTML = '<i style="background-color: red;" class="fas fa fa-heart"></i>';
        this.$refs.buttonIcon.style.color = "red";
        this.$refs.buttonIcon.style.border = "none";
        }
      }
    },

    likeFeed() {
      if (this.type === "auth") {
      var action = this.$refs.buttonToggle.textContent;

      axios
        .post("/posts/" + this.myFeed.id + "/" + this.userId + "/action", {
          action: action,
        })
        .then((response) => {
          console.log(response.data);
        });

      this.toggleLike(action);
      // this.likeCounter(action);
      } else {
        location.href = "/register"
      }
    },

    likeCounter(action) {
      if (action.toLowerCase() === "like") {
        this.$refs.likeCount.textContent++;
      } else {
        this.$refs.likeCount.textContent--;
      }

      if (this.$refs.likeCount.textContent > 0) {
        this.$refs.likeCount.style.display = "inline-block";
      } else {
        this.$refs.likeCount.style.display = "none";
      }
    },

    toggleLike(action) {
      console.log(action);

      if (action.toLowerCase() === "like") {
        this.$refs.buttonToggle.textContent = "Unlike";
        this.$refs.buttonIcon.innerHTML = '<i style="background-color: red; class="fas fa fa-heart"></i>';
        this.$refs.buttonIcon.style.color = "red";
        this.$refs.buttonIcon.style.border = "none";
        
      } else {
        this.$refs.buttonToggle.textContent = "Like";
        this.$refs.buttonIcon.innerHTML = '<i style="background-color: #7CFC00;" class="fas fa fa-heart"></i>';
        this.$refs.buttonIcon.style.border = "none";
        
      }
    },
  },

  computed: {},
};
</script>
