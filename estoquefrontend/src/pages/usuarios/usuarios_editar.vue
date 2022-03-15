<template>
  <div class="container">
    <div class="card">
      <div
        class="card-header d-flex align-items-center justify-content-between "
      >
        <span>
          <b>Edição de Usuário</b>
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
            @click.prevent="editarUsuario()"
            class="btn btn-secondary"
          >
            <span>Editar</span>
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
        id: null,
      },
      allerros: [],
      selected: null,
      id: null,
      men_error: "Falha ao carregar os usuarios",
    };
  },

  computed: {
    ...mapState({
      profiles: (state) => state.usuarios.profiles,
      usuario: (state) => state.usuarios.usuario,
    }),
  },
  created() {
    this.form.id = this.$route.params.id;
  },
  mounted() {
    this.getPofiles().catch(() => {
      this.$vToastify.error(this.men_error);
    });

    this.getUsuario(this.form.id)
      .then((response) => {
        const dados = response.data;
        this.form.name = dados.name;
        this.form.email = dados.email;
        this.form.use_id_per = dados.use_id_per;
        this.form.use_cpf = dados.use_cpf;
      })
      .catch(() => {
        this.$vToastify.error(this.men_error);
      });
  },

  methods: {
    ...mapActions(["getUsuario", "getPofiles", "setEditarUsuario"]),

    editarUsuario() {
      this.setEditarUsuario(this.form)
        .then(() => {
          this.$vToastify.success("Edição realizada com sucesso");
          this.$router.push("/usuarios");
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
