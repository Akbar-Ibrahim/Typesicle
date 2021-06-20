<template>
  <div class="w3-container">
    <div v-if="hashtags.length > 0">
      <h4>Trending Now</h4>

      <div v-for="(hashtag, i) in hashtags" :key="i">
        <div>
          <a :href="`/hashtag/${hashtag.stripped_hashtag}`">
            {{ hashtag.hashtag }}
          </a>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: [],

  mounted() {
    this.fetchTrendingNow();
  },
  data() {
    return {
      hashtags: [],
    };
  },
  methods: {
    fetchTrendingNow() {
      let url = `/api/top/hashtags`;
      fetch(url)
        .then((response) => {
          return response.json();
        })
        .then((result) => {
          this.hashtags = result;
          

          console.log(result);
        });
    },
  },
};
</script>
