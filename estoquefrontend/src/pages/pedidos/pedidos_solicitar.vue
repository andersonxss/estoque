<template>
  <div class="container">
    <b-container class="bv-example-row">
      <b-row>
        <b-col md="8">
          <PedidosBuscaProdutos
            v-show="status_pedido === statuPedido.pendente"
          />
          <PedidosTables />
        </b-col>
        <b-col md="4">
          <b-card
            border-variant="secondary"
            header="Resumo do Pedido"
            header-border-variant="secondary"
            align="center"
          >
            <b-card-text>
              <PedidosFooterValorTotal />
            </b-card-text>

            <template #footer>
              <PedidosFooterActions />
            </template>
          </b-card>
        </b-col>
      </b-row>
    </b-container>
  </div>
</template>

<script>
import { mapState } from "vuex";

import PedidosBuscaProdutos from "./pedidos_busca_produtos";
import PedidosTables from "./pedidos_tables";
import PedidosFooterValorTotal from "./pedidos_footer_valor_total";
import PedidosFooterActions from "./pedidos_footer_actions";
export default {
  data() {
    return {
      id: null,
    };
  },
  components: {
    PedidosBuscaProdutos,
    PedidosTables,
    PedidosFooterValorTotal,
    PedidosFooterActions,
  },
  computed: {
    ...mapState({
      value_produto_total: (state) => state.pedidos.value_produto_total,
      status_pedido: (state) => state.pedidos.status_pedido,
      statuPedido: (state) => state.pedidos.statuPedido,
    }),
  },
};
</script>
