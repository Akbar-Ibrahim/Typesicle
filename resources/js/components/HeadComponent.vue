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

        <div>
          <div>
            <a :style="fontsize" :href="`/${user.username}`"> {{ user.name }} </a>
          </div>
          <div>
            <span :style="fontsize" class="w3-opacity"> {{ date }} </span>
          </div>
        </div>
      </div>
    </div>
    <hr class="w3-clear" />
  </div>
</template>

<script>
export default {
  props: ["date", "size", "fontsize", "user", "fontsize"],

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
