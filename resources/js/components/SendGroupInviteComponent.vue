<template>
  <div class="" style="width: 100%">
    <div
      ref="myModal"
      class="w3-modal w3-black"
      style="padding-top: 0; z-index: 7"
    >
      <span
        class="w3-button w3-black w3-xlarge w3-display-topright"
        @click="closeModal"
        >×</span
      >
      <div
        class="w3-modal-content w3-animate-zoom w3-transparent w3-padding-64"
      >
        <div class="input-group">
          <input
            v-model="key"
            @keyup="search"
            type="text"
            name="q"
            value
            style="width: 100%; border: none"
            class="form-control"
            placeholder="Send your followers an invitation to join the group"
          />
          <span class="input-group-btn" style="border: none">
            <button type="submit" class="btn btn-default">
              <span class="glyphicon glyphicon-search"></span>
            </button>
          </span>
        </div>

        <div class="w3-bar-block" style="width: 100%; height: 550px; overflow: scroll; ">
          <div
            v-for="(follower, i) in followers"
            :key="i"
            class="p-4 w3-border-bottom"
          >
            <div class="d-flex">
              <div>
                <profile-picture-component
                  :user="follower.user"
                  size="height: 35px; width: 35px;"
                ></profile-picture-component>
              </div>
              <div class="flex-grow-1">
                <div class="w3-container">
                <a :href="`/${follower.user.username}`">{{
                  follower.user.name
                }}</a>
                </div>
                <div class="w3-container">
                <a :href="`/${follower.user.username}`">{{
                  follower.user.username
                }}</a>
                </div>
              </div>

              <div>
                <button @click="sendInvite(follower.user.id)" class="w3-button" v-if="follower.user.query_status === 'no'">
                  Send Invite
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="w3-container w3-center">
      <button class="w3-button" @click="showModal">Add Followers</button>
    </div>
  </div>
</template>


<script>
export default {
  props: ["accounts"],
  data() {
    return {
      key: "",
      followers: JSON.parse(this.accounts),
    };
  },

  mounted() {},

  methods: {
    showModal() {
      this.$refs.myModal.style.display = "block";
    },

    closeModal() {
      this.$refs.myModal.style.display = "none";
    },

    sendInvite(id) {
      
    },

    async search() {
      if (this.key) {
        let url = `/api/search-author-list?q=${this.key}`;
        let response = await fetch(url);
        this.result = await response.json();

        this.toggleDropdown("block");
      } else {
        this.toggleDropdown("none");
      }
      // this.clickOnEnter(event);
    },

    clickOnEnter(event) {
      var x = event.which || event.keyCode;
      if (x == 13 || this.key !== "") {
        alert(this.key);
      }
    },

    toggleDropdown(toggle) {
      this.$refs.dropdown.style.display = toggle;
    },
  },
};
</script>