<template>
  <div>
    <div ref="sharesModal" id="sharesModal" class="w3-modal">
      <div class="w3-modal-content">
        <div class="w3-container">
          <span @click="closeSharesModal" class="w3-button w3-display-topright"
            >&times;</span
          >
          <div v-for="(f, i) in feedQuotes" :key="i">
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

<div class="w3-container w3-center">
  <div class="w3-col l6">
    <button ref="buttonToggle" @click="quoteFeed()">Quote</button>
    </div>
    <div class="w3-col l6">
    <button style="display: none" @click="openSharesModal" ref="quoteCount" :id="`shares-count-${feed.id}`">
      <span v-if="myFeed.status === 'rwc'"> {{ myFeed.shares }} </span>
      <span v-else>
      {{ feed.shares }}
      </span></button
    >
    </div>
    </div>
    
  </div>
</template>

<script>
export default {
  props: ["feedId", "userId", "feed", "bus", "myFeed"],

  data() {
    return {
      result: [],
      feedQuotes: [],
    };
  },

  mounted() {
    this.showQuoteCount();
    console.log("Component mounted.");
    this.bus.$on('sharechannelreceived', (data) => {

      var id;
      if (this.myFeed.status === 'rwc') {
        id = this.myFeed.id;
      } else {
        id = this.feed.id;
      }
      
      if (data.feedId == id) {
        if (data.userId == this.userId) {
          this.toggleQuote(data.action);

        }
        this.quoteCounter(data.action)
      }
    });

    if(this.myFeed.status === 'rwc') {
      this.$refs.buttonToggle.disabled = true;
    }

    this.Quoted();

  },

  methods: {
    // saifong() {
    //   this.$emit('remove-post', this.myFeed.id);
    // },

    showQuoteCount() {
      var numOfQuotres;

      if(this.myFeed.status === 'rwc') {
        numOfQuotes = this.myFeed.shares;
      } else {
        numOfQuotes = this.feed.shares;
      }


if (numOfQuotes > 0) {
      this.$refs.quoteCount.style.display = "inline-block";
    } else {
      this.$refs.quoteCount.style.display = "none";
    }
    },

    openSharesModal() {
      var id;
      if (this.myFeed.status === 'rwc') {
        id = this.myFeed.id;
      } else {
        id = this.feed.id;
      }

      let url = "/api/post-likes/" + id;
      fetch(url)
        .then((response) => {
          return response.json();
        })
        .then((result) => {
          this.feedShares = result;
        });

      this.$refs.sharesModal.style.display = "block";
    },

    closeSharesModal() {
      this.$refs.sharesModal.style.display = "none";
    },

    quoted() {
      
      var quotesArray = [];
      
      if (this.myFeed.status === 'rwc') {
        if (this.myFeed.shares > 0){
          quotesArray = this.myFeed.reposts;
        }
      } else {
        if (this.feed.shares > 0) {
        quotesArray = this.feed.reposts;
        }
      }

      if (quotesArray.length > 0) {
      for (var i = 0; i < quotesArray.length; i++) {
        if (quotesArray[i].user_id == this.userId) {
          this.$refs.buttonToggle.textContent = "quoted";
          break;
        }
      }
      }
    },

    quoteFeed() {
      
      var action = this.$refs.buttonToggle.textContent;
      var id;
      if (this.myFeed.status === 'rwc') {
        id = this.myFeed.id;
      } else {
        id = this.feed.id;
      }

      axios
        .post("/quote/" + id + "/" + this.userId + "/" + this.myFeed.id + "/action", {
          action: action,
        })
        .then((response) => {
          console.log(response.data);
        });
        
        if (action.toLowerCase() === 'quoted') {
          this.$emit('remove-post', this.myFeed.id);
        }
      this.toggleQuote(action);
      this.quoteCounter(action);


      
    },

    quoteCounter(action) {

if (action.toLowerCase() === "quote") {  
        this.$refs.quoteCount.textContent++;
      } else {
        this.$refs.quoteCount.textContent--;
      }

      if (this.$refs.quoteCount.textContent > 0) {
      this.$refs.quoteCount.style.display = "inline-block";
      } else {
this.$refs.quoteCount.style.display = "none";
      }
    },

    toggleQuote(action) {
      console.log(action)
      
      if (action.toLowerCase() === "quote") {  
        this.$refs.buttonToggle.textContent = "Quoted";
      } else {
        this.$refs.buttonToggle.textContent = "Quote";
      }
    },

  },

  computed: {},
};
</script>
