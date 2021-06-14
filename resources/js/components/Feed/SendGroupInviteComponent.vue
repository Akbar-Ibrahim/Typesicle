<template>
  <div v-if="JSON.parse(accounts).length > 0" class="w3-container mt-4">
    <div class="w3-container w3-margin-top w3-padding-top">
      
      <h4 class="w3-center">
        It's lonely out here :(. Invite some of your followers to join!
      </h4>
    </div>

    <div
      class="w3-container"
      v-for="(account, i) in JSON.parse(accounts)"
      :key="i"
    >
      <div class="w3-container my-4 py-2 d-flex">
        <div class="w3-container w3-center my-2 accounts-div">
          <a
            class="accounts"
            :href="`/${account.username}`"
            @mouseover="zoomout"
            @mouseout="zoomin"
          >
            <img
              v-if="account.profile.picture == 'avatar.png'"
              src="/images/avatar.png"
              alt=""
              class="w3-center w3-circle accounts"
              style="width: 35px; cursor: pointer"
            />

            <img
              v-else
              :src="`/images/${account.id}/profile_pic/${account.profile.picture}`"
              alt=""
              class="w3-center w3-circle accounts"
              style="width: 35px; cursor: pointer"
            />
          </a>
        </div>

        <div class="w3-container w3-center my-2 ">
          <a :href="`/${account.username}`">
            {{ account.name }}
          </a>
        </div>
        <div class="w3-container w3-center my-2 ">
          <button class="w3-button">Send Invite</button>
        </div>
        
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["status", "accounts", "userId"],

  mounted() {},
  data() {
    return {};
  },
  methods: {
    zoomout() {
      $(".accounts").mouseover(function () {
        $(this).addClass("well-sm");
      });
    },

    zoomin() {
      $(".accounts").mouseout(function () {
        $(this).removeClass("well-sm");
      });
    },
  },
};
</script>
