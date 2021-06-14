<template>
  <div class="w3-container mt-4">
    
  </div>
</template>

<script>
export default {
  props: ["shortieId"],

  mounted() {},
  data() {
    return {
      
    };
  },

  methods: {
    saifong() {
      this.$emit('write-reply');
    }
  },
};
</script>
