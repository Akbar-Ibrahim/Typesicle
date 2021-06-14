<template>
  <div>

    <div v-if="feed.post">

<post-component :user="feed.user" :post="feed" :date="date" size="width: 35px"></post-component>
                            
    </div>

    <div v-else-if="feed.status == 'Shortie'">

    </div>

    <div v-else-if="feed.status == 'Thread'">

    </div>
    
</div>
</template>

<script>
export default {
  props: ["user", "user", "date", "size"],

  mounted() {},
  data() {
    return {
      feed: JSON.parse(this.post),
    };
  },
  methods: {},
};
</script>
