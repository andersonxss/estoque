<template>
  <nav class="navbar navbar-dark bg-dark">
    <span class="navbar-brand mb-0 h1">Sistema de estoque</span>
    <div class="float-right text-white">
      <router-link :to="{ name: 'pedidos' }" class="btn btn-light btn-sm mr-2"
        >Home</router-link
      >

      <router-link :to="{ name: 'produtos' }" class="btn btn-light btn-sm mr-2"
        >Produtos</router-link
      >

      <router-link :to="{ name: 'usuarios' }" class="btn btn-light btn-sm mr-2"
        >Usuários</router-link
      >

      <b-dropdown
        id="dropdown-dropleft"
        dropleft
        size="sm"
        class="m-2"
        variant="link"
        no-caret
      >
        <template #button-content>
          <b-avatar></b-avatar>
        </template>

        <b-dropdown-item @click.prevent="sair">Sair</b-dropdown-item>
      </b-dropdown>
    </div>
  </nav>
</template>

<script>
import { mapState, mapActions } from "vuex";
export default {
  computed: {
    ...mapState({
      me: (state) => state.auth.me,
    }),
  },

  methods: {
    ...mapActions(["logout"]),

    sair() {
      this.logout().then(() => {
        this.$router.push({ name: "login" });
      });
    },
  },
  name: "Normal",
};
</script>
