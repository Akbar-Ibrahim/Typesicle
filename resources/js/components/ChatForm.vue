<template>
  <div class="w3-container">
<div>
  <button v-for="(u, i) in JSON.parse(users)" :key="i" @click="loadChat"> {{ u.username }} </button>
</div>
    <div class="panel-body">
      <messages-component :user="user" :messages="messages"></messages-component>
    </div>

    <div class="input-group">
      <input
        ref="message"
        id="btn-input"
        type="text"
        name="message"
        class="form-control input-sm"
        placeholder="Type your message here..."
        @keyup.enter="sendMessage"
      />

      <span class="input-group-btn">
        <button
          class="btn btn-primary btn-sm"
          id="btn-chat"
          @click="sendMessage"
        >
          Send
        </button>
      </span>
    </div>
  </div>
</template>

<script>
export default {
  props: ["user", "userOne", "userTwo", "users"],

  created() {},

  mounted() {
    this.fetchMessages();

    Echo.private("message-channel").listen("ChatMessage", (event) => {
      if (this.userOne == event.chat.user_one && this.userTwo == event.chat.user_two || this.userOne == event.chat.user_two && this.userTwo == event.chat.user_one) {
      this.messages.push(event.message);
      }
    });
  },
  data() {
    return {
      messages: [],
    };
  },
  methods: {
    sendMessage() {
      var newMessage = this.$refs.message.value;

      axios
        .post("/messages/", {
          message: newMessage,
          user_one: this.userOne,
          user_two: this.userTwo
        })
        .then((response) => {
          console.log(response.data);
          this.messages.push(response.data);
        });

      this.$refs.message.value = "";
    },

    fetchMessages() {
      let url = "/messages?user_one=" + this.userOne + "&user_two=" + this.userTwo;
      fetch(url)
        .then((response) => {
          return response.json();
        })
        .then((result) => {
          this.messages = result;

          console.log(result);
        });
    },

    loadChat() {
      alert("hey")
    }
  },
};
</script>
