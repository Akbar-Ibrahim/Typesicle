<template>
  <div class="">
    
        <div class="px-2">
          <a :href="`/${user.username}`">
            <img v-if="user.profile.picture == 'avatar.png'"
              src="/images/avatar.png"
              alt="Avatar"
              class="w3-center w3-circle w3-border"
              :style="size"
            />
            <img v-else
              :src="`/images/${user.id}/profile_pic/${user.profile.picture}`"
              alt="Avatar"
              class="w3-center w3-circle w3-border"
              :style="size"
            />
          </a>
  </div>        
  </div>
</template>

<script>
export default {
  props: ["size", "user"],

  mounted() {
    
  },
  data() {
    return {
      
      // posts: [],
    };
  },
  methods: {
    
  },
};
</script>
