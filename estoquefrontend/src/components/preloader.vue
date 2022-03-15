<template>
  <div class="preloader" v-if="preloader">
    <div class="spinner-border text-light" role="status">
      <span class="sr-only" style="width: 4rem;height:4rem;">{{ textPreloader }}</span>
    </div>
  </div>
</template>

<script>
import { mapState } from "vuex";
export default {
  computed: {
    ...mapState({
      preloader: state => state.preloader,
      textPreloader: state => state.textPreloader
    })
  }
};
</script>

<style>
.preloader {
  background: #080808b5;
  width: 100%;
  height: 100vh;
  position: absolute;
  z-index: 1000;
  display: flex;
  justify-content: center;
  align-items: center;
}
</style>
