<template>
  <div class="" style="width: 100%">
    
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

    <div
      class=" w3-bar-block"
      style="width: 100%;"
    >
      <div v-for="(follower, i) in followers" :key="i" class="p-4 w3-border-bottom">
        <div class="d-flex">
          <div>
            <profile-picture-component
              :user="follower.user"
              size="height: 35px; width: 35px;"
            ></profile-picture-component>
          </div>
          <div class="flex-grow-1">
            <a :href="`/${follower.user.username}`">{{ followr.user.name }}</a>
          </div>

          <div>
            <button @click="sendInvite(follower.user.id)" class="w3-button">Send Invite</button>
          </div>

        </div>
      </div>

    </div>
  </div>
</template>


<script>
export default {
  props: ["accounts"],
  data() {
    return {
      key: "",
      followers: JSON.parse(this.accounts)
    };
  },

  mounted() {},

  methods: {
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