<template>
  <div class="login">
    <form class="shadow-lg p-3 mb-5 bg-white rounded">
      <div class="form-group">
        <label for="exampleInputNome">Nome</label>
        <input
          type="text"
          class="form-control"
          v-model="form.name"
          id="exampleInputNome"
        />
        <span v-if="allerros.name" class="text-danger">{{
          allerros.name[0]
        }}</span>
      </div>
      <div class="form-group">
        <label for="exampleInputEmail">Email</label>
        <input
          type="email"
          v-model="form.email"
          class="form-control"
          id="exampleInputEmail"
          aria-describedby="emailHelp"
        />
        <span v-if="allerros.email" class="text-danger">{{
          allerros.email[0]
        }}</span>
      </div>
      <div class="form-group">
        <label for="exampleInputuCPF">CPF</label>
        <input
          type="text"
          v-model="form.use_cpf"
          class="form-control"
          id="exampleInputuCPF"
          aria-describedby="CPFHelp"
        />
        <span v-if="allerros.use_cpf" class="text-danger">{{
          allerros.use_cpf[0]
        }}</span>
      </div>
      <div class="form-group">
        <label for="exampleInputSenha">Senha</label>
        <input
          type="password"
          v-model="form.password"
          class="form-control"
          id="exampleInputSenha"
        />
        <span v-if="allerros.password" class="text-danger">{{
          allerros.password[0]
        }}</span>
      </div>

      <button
        type="button"
        :disabled="loading"
        @click.prevent="registreClient()"
        class="btn btn-primary"
      >
        <span v-if="loading">Cadastrando...</span>
        <span v-else>Cadastrar</span>
      </button>

      <p>
        <router-link
          :to="{
            name: 'login',
          }"
          class="btn btn-link float-right"
          >Login</router-link
        >
      </p>
    </form>
  </div>
</template>
<style>
.login {
  background: #272727;
  width: 100%;
  height: 100vh;
  position: absolute;
  z-index: 1000;
  display: flex;
  justify-content: center;
  align-items: center;
}

.login form {
  width: 30%;
  min-width: 300px;
  min-height: 450px;
  background: white;
}
</style>

<script>
import { mapActions } from "vuex";
export default {
  data() {
    return {
      loading: false,
      form: {
        name: "",
        email: "",
        use_cpf: "",
        password: "",
        use_id_per: 2,
      },
      allerros: [],
    };
  },
  methods: {
    ...mapActions(["register"]),

    registreClient() {
      this.loading = true;

      this.register(this.form)
        .then(() => {
          this.$vToastify.success("Cadastro realizado com sucesso");
          this.$router.push({ name: "login" });
        })
        .catch((error) => {
          const response = error.response;
          if (response.status === 422) {
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
