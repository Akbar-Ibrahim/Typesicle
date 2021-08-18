<template>
  <div class="">
    <div class="">
      <profile-picture-component
        :user="JSON.parse(user)"
        size="height: 150px; width: 150px;"
      ></profile-picture-component>

      <a :href="`/${JSON.parse(user).username}`">
        <h5>{{ JSON.parse(user).name }}</h5>
      </a>
      <div class="title">{{ JSON.parse(user).profile.bio }}</div>

      <div v-if="this.usertype === 'auth'" class="">
        <div v-if="userId != currentUser" class="">
          <follow-component
            :user="userId"
            :profile="currentUser"
            :status="status"
          ></follow-component>
        </div>
        <follows-component
            :u="JSON.parse(user)"
          ></follows-component>
        <div v-if="userId !== currentUser" class="">
          <!-- <a class="w3-button w3-border" :href="`chat/${JSON.parse(user).username}`">Chat</a> -->
        </div>
      </div>
      <div style="margin: 12px 0">
        <!-- social media links -->
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["userId", "currentUser", "status", "user", "usertype"],

  mounted() {
    this.fetchUser();
  },
  data() {
    return {
      myuser: [],
    };
  },
  methods: {
    fetchUser() {
      let url = `/api/user/${this.currentUser}`;
      fetch(url)
        .then((response) => {
          return response.json();
        })
        .then((result) => {
          this.myuser = result;

          console.log(result);
        });
    },
  },
};
</script>
<style scoped>
.profile-card {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  max-width: 300px;
  margin: auto;
  text-align: center;
  font-family: arial;
}

/* .title {
  color: grey;
  font-size: 18px;
} */

button {
  border: none;
  outline: 0;
  display: inline-block;
  padding: 8px;
  color: white;
  background-color: #000;
  text-align: center;
  cursor: pointer;
  width: 100%;
  font-size: 18px;
}

a {
  text-decoration: none;
  font-size: 22px;
  color: black;
}

button:hover,
a:hover {
  opacity: 0.7;
}
</style>