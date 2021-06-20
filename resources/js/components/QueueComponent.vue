<template>
  <div class="w3-container">
    <span style="display: none;" ref="buttonToggle">Queue</span>
    <button @click="queuePost" ref="buttonIcon" style="border: none;">
        <i style="border: none;" class="fas fa fa-plus"></i>
    </button>
    
    </div>
    
</template>

<script>
export default {
  props: ["myFeed", "type", "userId"],

  mounted() {
    
  },
  data() {
    return {
      
    };
  },
  methods: {
    queuePost() {
if (this.type === "auth") {
      var action = this.$refs.buttonToggle.textContent;

      // axios
      //   .post("/queue/post/" + this.myFeed.id + "/" + this.userId + "/action", {
      //     action: action,
      //   })
      //   .then((response) => {
      //     console.log(response.data);
      //   });

      this.toggleQueue(action);

      } else {
        location.href = "/register"
      }
    },    

    toggleQueue(action) {

      if (action.toLowerCase() === "queue") {
        this.$refs.buttonToggle.textContent = "Queued";
        this.$refs.buttonIcon.innerHTML = '<i style="border: none;" class="far fas fa fa-minus-hexagon"></i>';
        
      } else {
        this.$refs.buttonToggle.textContent = "Queue";
        this.$refs.buttonIcon.innerHTML = '<i style="border: none;" class="fas fa fa-plus"></i>';
        
      }
    },
  },
};
</script>
