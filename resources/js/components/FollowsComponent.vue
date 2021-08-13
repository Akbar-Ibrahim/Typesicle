<template>
    <div>


        <button @click="getFollows('following')" ref="following" class="w3-button ">
            Following  <span ref="followingRef"></span>
        </button>

        <button @click="getFollows('followers')" ref="followers" class="w3-button ">
            Followers  <span ref="followersRef"></span>
        </button>
    </div>
</template>

<script>
export default {
    props: ["u"],

    data() {
        return {
            result: [],
            follows: [],
            type: ""
        };
    },

    mounted() {
        this.followersCount();
        this.followingCount();
    },

    methods: {
        async followersCount() {
            let url = `/api/count-followers?id=${this.u.id}`;
            let response = await fetch(url);
            let result = await response.json();
            this.$refs.followersRef.textContent =  " " + result.length;
        },

        async followingCount() {
            let url = `/api/count-followings?id=${this.u.id}`;
            let response = await fetch(url);
            let result = await response.json();
            this.$refs.followingRef.textContent = " " + result.length;
        },

        getFollows(f) {
        location.href = this.u.username + "/"  + f;
      
    },

    
    },

    computed: {
        buttonText() {}
    }
};
</script>
