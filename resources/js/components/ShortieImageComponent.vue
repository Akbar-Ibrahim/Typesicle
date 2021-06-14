<template>
  <div>
    

    <!-- Modal for full size images on click-->
    <div
      ref="imageModal"
      id="modal01"
      class="w3-modal w3-black"
      style="padding-top: 0; z-index: 7"
      onclick="this.style.display='none'"
    >
      <span class="w3-button w3-black w3-xlarge w3-display-topright">×</span>
      <div
        class="w3-modal-content w3-animate-zoom w3-center w3-transparent w3-padding-64"
      >
        <img ref="photo" id="img01" class="w3-image" style="width: 50%" />
        <!-- <p id="caption"></p> -->
      </div>
    </div>

    <div>
      
      <div class="w3-container shortieImages ">
        <div class="w3-hide-small">
          <div
            :class="
              photos.length == 1
                ? 'w3-container '
                : photos.length == 2
                ? 'w3-half '
                : photos.length == 3
                ? 'w3-third '
                : photos.length == 4
                ? 'w3-quarter '
                : ''
            "
            v-for="(photo, i) in photos"
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
              :height="`${height}`"
            />
          </div>
        </div>

        <div class="w3-hide-large">
          <div
            :style="
              photos.length == 1
                ? 'width: 100%;'
                : photos.length == 2
                ? 'width: 50%; float: left;'
                : photos.length == 3
                ? 'width: 33.3%; float: left;'
                : photos.length == 4
                ? 'width: 50%; float: left'
                : ''
            "
            v-for="(photo, i) in photos"
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
              :height="`${smallscreenHeight}`"
            />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: [
    "photos",
    "height",
    "smallscreenHeight",
    
    
  ],

  mounted() {
    
  },
  data() {
    return {
      
    };
  },
  methods: {
    readShortie() {
      // location.href = `${this.route}`;
    },

    showImage(file, id) {
      document.getElementById("img01").src = `/images/${id}/${file}`;
      document.getElementById("modal01").style.display = "block";
      var captionText = document.getElementById("caption");
      captionText.innerHTML = element.alt;
      captionText.innerHTML = element.getAttribute("description");
    },

    
  },
};
</script>

<style scoped>
</style>