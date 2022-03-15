<template>
  <div class="container">
    <div class="card">
      <div
        class="card-header d-flex align-items-center justify-content-between "
      >
        <span>
          <b>Cadastro de Usuário</b>
        </span>
      </div>

      <div class="card-body">
        <form>
          <div class="form-group">
            <label class="" for="exampleInputNome">Nome</label>
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
            <label class="" for="exampleInputEmail">Email</label>
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
            <label class="" for="exampleInputcpf">Cpf</label>
            <input
              type="email"
              v-model="form.use_cpf"
              class="form-control"
              id="exampleInputcpf"
            />
            <span v-if="allerros.use_cpf" class="text-danger">{{
              allerros.use_cpf[0]
            }}</span>
          </div>

          <div class="form-group">
            <label class="" for="exampleInputSenha">Perfil</label>
            <b-form-select
              v-model="form.use_id_per"
              :options="profiles"
              value-field="per_id"
              text-field="per_nome"
              name="per_id"
            ></b-form-select>

            <span v-if="allerros.use_id_per" class="text-danger">{{
              allerros.use_id_per[0]
            }}</span>
          </div>

          <button
            type="button"
            :disabled="loading"
            @click.prevent="registreClient()"
            class="btn btn-secondary"
          >
            <span>Cadastrar</span>
          </button>

          <p></p>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import { mapActions, mapState } from "vuex";
export default {
  data() {
    return {
      loading: false,
      form: {
        name: "",
        email: "",
        use_id_per: "",
      },
      allerros: [],
      selected: null,
    };
  },

  computed: {
    ...mapState({ profiles: (state) => state.usuarios.profiles }),
  },
  mounted() {
    this.getPofiles().catch(() => {
      this.$vToastify.error("Falha ao carregar os usuarios");
    });
  },

  methods: {
    ...mapActions(["setNovoUsuario", "getPofiles"]),

    registreClient() {
      this.setNovoUsuario(this.form)
        .then(() => {
          this.$vToastify.success("Cadastro realizado com sucesso");
          this.router.push({ name: "login" });
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
        });
    },
  },
};
</script>
