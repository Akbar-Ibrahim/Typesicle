<template>
  <div :id="shortie.id">

<div
        v-if="feed.reposted === 'yes'"
        class="pl-4 my-2" style="margin-left:20px;"
      >
        <div>
          Reposted: Originally by
          <a :href="`/${feed.shortie.user.username}`">{{ feed.shortie.user.name }}</a>
        </div>
</div>

    <div class="w3-hide-small w3-hide-medium">
      <header-component :user="shortie.user" :date="date" size="width: 35px">
      </header-component>
    </div>
    <div class="w3-hide-large">
      <header-component :user="shortie.user" :date="date" size="width: 60px; height: 60px;">
      </header-component>
    </div>

    <!-- Modal for full size images on click-->
    <div
      ref="imageModal"
      class="w3-modal w3-black"
      style="padding-top: 0; z-index: 7"
    >
      <span @click="close" class="w3-button w3-black w3-xlarge w3-display-topright">×</span>
      <div
        class="w3-modal-content w3-animate-zoom w3-center w3-transparent w3-padding-64"
      >
        <img ref="img" class="w3-image" style="width: 50%" />
        <!-- <p id="caption"></p> -->
      </div>
    </div>

    <div>
            
            
      <div v-html="shortie.shortie"
        class="px-4 mb-4 w3-hide-small"
        @click="readShortie"
        style="font-size: 26px; cursor: pointer; font-weight: bold;"
      ></div>
      <div 
        v-html="shortie.shortie"
        class="px-4 mb-4 w3-hide-large"
        @click="readShortie"
        style="font-size: 16px; cursor: pointer"
      ></div>

      <div class="w3-container shortieImages puppies">
        <div class="w3-hide-small w3-hide-medium">
          <div
            :class="
              shortie.shortie_photo.length == 1
                ? 'w3-container '
                : shortie.shortie_photo.length == 2
                ? 'w3-half '
                : shortie.shortie_photo.length == 3
                ? 'w3-third '
                : shortie.shortie_photo.length == 4
                ? 'w3-quarter '
                : ''
            "
            v-for="(photo, i) in shortie.shortie_photo"
            :key="i"
          >
            <img
              class="image"
              @click="showImage(photo.photo.photo, photo.user_id)"
              :src="`/images/${photo.user_id}/${photo.photo.photo}`"
              style="
                object-fit: cover;
                cursor: pointer;
                border-radius: 14px;
                width: 100%;
                
              "
              :height="height"
            />
          </div>
        </div>

        <div class="w3-hide-large">
          <div
            :style="
              shortie.shortie_photo.length == 1
                ? 'width: 100%;'
                : shortie.shortie_photo.length == 2
                ? 'width: 50%; float: left;'
                : shortie.shortie_photo.length == 3
                ? 'width: 33.3%; float: left;'
                : shortie.shortie_photo.length == 4
                ? 'width: 50%; float: left'
                : ''
            "
            v-for="(photo, i) in shortie.shortie_photo"
            :key="i"
          >
            <img
              class="image"
              @click="showImage(photo.photo.photo, photo.user_id)"
              :src="`/images/${photo.user_id}/${photo.photo.photo}`"
              style="
                object-fit: cover;
                cursor: pointer;
                border-radius: 14px;
                width: 100%;
                
              "
              :height="ssheight"
            />
          </div>
        </div>
      </div>
    </div>
    
  </div>
</template>

<script>
export default {
  props: ["shortie", "smallscreenHeight", "date", "feed", "userId"],

  mounted() {
    // this.shared()
    // this.fetchPhotos();
    if (this.shortie.shortie_photo.length == 1) {
      this.height = "400px;"
      this.ssheight = "200px;"
    } else {
      this.height = "200px"
      this.ssheight = "100px"
    }
  },
  
  data() {
    return {
      photos: [],
      height: "200",
      ssheight: "",
    };
  },
  methods: {
            shared() {
            if (this.feed.shortie !== null) {
                if (this.feed.shortie.is_shared == 1) {
                    this.$refs.displayShared.style.display = "block"
                    
                }
            }
        },


    readShortie() {
      if (this.shortie.commenting_on == 0) {
        if (this.shortie.thread !== null) {
          // alert(this.shortie.thread)
          location.href =
            "/shortie/" +
            this.shortie.user.username +
            "/" +
            this.shortie.thread.feed.id +
            "#" +
            this.shortie.id;
        } else {
          location.href =
            "/shortie/" +
            this.shortie.user.username +
            "/" +
            this.shortie.feed.id;
        }
      }
    },

close () {
this.$refs.imageModal.style.display = "none";
},

    showImage(file, id) {
      this.$refs.img.src = `/images/${id}/${file}`;
      this.$refs.imageModal.style.display = "block";

      // document.getElementById("img01").src = `/images/${id}/${file}`;
      // document.getElementById("modal01").style.display = "block";
      // var captionText = document.getElementById("caption");
      // captionText.innerHTML = element.alt;
      // captionText.innerHTML = element.getAttribute("description");
    },

    // fetchPhotos() {
    //   let url = `/api/shortie/photos/${this.shortieId}`;
    //   fetch(url)
    //     .then((response) => {
    //       return response.json();
    //     })
    //     .then((result) => {
    //       this.photos = result;

    //       console.log(result);
    //     });
    // },
  },
};
</script>

<style scoped>
</style>