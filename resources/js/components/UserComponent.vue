<template>
    <div class="">
        <div class="d-flex " v-if="page === 'follow'">
            <div class="hey ">
                <profile-picture-component
                    :user="JSON.parse(user)"
                    size="height: 100px; width: 100px;"
                ></profile-picture-component>
            </div>
            <div class="flex-grow-1 pl-3">
                <div>
                    <a :href="`/${JSON.parse(user).username}`">
                        <h5>{{ JSON.parse(user).name }}</h5>
                    </a>
                </div>
                <div>
                    <a :href="`/${JSON.parse(user).username}`">
                        <h5>{{ JSON.parse(user).username }}</h5>
                    </a>
                </div>
                <div class="title">{{ JSON.parse(user).profile.bio }}</div>
                <div style="margin: 12px 0">
                    <!-- social media links -->
                </div>
            </div>

            <div class="hey">
                <div v-if="userId !== currentUser">
                    <follow-component
                        :user="userId"
                        :profile="currentUser"
                        :status="status"
                    ></follow-component>
                </div>
            </div>
        </div>

        <!-- profile on small screens -->
<div v-else-if="page === 'profile'">
        <div class="d-flex ">
            <div class="hey ">
                <profile-picture-component
                    :user="JSON.parse(user)"
                    size="height: 75px; width: 75px;"
                ></profile-picture-component>
            </div>
            <div class="flex-grow-1 pl-3">
                <div>
                    <a :href="`/${JSON.parse(user).username}`">
                        <h5>{{ JSON.parse(user).name }}</h5>
                    </a>
                </div>
                <div>
                    <a :href="`/${JSON.parse(user).username}`">
                        <h5>{{ JSON.parse(user).username }}</h5>
                    </a>
                </div>
            </div>
        </div>
        <div class="title">{{ JSON.parse(user).profile.bio }}</div>

        <div class="d-flex">
            <div class="flex-grow-w">
                <follows-component :u="JSON.parse(user)"></follows-component>
            </div>
            <div v-if="userId !== currentUser">
                <follow-component
                    :user="userId"
                    :profile="currentUser"
                    :status="status"
                ></follow-component>
            </div>
        </div>
        </div>

        <!-- end -->
    </div>
</template>

<script>
export default {
    props: ["userId", "currentUser", "status", "user", "usertype", "page"],

    mounted() {
        this.fetchUser();
    },
    data() {
        return {
            myuser: []
        };
    },
    methods: {
        fetchUser() {
            let url = `/api/user/${this.currentUser}`;
            fetch(url)
                .then(response => {
                    return response.json();
                })
                .then(result => {
                    this.myuser = result;

                    console.log(result);
                });
        }
    }
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
