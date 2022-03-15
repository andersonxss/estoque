<template>
  <div>
    <form class="shadow-lg p-3 mb-5 bg-white rounded">
      <div class="form-group">
        <label for="InputEmail">Email</label>
        <input
          type="email"
          v-model="form.email"
          class="form-control"
          id="InputEmail"
        />
        <span v-if="allerros.email" class="text-danger">{{
          allerros.email[0]
        }}</span>
      </div>
      <div class="form-group">
        <label for="InputPassword">Senha</label>
        <input
          type="password"
          v-model="form.password"
          class="form-control"
          id="InputPassword"
        />
        <span v-if="allerros.password" class="text-danger">{{
          allerros.password[0]
        }}</span>
      </div>

      <button
        type="submit"
        @click.prevent="auth()"
        class="btn btn-primary btn-block"
      >
        {{ this.text_buttom }}
      </button>
      <p>
        <router-link :to="{ name: 'register' }" class="btn btn-link float-right"
          >Cadastrar Conta</router-link
        >
      </p>
    </form>
  </div>
</template>

<script>
import { mapActions } from "vuex";

export default {
  data() {
    return {
      loading: false,
      text_buttom: "Entrar",
      form: {
        email: "cliente@gmail.com",
        password: 12345678,
      },
      allerros: [],
    };
  },
  computed: {
    deviceName() {
      return (
        navigator.appCodeName +
        navigator.appName +
        navigator.platform +
        this.form.email
      );
    },
  },
  methods: {
    ...mapActions(["login", "getMe"]),

    auth() {
      this.loading = true;
      this.text_buttom = "Enviando...";
      const param = { deviceName: this.deviceName, ...this.form };
      this.login(param)
        .then((response) => {
          localStorage.setItem("TOKEN_NAME", response.data.token);
          if (response.data.success === false) {
            this.getMe();
            this.$vToastify.error("Dados invalidos");
          } else {
            this.$vToastify.success("Login realizado com sucesso");
            location.href = "/";
            //this.$router.push({ name: "pedidos" });
          }
        })
        .catch((error) => {
          const response = error.response;

          if (response.status === 422 || response.success === false) {
            this.allerros = error.response.data.errors;
            this.$vToastify.error("Dados invalidos");

            setTimeout(() => {
              this.allerros = [];
            }, 4000);
            return;
          }
          this.$vToastify.error("Falha ao registrar");
        })
        .finally(() => (this.loading = false));
    },
  },
};
</script>
