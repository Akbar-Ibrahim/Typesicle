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

    
      <button ref="buttonToggle" @click="likeFeed()">Like</button>
      <button
        @click="openLikesModal"
        ref="likeCount"
        :id="`likes-count-${feed.id}`"
      >
        {{ feed.likes }}
      </button>
    
  </div>
</template>

<script>
export default {
  props: ["feedId", "userId", "likes", "feed", "bus", "myFeed"],

  data() {
    return {
      result: [],
      mylikes: this.likes,
      feedLikes: [],
    };
  },

  mounted() {
    console.log("Component mounted.");
    if (this.mylikes.length > 0) {
      this.$refs.likeCount.style.display = "inline-block";
    } else {
      this.$refs.likeCount.style.display = "none";
    }

    this.bus.$on("likechannelreceived", (data) => {
      if (data.feedId == this.feed.id) {
        if (data.userId == this.userId) {
          this.toggleLike(data.action);
        }
        this.likeCounter(data.action);
      }
    });
    this.liked();
  },

  methods: {
    openLikesModal() {
      let url = "/api/post-likes/" + this.feedId;
      fetch(url)
        .then((response) => {
          return response.json();
        })
        .then((result) => {
          this.feedLikes = result;
        });

      this.$refs.likesModal.style.display = "block";
    },

    closeLikesModal() {
      this.$refs.likesModal.style.display = "none";
    },

    liked() {
      if (this.mylikes.length > 0) {
        for (var i = 0; i < this.mylikes.length; i++) {
          if (this.mylikes[i].user_id == this.userId) {
            this.$refs.buttonToggle.textContent = "Unlike";
            break;
          }
        }
      }
    },

    likeFeed() {
      var action = this.$refs.buttonToggle.textContent;
      axios
        .post("/posts/" + this.feedId + "/" + this.userId + "/action", {
          action: action,
        })
        .then((response) => {
          console.log(response.data);
        });

      this.toggleLike(action);
      this.likeCounter(action);
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
      } else {
        this.$refs.buttonToggle.textContent = "Like";
      }
    },
  },

  computed: {},
};
</script>
