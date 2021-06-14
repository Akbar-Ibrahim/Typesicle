<template>
  <div class="w3-container">
    <thread-component :thread-id="feed.thread.id">
            <template v-slot:initial>
              <shortie-component
                :date="feed.created_at"
                :shortie="feed.thread.shorties[0]"
              >
              </shortie-component>

              <div v-if="feed.thread.shorties[0].shortie.quoted > 0">
                <div
                  class="w3-container w3-border"
                  style="width: 80%; margin: auto"
                >
                  <shortie-component
                    :date="feed.created_at"
                    :shortie="feed.thread.shorties[0].quoted_shortie"
                  >
                  </shortie-component>
                </div>
              </div>
            </template>

            <template v-slot:rest>
              <div v-for="(shortie, i) in feed.thread.shorties" :key="i">
                <div v-if="i > 0">
                  <shortie-component
                    :date="shortie.created_at"
                    :shortie="shortie"
                  >
                  </shortie-component>
                </div>
              </div>
            </template>
          </thread-component>
  </div>
</template>

<script>
export default {
  props: ["post"],

  mounted() {
    // this.showRest();
  },
  data() {
    return {
      feed: JSON.parse(this.post),
    };
    
  },
  methods: {
    


  },

  computed: {
    buttonText() {
      
        
    },
  },
};
</script>
