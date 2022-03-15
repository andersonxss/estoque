<template>
  <div>
    <preloader-component></preloader-component>

    <Header />
    <div class="container mt-3">
      <div class="container-right">
        <router-view></router-view>
      </div>
    </div>
  </div>
</template>

<style>
.container-pag {
  width: 100%;
  height: calc(100vh - 62px);
  display: flex;
}

.container-pag .container-left {
  background: #cccccc;
  width: 300px;
  height: 100%;
}

.container-pag .container-right {
  width: 100%;
  height: 100%;
  padding-top: 10px;
}
</style>

<script>
import Header from "./components/header";
import { mapState } from "vuex";
export default {
  components: {
    Header,
  },
  created() {
    if (this.authenticated === false) {
      this.$router.push({ name: "login" });
    }
  },
  computed: {
    ...mapState({
      authenticated: (state) => state.auth.authenticated,
    }),
  },
};
</script>
