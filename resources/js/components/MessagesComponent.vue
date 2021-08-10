<template>
  <div class="w3-container">
    <div v-for="(message, i) in messages" :key="i">
      <div v-if="user.id == message.user_id" class="w3-container">
        <div class="w3-container w3-right">
          {{ message.message }}
        </div>
      </div>
      <div v-else class="w3-container">
          <div class="w3-container">
            {{ message.message }}
          </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["messages", "user"],

  mounted() {},
  data() {
    return {
      // posts: [],
    };
  },
  methods: {},
};
</script>
