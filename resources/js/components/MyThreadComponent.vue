<template>
  <div class="w3-container">
    <thread-component :thread-id="feed.thread.id">
      <template v-slot:initial>
        <my-shortie-component :usertype="usertype" :auth-user="authUser" :user-id="userId" :feed="feed" :bus="bus"></my-shortie-component>

      </template>

      <template v-slot:rest>
        <!-- Toggle div -->
        <div ref="threadId" style="display: none">
          <div v-for="(f, i) in feeds" :key="i">
            <div v-if="i > 0">
              
              <my-shortie-component :usertype="usertype" :auth-user="authUser" :user-id="userId" :feed="f" :bus="bus"></my-shortie-component>
              </shortie-component>
            </div>
          </div>

          <!-- Toggle div end -->
        </div>
        <!-- Toggle show start -->
        <div class="w3-container w3-margin w3-center">
          <button class="w3-button w3-border" ref="buttonToggle" @click="showRest()">
            Show thread
          </button>
        </div>
        <!-- Toggle show end -->
      </template>
    </thread-component>
  </div>
</template>

<script>
export default {
  props: ["feed", "bus", "userId", "authUser", "usertype", "thread"],

  mounted() {
    // this.showRest();
    
    this.fetchFeed();
    
  },
  data() {
    return {
      feeds: [],
    };
  },
  methods: {
    fetchFeed () {
let url = `/api/shortie/feeds/${this.thread.id}`;
this.feeds = [];
      fetch(url)
        .then((response) => {
          return response.json();
        })
        .then((result) => {
          this.feeds = result;

          
        });
    },

    showRest() {
      if (this.$refs.threadId.style.display == "none") {
        this.$refs.threadId.style.display = "block";

        var text = "Hide thread";
        this.$refs.buttonToggle.innerHTML = text;
      } else {
        this.$refs.threadId.style.display = "none";
        var text = "Show thread";
        this.$refs.buttonToggle.innerHTML = text;
      }

      // $("#"+this.threadId).toggle();
    },
  },

  computed: {
    buttonText() {},
  },
};
</script>
