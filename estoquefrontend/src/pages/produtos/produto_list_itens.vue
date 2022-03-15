<template>
  <div class="table-responsive">
    <table class="table table-striped">
      <thead>
        <tr>
          <th class="text-center" scope="col">Id</th>
          <th class="text-center" scope="col">Produto</th>
          <th class="text-center" scope="col">Quantidade</th>
          <th class="text-center" scope="col">Valor</th>
          <th class="text-center" scope="col">Status</th>
          <th class="text-center" scope="col">Ação</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(item, index) in produtos" :key="index">
          <td class="text-center">{{ item.pro_id }}</td>
          <td class="text-center">{{ item.pro_nome }}</td>
          <td class="text-center">{{ item.pro_quantidade }}</td>
          <td class="text-center">R$ {{ formatPrice(item.pro_valor) }}</td>

          <td class="text-center">
            <status :status="{ id: item.sta_id, nome: item.sta_nome }" />
          </td>
          <td class="text-center">
            <router-link
              :to="{ name: 'produtoseditar', params: { id: item.pro_id } }"
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
import formatPrice from "../../utils/formatPrice";
import status from "../../components/status";
export default {
  components: {
    status,
  },
  data: function() {
    return {
      formatPrice: formatPrice,
    };
  },
  mounted() {
    this.getProdutos().catch(() => {
      this.$vToastify.error("Falha ao carregar os produtos");
    });
  },

  computed: {
    ...mapState({
      produtos: (state) => state.produtos.items,
    }),
  },
  methods: {
    ...mapActions(["getProdutos"]),
  },
};
</script>
