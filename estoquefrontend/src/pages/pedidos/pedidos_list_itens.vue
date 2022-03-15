<template>
  <div class="table-responsive">
    <table class="table table-striped">
      <thead>
        <tr>
          <th class="text-center" scope="col">Pedido</th>
          <th class="text-center" scope="col">Data da Solicitação</th>
          <th class="text-center" scope="col">Valor sem desconto</th>
          <th class="text-center" scope="col">Desconto</th>
          <th class="text-center" scope="col">Usuário</th>
          <th class="text-center" scope="col">Status</th>
          <th class="text-center" scope="col">Visualizar</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(item, index) in pedidos" :key="index">
          <td class="text-center">{{ item.ped_id }}</td>
          <td class="text-center">
            {{ luxon(item.created_at) }}
          </td>
          <td class="text-center">
            R$
            {{
              formatPrice(
                item.ped_valor_sem_desconto + item.ped_valor_com_desconto
              )
            }}
          </td>
          <td class="text-center">
            R$ {{ formatPrice(item.ped_valor_com_desconto) }}
          </td>

          <td class="text-center">
            <span class="badge badge-secondary">{{ item.name }}</span>
          </td>
          <td class="text-center">
            <status :status="{ id: item.sta_id, nome: item.sta_nome }" />
          </td>
          <td class="text-center">
            <router-link
              :to="{
                name: `pedidosSolicitar`,
                params: { id: item.ped_id },
              }"
              class="btn btn-secondary btn-sm"
              >Visualizar</router-link
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
    this.getPedidos().catch(() => {
      this.$vToastify.error("Falha ao carregar os pedidos");
    });
  },
  computed: {
    ...mapState({
      pedidos: (state) => state.pedidos.items,
      statuPedido: (state) => state.pedidos.statuPedido,
    }),
  },
  methods: {
    ...mapActions(["getPedidos"]),

    luxon(data) {
      return this.$luxon(`${data}`, "dd/MM/yyyy");
    },
  },
};
</script>
