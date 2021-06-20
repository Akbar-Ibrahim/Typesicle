<template>
  <div v-if="categories.length > 0" class="w3-container">
  <h4> Top Categories </h4> 
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
  props: [],

  mounted() {
    this.fetchCategories();
  },
  data() {
    return {
      categories: [],
    };
  },
  methods: {
    fetchCategories() {
      let url = "/api/top/categories";
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
