<template>
  <div v-if="JSON.parse(accounts).length > 0" class="w3-container mt-4">
    <div class="w3-container w3-margin-top w3-padding-top">
      <h4>Check Out These Authors</h4>
    </div>

    <div
      class="w3-container"
      v-for="(account, i) in JSON.parse(accounts)"
      :key="i"
    >
      <div class="w3-container my-4 py-2">
        <div class="w3-container w3-center my-2 accounts-div">
          <profile-picture-component
            :user="account"
            size="height: 75px; width: 75px;"
          ></profile-picture-component>
        </div>

        <div class="w3-container w3-center my-2">
          <a :href="`/${account.username}`">
            {{ account.name }}
          </a>
        </div>
        <div class="w3-container w3-center my-2">
          <follow-component
            :profile="account.profile.id"
            :status="status"
          ></follow-component>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["status", "accounts"],

  mounted() {},
  data() {
    return {};
  },
  methods: {
    
  },
};
</script>
