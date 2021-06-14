<template>
  <div class="w3-container">
    <div style="height: 500px;">
      <div class="chatbox" style="height: 480px; overflow-y: auto">
        <div class="w3-container" v-for="(m, i) in messages" :key="i">
          <div
            v-if="m.sender == myuser.id"
            class="w3-container w3-margin-bottom"
          >
            <div class="w3-container w3-right" style="width: 80%">
              <div class="w3-right">{{ m.message }}</div>
            </div>
          </div>

          <div
            v-else
            class="w3-container w3-margin-bottom w3-margin-top"
            style="width: 80%"
          >
            <div class="d-flex">
              <div>
                <profile-picture-component
                  :user="m.user"
                  size="height: 35px; width: 35px;"
                ></profile-picture-component>
              </div>

              <div class="flex-grow-1">
                <div style="font-size: 11px">
                  <a :href="`/${m.user.username}`">
                    {{ m.user.name }}
                  </a>
                </div>
                <div>{{ m.message }}</div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="sticky w3-border" style="z-index: 4;">
        <div>
          <textarea
            class="form-control"
            ref="chatMessage"
            v-model="message"
          ></textarea>
        </div>

        <div>
          <button @click="sendChat">Send</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["group", "user", "chat"],

  mounted() {
    Echo.private("group-channel").listen("GroupEvent", (event) => {
      if (this.grp.id == event.groupId) {
        this.messages.push(event.message);
      }
      //   console.log("...received event");
    });
  },
  data() {
    return {
      messages: JSON.parse(this.chat),
      myuser: JSON.parse(this.user),
      grp: JSON.parse(this.group),
    };
  },
  methods: {
    sendChat() {
      let url = "/group/send-chat";

      var data = {
        group_id: this.grp.id,
        message: this.$refs.chatMessage.value,
      };

      data = JSON.stringify(data);

      fetch(url, {
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
          //   this.chatt = result;
        });
      this.$refs.chatMessage.value = "";
    },
  },
};
</script>

<style scoped>
div.sticky {
  position: -webkit-sticky;
  position: sticky;
  bottom: 0;
  padding: 5px;
  
}

 /* Hide scrollbar for Chrome, Safari and Opera */
.chatbox::-webkit-scrollbar {
  display: none;
}

/* Hide scrollbar for IE, Edge and Firefox */
.chatbox {
  -ms-overflow-style: none;  /* IE and Edge */
  scrollbar-width: none;  /* Firefox */
} 
</style>
