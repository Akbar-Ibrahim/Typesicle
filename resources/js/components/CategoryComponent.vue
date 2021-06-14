<template>
  <div v-if="categories.length > 0" class="w3-container">
    
    <div class="w3-container" v-for="(category, i) in categories" :key="i">

        <a :href="`/${category.user.username}/category/${category.url}`" class="w3-button">{{
          category.name
        }}
        </a>
        <a href="" class="w3-right w3-button">
          {{ category.posts.length }}
        
        </a>

    </div>
  </div>
</template>

<script>
export default {
  props: ["userId", "route"],

  mounted() {
    this.fetchCategories();
  },
  data() {
    return {
      message: "",
      categories: [],
    };
  },
  methods: {
    fetchCategories() {
      let url = '/api/user-categories?user_id=' + this.userId;
      fetch(url)
        .then((response) => {
          return response.json();
        })
        .then((result) => {
          this.categories = result;

          console.log(result);
        });
    },
  },
};
</script>
