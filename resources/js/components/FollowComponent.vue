<template>
<div>
        <button
          ref="followBtn"
          class="w3-button "
          @click="followProfile"
          @mouseover="textOnMouseover"
          @mouseout="textOnMouseout"
          v-text="buttonText"
        ></button>
        
     </div> 
</template>

<script>
export default {
  props: ["user", "profile", "status"],

  data() {
    return {
      result: []
    };
  },

  mounted() {
    console.log("Component mounted.");
  },

  methods: {
    async followProfile() {
      
      // let url = `/profile-follow?profileId=${this.profile}&status=${this.status}`;
if (this.status == -1) {
  location.href = "/register"
} else {

      if (this.status == 1) {
        this.status = 0;
      } else {
        this.status = 1;
      }

      let url = "/profile-follow?profileId=" + this.profile + "&status=" + this.status;
      
      let response = await fetch(url);
      this.result = await response.json();
  
  
}

    },

    // followProfile() {
    //   if (this.status == 1) {
    //     this.status = 0;
    //     this.$refs.followBtn.innerHTML = "Follow";
    //   } else {
    //     this.status = 1;
    //     this.$refs.followBtn.innerHTML = "Following";
    //   }

    //   let url =
    //     "/profile-follow?profileId=" + this.profile + "&status=" + this.status;

    //   $.get(url);
    // },

    textOnMouseover() {
      if (this.status == 1) {
        this.$refs.followBtn.innerHTML = "Unfollow";
      }
    },

    textOnMouseout() {
      if (this.status == 1) {
        this.$refs.followBtn.innerHTML = "Following";
      }
    }
  },

  computed: {
    buttonText() {
      return this.status == 1 ? "Following" : "Follow";
    }
  }
};
</script>
