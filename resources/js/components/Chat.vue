<template>
  <div class="w3-container" ref="wrapper">
    <h2 class="w3-hide-large"> Sorry, chats are not supported on small screens yet </h2>
    <div class="w3-row w3-hide-small">
      <div class="w3-col l3">
        <div
          style="cursor: pointer; width: 100%"
          class="w3-container w3-padding w3-border"
          v-for="(u, i) in chatList"
          :key="i"
          @click="loadChat(u)"
        >
        <div class="d-flex">
          <div class="">
            <profile-picture-component
        :user="u"
        size="height: 30px; width: 30px;"
      ></profile-picture-component>
          </div>
          <div class="flex-grow-1 pl-2">
          <div>{{ u.name }}</div>
          <div>{{ u.lastMessage }}</div>
          </div>
          </div>

        </div>
      </div>

      <div class="w3-col l9 w3-hide-small panel panel-default">
        <div class="panel-heading ">
          <div class="d-flex">
          <div>
          <profile-picture-component
        :user="picture"
        size="height: 20px; width: 20px;"
      ></profile-picture-component>
      </div>
      <div ref="with">
           {{ cw.name }}
           </div>
           </div>
            </div>
        <div ref="owner" class="w3-center" style="display: none">
          <h3>You cannot chat with yourself, idiot.</h3>
        </div>
        
        <div class="w3-container " ref="chatArea" style="display: none">
          <div
            class="w3-border panel-body"
            style="width: 100%"
            ref="chatContainer"
          >
            <h1 style="display: none" ref="withId"></h1>
            
            <messages-component
              :user="auth"
              :messages="messages"
            ></messages-component>
          </div>

          <div class="input-group panel-footer">
            <textarea
              ref="message"
              id="btn-input"
              type="text"
              name="message"
              class="form-control input-sm"
              placeholder="Type your message here..."
              @keyup.enter="sendMessage"
            /></textarea>

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
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["users", "me", "chattingWith", "status"],

  data() {
    return {
      messages: [],
      auth: JSON.parse(this.me),
      c_with: JSON.parse(this.chattingWith),
      cw: JSON.parse(this.chattingWith),
      chatList: [],
      recipient: JSON.parse(this.chattingWith).id,
      picture: JSON.parse(this.chattingWith),
    };
  },

  created() {
    this.fetchChatList();
  },

  mounted() {
    if (this.auth.id == this.c_with.id) {
      this.$refs.owner.style.display = "block";
      this.$refs.chatArea.style.display = "none";
    } else {
      this.$refs.owner.style.display = "none";
      this.$refs.chatArea.style.display = "block";
    }

    if (this.status === "yes") {
      this.fetchMessagesOnLoad();
    }
    Echo.private("message-channel").listen("ChatMessage", (event) => {
      if (event.chat.id == event.message.chat_id) {
        if (event.receiver.id == this.auth.id) {
          this.messages.push(event.message);
          // this.chatList = [];
          // this.chatList.push(event.chatList);
          // this.fetchChatList();

          // } else if (this.recipient == event.chat.user_one || this.recipient == event.chat.user_two) {
          //   this.messages.push(event.message);
          // this.chatList = event.receiverChatList;
        }
        if (event.receiver.id == this.auth.id) {
          // this.chatList = event.receiverChatList;
          this.fetchChatList();
        }
      }
    });
  },

  methods: {
    sendMessage() {
      var newMessage = this.$refs.message.value;

      // axios
      //   .post("/messages/", {
      //     message: newMessage,
      //     user_one: this.auth.id,
      //     user_two: this.c_with.id,
      //   })
      //   .then((response) => {
      //     console.log(response.data);
      //     // this.messages.push(response.data);
      //   });

      var data = {
        message: newMessage,
        user_one: this.auth.id,
        user_two: this.recipient,
      };

      data = JSON.stringify(data);

      if (newMessage) {
        fetch("/messages", {
          method: "post",
          headers: {
            "Content-Type": "application/json",
          },
          body: data,
        })
          .then((response) => {
            return response.json();
          })
          .then((result) => {
            console.log(result);
            this.messages.push(result);
          });
      }
      this.$refs.message.value = "";
      this.fetchChatList();
    },

    fetchMessagesOnLoad() {
      this.$refs.withId.textContent = this.c_with.id;
      let url =
        "/messages?user_one=" + this.auth.id + "&user_two=" + this.c_with.id;
      fetch(url)
        .then((response) => {
          return response.json();
        })
        .then((result) => {
          this.messages = result;

          console.log(result);
        });
    },

    fetchChatList() {
      let url = "/chat-list";
      fetch(url)
        .then((response) => {
          return response.json();
        })
        .then((result) => {
          this.chatList = result;

          console.log(result);
        });
    },

    fetchMessages(u) {
      let url = "/messages?user_one=" + this.auth.id + "&user_two=" + u.id;
      fetch(url)
        .then((response) => {
          return response.json();
        })
        .then((result) => {
          this.messages = result;

          console.log(result);
        });
    },

    loadChat(u) {
      this.$refs.chatArea.style.display = "block";
      this.$refs.owner.style.display = "none";
      this.$refs.withId.textContent = u.id;
      this.recipient = u.id;

      this.$refs.with.textContent = u.name;
      this.picture = [];
      this.picture = u;
      this.fetchMessages(u);
      const state = { page_id: 1, user_id: u.id };
      const title = "";
      const url = u.username;

      history.pushState(state, title, url);
    },
  },
};
</script>
