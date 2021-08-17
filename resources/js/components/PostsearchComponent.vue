<template>
  <div class="w3-dropdown-hover" style="width: 100%">
    
    <form method="GET" :action="`/search-post?q=${this.key}`" role="search">
      <div class="input-group">
        <input
          v-model="key"
          @keyup="search"
          type="text"
          name="q"
          value
          style="width: 100%; border: none"
          class="form-control"
          placeholder="Search for posts"
        />

        <span class="input-group-btn" style="border: none">
          <button type="submit" class="btn btn-default w3-text-white" style="background-color: #7CFC00">
            <span class="glyphicon glyphicon-search"></span>
          </button>
        </span>
      </div>
    </form>

    <div
      ref="dropdown"
      class="w3-dropdown-content w3-bar-block"
      style="width: 100%"
    >
      <div v-for="(r, i) in result" :key="i" class="p-4 w3-border-bottom">
        <div class="d-flex">
          <div class="px-2">
            <profile-picture-component
              :user="r.post.user"
              size="height: 35px; width: 35px;"
            ></profile-picture-component>
          </div>

          <div class="flex-grow-1">
            <div>
            <a :href="`/post/${r.post.user.username}/${r.post.url}/${r.id}`">{{
              r.post.title
            }}</a>
            </div>
            <div>
              by  <a :href="`/${r.post.user.username}`"> {{ r.post.user.name }} </a> 
              <span v-if="r.post.category !== null" > in <a href=""> {{ r.post.category.name }} </a> </span>
            </div>
          </div>
          <div>
            <span> {{ r.post.created_at }} </span>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>


<script>
export default {
  props: ["route"],
  data() {
    return {
      key: "",
      result: [],
      res: [],
    };
  },
created(){},
  mounted() {},

  methods: {
     
    async search() {
      if (this.key) {
        let url = `/api/search-post-list?q=${this.key}`;
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