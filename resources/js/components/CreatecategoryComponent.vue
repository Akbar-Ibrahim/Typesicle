<template>
  <div class="w3-container my-4" style="width: 100%">
    <div class="categories">
      <div>
        <div class="w3-container">
        <input
          placeholder="Create New Category"
          name="category"
          value
          class="form-control"
          id="category"
          ref="category"
          v-model="category"
          
        />
        
        </div>
        <div class="" style="display: none;" >
        <button id="createCategory" class="w3-button" @click="handle">Create</button>
        </div>
      </div>

      <div>
        <div class="category d-flex" v-for="(c,i) in categories" :key="i">
          <div class="py-1">
            <button
              v-on:click="selectCategory(i)"
              class="w3-button myCategory "
            >{{ c.name }}</button>
            <a href=""
              v-on:click="selectCategory(i)"
              class="w3-button myCategory w3-hide-large"
            >{{ c.name }}</a>
          </div>
          <div class="flex-grow-1 py-1">
            <div class="w3-right ">
            <button class="w3-button" @click="seePosts(c.user.username, c.url)">
              See Posts
            </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["username"],

  mounted() {
    this.getCategories();

    var categoryInput = document.getElementById("category");

// Execute a function when the user releases a key on the keyboard
categoryInput.addEventListener("keyup", function(event) {
  // Number 13 is the "Enter" key on the keyboard
  if (event.keyCode === 13) {
    // Cancel the default action, if needed
    event.preventDefault();
    // Trigger the button element with a click
    document.getElementById("createCategory").click();
  }
}); 



  },

  data() {
    return {
      category: "",
      categories: [],
    };
  },

  methods: {
    seePosts(username, url){
      location.href = `/${username}/category/${url}`;
    },

    getCategories() {
      let url = `/api/${this.username}/categories`;
      fetch(url)
        .then((response) => {
          return response.json();
        })
        .then((result) => {
          this.categories = result;

          console.log(result);
        });
    },

    selectCategory: function(c) {

        let categoryName = JSON.stringify(this.categories[c].name);
        let categoryId = JSON.stringify(this.categories[c].id);

         var firstQuote = categoryName.charAt(0);
         var lastQuote = categoryName.charAt(categoryName.length - 1);
        var res = categoryName.replace(firstQuote, "");
        var result = res.replace(lastQuote, "");
  
        
        document.getElementById("categoryName").innerHTML = result;
        document.getElementById("categoryId").value = categoryId;

    },

    handle() {
      this.category = this.category || this.$refs.category.value;

      const mydata = {
        category: this.category,
      };

      // mydata = JSON.stringify(mydata);

      if (this.category) {
        fetch("/category-create", {
          method: "post",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify(mydata),
        })
          .then((response) => {
            return response.json();
          })
          .then((result) => {
            this.categories.unshift(result);
          });
        this.category = "";
        // alert("mydata");
      }
    },

  },
};

</script>