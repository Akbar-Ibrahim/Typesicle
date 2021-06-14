<template>
  <div class="w3-container">
    <div class="w3-card w3-white w3-round">
      <br />
      <div class="d-flex">
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

        <div class="flex-grow-1 ">
          <div>
            <a :style="fontsize" :href="`/${user.username}`"> {{ user.name }} </a>
          </div>
          <div>
            <a :style="fontsize" :href="`/${user.username}`"> {{ user.username }} </a>
            <span style="font-size: 12px" class="w3-opacity px-2"> {{ date }} </span>
          </div>
        </div>
        <div class="w3-container">
            
        </div>
      </div>
    </div>
    <hr class="w3-clear" />
  </div>
</template>

<script>
export default {
  props: ["date", "size", "fontsize", "user"],

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
