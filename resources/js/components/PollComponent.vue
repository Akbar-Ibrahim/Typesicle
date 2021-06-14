<template>
  <div class="w3-container my-4">
    <div class="w3-row-padding ">
      <div class="w3-container w3-margin-bottom">
        
        <header-component :user="user" :date="date" size="width: 35px">
    </header-component>

        <h3>{{ feed.poll.question }}</h3>
      </div>
      <div class="w3-col l9">
        <div class="w3-container button-container">
          <button ref="choiceOne" @click="firstChoice">
            {{ feed.poll.first_choice }}
          </button>
        </div>
        <div class="w3-container button-container">
          <button ref="choiceTwo" @click="secondChoice">
            {{ feed.poll.second_choice }}
          </button>
        </div>
        <div class="w3-container button-container">
          <button
            ref="choiceThree"
            @click="thirdChoice"
            v-if="feed.poll.third_choice !== null"
          >
            {{ feed.poll.third_choice }}
          </button>
        </div>
        <div class="w3-container button-container">
          <button
            ref="choiceFour"
            @click="fourthChoice"
            v-if="feed.poll.fourth_choice !== null"
          >
            {{ feed.poll.fourth_choice }}
          </button>
        </div>
      </div>

      <div class="w3-col l3 w3-center">
        <h1>{{ this.votes.length }}</h1> 
        <div>votes</div>
        </div>
    </div>
    <div ref="myChoiceContainer" style="display: none; margin-left: 50px;"> You voted for <span ref="myChoice"></span> </div>
  </div>
</template>

<script>
export default {
  props: ["feed", "userId", "date", "user"],

  mounted() {
    
    this.voted();
    

  },
  data() {
    return {
      votes: this.feed.poll.votes,
      

    };
  },

  methods: {
    
    voted() {
      if (this.votes.length > 0) {
        for (var i = 0; i < this.votes.length; i++) {
          if (this.votes[i].user_id == this.userId) {
            this.$refs.myChoiceContainer.style.display = "block";
          this.$refs.myChoice.innerHTML = this.votes[i].my_choice;

            this.$refs.choiceOne.disabled = true;
            this.$refs.choiceTwo.disabled = true;
            this.$refs.choiceThree.disabled = true;
            this.$refs.choiceFour.disabled = true;


    
            break;
          }
        }
      }
    },

    firstChoice() {
      var data = {
        first_choice: 1,
        poll_id: this.feed.poll_id,
      };

      data = JSON.stringify(data);

      fetch("/vote", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: data,
      })
        .then((response) => {
          return response.json();
        })
        .then((result) => {
          
          this.votes.push(result);

        this.$refs.myChoiceContainer.style.display = "block";
        this.$refs.myChoice.innerHTML = result.my_choice;

          this.$refs.choiceOne.disabled = true;
            this.$refs.choiceTwo.disabled = true;
            this.$refs.choiceThree.disabled = true;
            this.$refs.choiceFour.disabled = true;
        });

    },

    secondChoice() {
      var data = {
        second_choice: 2,
        poll_id: this.feed.poll_id,
      };

      data = JSON.stringify(data);

      fetch("/vote", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: data,
      })
        .then((response) => {
          return response.json();
        })
        .then((result) => {
          this.votes.push(result);

  this.$refs.myChoiceContainer.style.display = "block";
        this.$refs.myChoice.innerHTML = result.my_choice;

          this.$refs.choiceOne.disabled = true;
            this.$refs.choiceTwo.disabled = true;
            this.$refs.choiceThree.disabled = true;
            this.$refs.choiceFour.disabled = true;
        });
    },

    thirdChoice() {
      var data = {
        third_choice: 3,
        poll_id: this.feed.poll_id,
      };

      data = JSON.stringify(data);

      fetch("/vote", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: data,
      })
        .then((response) => {
          return response.json();
        })
        .then((result) => {
          this.votes.push(result);

        this.$refs.myChoiceContainer.style.display = "block";
        this.$refs.myChoice.innerHTML = result.my_choice;

          this.$refs.choiceOne.disabled = true;
            this.$refs.choiceTwo.disabled = true;
            this.$refs.choiceThree.disabled = true;
            this.$refs.choiceFour.disabled = true;
        });
    },

    fourthChoice() {
      var data = {
        fourth_choice: 4,
        poll_id: this.feed.poll_id,
      };

      data = JSON.stringify(data);

      fetch("/vote", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: data,
      })
        .then((response) => {
          return response.json();
        })
        .then((result) => {
          this.votes.push(result);

        this.$refs.myChoiceContainer.style.display = "block";
        this.$refs.myChoice.innerHTML = result.my_choice;

          this.$refs.choiceOne.disabled = true;
            this.$refs.choiceTwo.disabled = true;
            this.$refs.choiceThree.disabled = true;
            this.$refs.choiceFour.disabled = true;
        });
    },
  },

  computed: {
    buttonText() {
      return this.played.id ? "Played" : "Play Quiz!";
    },
  },
};
</script>

<style scoped>
.button-container button {
  padding: 10px;
  width: 100%;
}

.button-container {
  padding-bottom: 10px;
}
</style>