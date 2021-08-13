<template>
  <div class="dropdown" style="width: 100%;">
    <form method="GET" :action="`/search-author?q=${this.key}`" role="search" class="searchAuthor">
    <div class="input-group">
      <input
        id="searchAuthor"
        v-model="key"
        @keyup="search"
        type="text"
        name="q"
        value
        style="width: 100%; border: none;"
        class=""
        placeholder="Search for authors"
        autocomplete="off"
      />
      <span class="input-group-btn" style="border: none;">
        <button type="submit" class="btn btn-default">
          <span class="glyphicon glyphicon-search"></span>
        </button>
      </span>
      </div>
    </form>
    
    <div id="searchAuthorDropdown" ref="dropdown" class="dropdown-content " style="width: 100%; z-index: 4">
      <div v-for="(r,i) in result" :key="i" class="p-4 w3-border-bottom">
        <div class="d-flex">
          <div>
            <profile-picture-component
              :user="r"
              size="height: 35px; width: 35px;"
            ></profile-picture-component>
          </div>
        
        <div class="flex-grow-w">
          <div>
          <a :href="`/${r.username}`">{{ r.name }}</a>
          </div>
          <div>
            <a :href="`/${r.username}`"> {{ r.posts.length }} <span v-if="r.posts.length == 1"> post </span> <span v-else> posts </span> </a>
          </div>
        </div>
        </div>
      </div>
    </div>
  </div>
</template>


<script>
export default {
  data() {
    return {
      key: "",
      result: []
    };
  },

  mounted() {},

  methods: {
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
    }
  }
};
</script>

<style>
.searchAuthor input[type=text] {
  padding: 15px;
  font-size: 17px;
  border: none;
  /* float: left; */
  width: 80%;
  background: white;
  
}

.searchAuthor input[type=text]:hover {
  background: #f1f1f1;
}

</style>