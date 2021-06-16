<template>
  <div class="w3-container">
    <!-- Trigger/Open the Modal -->
    <!-- <button @click="openOptions" class="w3-button"> <i style="border: none;" class="far fa-bars"></i> </button> -->

    <!-- The Modal -->
    <div ref="optionsModal" class="w3-modal">
      <div class="w3-modal-content" >
        <div class="w3-container">
          <span @click="closeOptions" class="w3-button w3-display-topright"
            >&times;</span
          >
          <div class="w3-container w3-center">
            <div class="w3-padding w3-margin">
              <h3> Are you sure you want to delete this post? </h3>
              <div class="w3-container" style="margin-top: 50px;">
                  <button @click="handleDelete" style="font-size: 21px;" class="w3-padding w3-margin">Yes</button>
                  <button @click="closeOptions" style="font-size: 21px;" class="w3-padding w3-margin">Cancel</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="dropdown" v-if="type === 'auth' && myFeed.post.user.id == userId">
      <button
        class="btn btn-primary w3-button"
        type="button"
        data-toggle="dropdown"
      >
        &#9776; 
      </button>
      <ul class="dropdown-menu">
        <li @click="editPost">Edit</li>
        <li @click="deletePost">Delete</li>
        <!-- <li v-if="myFeed.post.is_queued == 1" @addToQueue="deletePost">Add to Queue</li>
        <li v-else-if="myFeed.post.is_queued == 0" @addToQueue="deletePost">Remove From Queue</li> -->

      </ul>
    </div>
  </div>
</template>

<script>
export default {
  props: ["feedId", "userId", "feed", "bus", "myFeed", "type"],

  mounted() {},
  data() {
    return {
      // posts: [],
    };
  },
  methods: {
    openOptions() {
      this.$refs.optionsModal.style.display = "block";
    },

    closeOptions() {
      this.$refs.optionsModal.style.display = "none";
    },

    editPost() {
      location.href = "/write/" + this.myFeed.post.id + "/edit";
    },

    deletePost() {
        this.$refs.optionsModal.style.display = "block";      
    },

    handleDelete(){
      this.closeOptions();
      this.$emit('delete-post', this.myFeed);
      
    }
  },
};
</script>


<style scoped>
li {
  cursor: pointer;
  font-size: 16px;
  padding-bottom: 8px;
  padding-left: 8px;
}
</style>