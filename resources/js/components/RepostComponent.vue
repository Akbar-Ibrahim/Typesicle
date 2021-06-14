<template>
  <div class="w3-container">
    <button ref="buttonToggle" @click="shareFeed()">Share</button>
    <button ref="shareCount" :id="`shares-count-${feed.id}`">
      {{ reposts }}</button
    >
  </div>
</template>

<script>
export default {
  props: ["userid", "postid", "status", "feedid", "feed", "reposts"],

  mounted() {
    
  },

  data() {
    return {
      
    };
  },

  methods: {
    shareFeed () {

    },

  },
        

  computed: {

    },

};
</script>

