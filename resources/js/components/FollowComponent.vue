<template>
<div>
        <button
        style="color: white, background-color: #04AA6D;"
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
      result: [],
      checkStatus: this.status
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

      if (this.checkStatus == 1) {
        this.checkStatus = 0;
      } else {
        this.checkStatus = 1;
      }

      let url = "/profile-follow?profileId=" + this.profile + "&status=" + this.checkStatus;
      
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
      if (this.checkStatus == 1) {
        this.$refs.followBtn.innerHTML = "Unfollow";
        this.$refs.followBtn.style.backgroundColor = "red";
      }
    },

    textOnMouseout() {
      if (this.checkStatus == 1) {
        this.$refs.followBtn.innerHTML = "Following";
        this.$refs.followBtn.style.backgroundColor = "#04AA6D";
      }
    }
  },

  computed: {
    buttonText() {
      return this.checkStatus == 1 ? "Following" : "Follow";
    }
  }
};
</script>
