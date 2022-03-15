<template>
  <div class="table-responsive">
    <table class="table table-striped">
      <thead>
        <tr>
          <th class="text-center" scope="col">Id</th>
          <th class="text-center" scope="col">Nome</th>
          <th class="text-center" scope="col">Email</th>
          <th class="text-center" scope="col">Perfil</th>
          <th class="text-center" scope="col">Status</th>
          <th class="text-center" scope="col">Visualizar</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(item, index) in usuarios" :key="index">
          <td class="text-center">{{ item.id }}</td>
          <td class="text-center">{{ item.name }}</td>
          <td class="text-center">{{ item.email }}</td>
          <td class="text-center">{{ item.per_nome }}</td>
          <td class="text-center">
            <status :status="{ id: item.sta_id, nome: item.sta_nome }" />
          </td>

          <td class="text-center">
            <router-link
              :to="{ name: 'usuarioseditar', params: { id: item.id } }"
              class="btn btn-secondary btn-sm"
              >Editar</router-link
            >
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import { mapActions, mapState } from "vuex";
import status from "../../components/status";
export default {
  components: {
    status,
  },
  mounted() {
    this.getUsuarios().catch(() => {
      this.$vToastify.error("Falha ao carregar os usuarios");
    });
  },

  computed: {
    ...mapState({
      usuarios: (state) => state.usuarios.items,
    }),
  },
  methods: {
    ...mapActions(["getUsuarios"]),
  },
};
</script>
