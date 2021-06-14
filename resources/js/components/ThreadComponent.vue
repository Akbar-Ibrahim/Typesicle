<template>
  <div class="w3-container">
    <slot name="initial"></slot>

    <div >
      <slot name="rest"></slot>
    </div>

    
  </div>
</template>

<script>
export default {
  props: ["threadId"],

  mounted() {
    // this.showRest();
  },
  data() {
    return {};
  },
  methods: {
    // showRest(text) {
    //   if (this.$refs.threadId.style.display == "none") {
    //     this.$refs.threadId.style.display = "block";
        
    //     text = "Hide thread";
    //     this.$refs.buttonToggle.innerHTML = text;
    //   } else {
    //     this.$refs.threadId.style.display = "none";
    //     text = "Show thread";
    //     this.$refs.buttonToggle.innerHTML = text;
    //   }

    //   // $("#"+this.threadId).toggle();
    // },
  },

  computed: {
    buttonText() {
      
        
    },
  },
};
</script>
