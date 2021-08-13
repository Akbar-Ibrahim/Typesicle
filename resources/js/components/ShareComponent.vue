<template>
  <div>

    <div ref="sharesModal" id="sharesModal" class="w3-modal">
      <div class="w3-modal-content">
        <div class="w3-container">
          <span @click="closeSharesModal" class="w3-button w3-display-topright"
            >&times;</span
          >
          <div v-for="(f, i) in feedShares" :key="i">
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
    <button style="display: none;" class="w3-button" ref="buttonToggle">Share</button>
    <button class="w3-button" @click="shareFeed()" ref="buttonIcon"> <i style="border: none;" class="far fas fa fa-share"></i> </button>
    </div>
    <div class="">
    
      <button
          v-if="myFeed.post !== null"
          class="w3-button"
          style="display: none"
          @click="openSharesModal"
          ref="shareCount"
        >
          {{ myFeed.post.shares }}
        </button>

        <button
          v-else-if="myFeed.shortie !== null"
          class="w3-button"
          style="display: none"
          @click="openSharesModal"
          ref="shortieShareCount"
        >
          {{ myFeed.shortie.shares }}
        </button>

    </div>
    </div>
    
  </div>
</template>

<script>
export default {
  props: [ "userId",  "bus", "myFeed", "type"],

  data() {
    return {
      result: [],
      feedShares: [],
    };
  },

  mounted() {
    this.showShareCount();
    console.log("Component mounted.");
    this.bus.$on('sharechannelreceived', (data) => {
      
      if (data.feedId == this.myFeed.id) {
        if (data.userId == this.userId) {
          this.toggleShare(data.action);

        }
        // this.shareCounter(data.action)
        this.displayShareCount(data);
      }
    });
    this.shared();

  },

  methods: {
    displayShareCount (d) {
if (this.myFeed.post !== null){
        this.$refs.shareCount.textContent = d.shareCount;
        if (d.shareCount == 0) {
        this.$refs.shareCount.style.display = "none";
        } else {
          this.$refs.shareCount.style.display = "inline-block";
        }
        } else if (this.myFeed.shortie !== null) {
        this.$refs.shortieShareCount.textContent = d.shareCount;
        if (d.shareCount == 0) {
        this.$refs.shortieShareCount.style.display = "none";
        } else {
    this.$refs.shortieShareCount.style.display = "inline-block";
        }
        }
    },

    showShareCount() {
      if (this.myFeed.post !== null) {
        if (this.myFeed.post.shares > 0) {
          this.$refs.shareCount.style.display = "inline-block";
        } else {
          this.$refs.shareCount.style.display = "none";
        }
      } else if (this.myFeed.shortie !== null) {
        if (this.myFeed.shortie.shares > 0) {
          this.$refs.shortieShareCount.style.display = "inline-block";
        } else {
          this.$refs.shortieShareCount.style.display = "none";
        }
      }
    },

    openSharesModal() {
      if (this.type === "auth") {

      var id;
      if (this.myFeed.post !== null) {
        id = this.myFeed.post_id;
      } else if (this.myFeed.shortie !== null) {
        id = this.myFeed.shortie_id;
      }


      let url = "/api/feed-shares/" + this.myFeed.id;
      fetch(url)
        .then((response) => {
          return response.json();
        })
        .then((result) => {
          this.feedShares = result;
        });

      this.$refs.sharesModal.style.display = "block";
      } else {
        location.href = "/register";
      }
    },

    closeSharesModal() {
      this.$refs.sharesModal.style.display = "none";
    },

    shared() {
      
      if (this.myFeed.post !== null) {
        if (this.myFeed.post.is_shared == 1) {
          this.$refs.buttonToggle.textContent = "Shared";
          this.$refs.buttonIcon.style.innerHTML = '<i style="border: none;" class="far fas fa fa-share"></i>';
        this.$refs.buttonIcon.style.color = "red";
        }
      } else if (this.myFeed.shortie !== null) {
        if (this.myFeed.shortie.is_shared == 1) {
          this.$refs.buttonToggle.textContent = "Shared";sharesh
          this.$refs.buttonIcon.style.innerHTML = '<i style="border: none;" class="far fas fa fa-share"></i>';
        this.$refs.buttonIcon.style.color = "red";
        }
      }
    },

    shareFeed() {
      if (this.type === "auth") {
      var action = this.$refs.buttonToggle.textContent;
      

      axios
        .post("/share/" + this.myFeed.id + "/" + this.userId + "/action", {
          action: action,
        })
        .then((response) => {
          console.log(response.data);
        });

      this.toggleShare(action);
        
        if (action.toLowerCase() === 'shared') {
          this.$emit('remove-post', this.myFeed.id);
        }
      
      // this.shareCounter(action);

      } else {
        location.href = "/register";
      }
      
    },

    shareCounter(action) {

if (action.toLowerCase() === "share") {  
        this.$refs.shareCount.textContent++;
      } else {
        this.$refs.shareCount.textContent--;
      }

      if (this.$refs.shareCount.textContent > 0) {
      this.$refs.shareCount.style.display = "inline-block";
      } else {
this.$refs.shareCount.style.display = "none";
      }
    },

    toggleShare(action) {
      console.log(action)
      
      if (action.toLowerCase() === "share") {  
        this.$refs.buttonToggle.textContent = "Shared";
        this.$refs.buttonIcon.style.innerHTML = '<i style="border: none;" class="far fas fa fa-share"></i>';
        this.$refs.buttonIcon.style.color = "red";
      } else {
        this.$refs.buttonToggle.textContent = "Share";
        this.$refs.buttonIcon.style.innerHTML = '<i style="border: none;" class="far fas fa fa-share"></i>';
        

      }
    },

  },

  computed: {},
};
</script>
