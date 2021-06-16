<template>
  <div class="w3-container">
    <button ref="initReply" class="w3-button" @click="initiateReply">
      <i style="border: none" class="fas fa fa-comment"></i>
    </button>

    <button ref="count" style="display: none" class="w3-button" @click="openModal">
      <span ref="commentCount"> {{ shortie.replies }} </span>
    </button>

    <div ref="shortieRepliesOverlay" class="overlay">
      <div class="w3-border w3-container">
        <a href="javascript:void(0)" class="closebtn" @click="closeModal"
          >&times;</a
        >
      </div>
      <div class="overlay-content" style="height: 550px; overflow: scroll">
        <div v-for="(s, i) in shorties" :key="i">
          <shortie-component :date="s.created_at" :shortie="s" :feed="s.feed">
          </shortie-component>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["shortie", "numOfReplies", "bus"],

  beforeUpdate() {
    this.$refs.def.style.display = "none";
    this.$refs.v.style.display = "inline-block";
  },

  mounted() {
    this.bus.$on("shortiereply", (data) => {
      if (this.shortie.id == data.id) {
        // this.$refs.pumpkin.innerHTML = data.count;
        this.$refs.commentCount.textContent = data.count;
        if (data.count) {
          this.$refs.count.style.display = "inline-block";
        }
      }
    });
    this.displayReplyCount();
  },

  data() {
    return {
      shorties: [],
      // numOfReplies: this.shortie.replies,
    };
  },
  methods: {
    displayReplyCount () {
      if (this.shortie.replies > 0) {
        this.$refs.count.style.display = "inline-block";
      } else {
        this.$refs.count.style.display = "none";
      }
    },

    initiateReply() {
      this.$emit("write-reply");
    },

    closeModal() {
      this.$refs.shortieRepliesOverlay.style.width = "0%";
    },

    openModal() {
      this.$refs.shortieRepliesOverlay.style.width = "100%";

      let url = "/api/shortie-comments/" + this.shortie.id;

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
};
</script>

<style scoped>
.overlay {
  height: 100%;
  width: 0;
  position: fixed;
  z-index: 10;
  top: 0;
  left: 0;
  background-color: rgb(0, 0, 0);
  background-color: rgba(0, 0, 0, 0.9);
  overflow-x: hidden;
  transition: 0.5s;
}

.overlay-content {
  position: relative;
  top: 10%;
  width: 50%;
  /* text-align: center; */
  /* margin-top: 30px; */
  margin-left: auto;
  margin-right: auto;
}

.overlay a {
  padding: 8px;
  text-decoration: none;
  font-size: 36px;
  color: #818181;
  display: block;
  transition: 0.3s;
}

.overlay a:hover,
.overlay a:focus {
  color: #f1f1f1;
}

.overlay .closebtn {
  position: absolute;
  top: 20px;
  right: 45px;
  font-size: 60px;
}

@media screen and (max-height: 450px) {
  .overlay a {
    font-size: 20px;
  }
  .overlay .closebtn {
    font-size: 40px;
    top: 15px;
    right: 35px;
  }
}
</style>