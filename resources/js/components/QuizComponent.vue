<template>
  <div class="w3-container my-4">
    <div class="w3-row-padding">
      <div style="font-size: 17px">
        <h2 class="w3-center w3-margin w3-padding">{{ title }}</h2>

        <p class="w3-center">{{ description }}</p>

        <div class="w3-container w3-center my-4 py-4">
          <button
            :route="route"
            @click="playQuiz"
            v-text="buttonText"
          >
            
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["userId", "title", "description", "route", "quizId"],

  mounted() {
    this.playStatus();
    
  },
  data() {
    return {
      played: [],
    };
  },

  methods: {
    playStatus() {
      let url = "/api/playStatus?user_id=" + this.userId + "&quiz_id=" + this.quizId;
      fetch(url)
        .then((response) => {
          return response.json();
        })
        .then((result) => {
          this.played = result;

          console.log(result);
        });

    },

    playQuiz() {
      location.href = `${this.route}`;
    },
  },

  computed: {
    buttonText() {
      return this.played.id ? "Played" : "Play Quiz!";
    }
  }
};
</script>
