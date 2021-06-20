<template>
  <div v-if="pictures.length > 0" class="recent-photos">
    <!-- Modal for full size images on click-->
    <div
      ref="imageModal"
      class="w3-modal w3-black"
      style="padding-top: 0; z-index: 7"
    >
      <span
        @click="close"
        class="w3-button w3-black w3-xlarge w3-display-topright"
        >×</span
      >
      <div
        class="
          w3-modal-content
          w3-animate-zoom
          w3-center
          w3-transparent
          w3-padding-64
        "
      >
        <img ref="img" class="w3-image" style="width: 50%" />
        <!-- <p id="caption"></p> -->
      </div>
    </div>

    <div class="w3-container my-4">
      <h4>
        Photos <a :href="`/${JSON.parse(user).username}/photos`">See all</a>
      </h4>
      <div class="scrollmenu">
        <div
          v-for="(p, i) in pictures"
          :key="i"
          class="horizontal-image-gallery"
          style="width: 100px;"
        >
          <img
            class="photo"
            :src="`/images/${p.user_id}/${p.photo}`"
            @click="showImage(p.photo, p.user_id)"
            alt=""
            style="
              height: 70px;
              width: 100%;
              object-fit: cover;
              cursor: pointer;
            "
          />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["photos", "user"],

  mounted() {},
  data() {
    return {
      pictures: JSON.parse(this.photos),
    };
  },
  methods: {
    showImage(file, id) {
      this.$refs.img.src = `/images/${id}/${file}`;
      this.$refs.imageModal.style.display = "block";
      //  document.getElementById("img01").src = `/images/${id}/${file}`;
      //  document.getElementById("modal01").style.display = "block";
      //  var captionText = document.getElementById("caption");
      // captionText.innerHTML = element.alt;
      //  captionText.innerHTML = element.getAttribute("description");
    },

    close() {
      this.$refs.imageModal.style.display = "none";
    },
  },
};
</script>
