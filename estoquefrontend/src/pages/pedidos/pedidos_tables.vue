<template>
  <div class="table-responsive">
    <table class="table table-striped" v-show="pedido_produtos.length > 0">
      <thead>
        <tr>
          <th style="width:20px" scope="col">#</th>
          <th class="text-center" scope="col" style="width:40%">
            Nome do Produto
          </th>
          <th scope="col" style="width:130px" class="text-center">Preço</th>
          <th scope="col" style="width:30px" class="text-center">
            Quantidade
          </th>

          <th scope="col" style="width:30px" class="text-center">
            Sub Total
          </th>
          <th scope="col" style="width:30px" class="text-center">
            Ação
          </th>
        </tr>
      </thead>

      <tbody>
        <tr v-for="(item, index) in pedido_produtos" :key="index">
          <th scope="row">{{ item.pro_id }}</th>
          <td class="text-center">{{ item.pro_nome }}</td>
          <td class="text-center">R$ {{ formatPrice(item.pro_valor) }}</td>
          <td class="text-center">
            <b-form-spinbutton
              v-if="status_pedido === statuPedido.pendente"
              id="demo-sb"
              inline
              v-model="item.pep_quantidade"
              :formatter-fn="subTotal(item)"
              :min="0"
              :max="item.pro_quantidade"
            ></b-form-spinbutton>
            <span v-if="status_pedido !== statuPedido.pendente">{{
              item.pep_quantidade
            }}</span>
          </td>

          <td class="text-right" v-if="item.pep_valor_pro > 0">
            R$
            {{ formatPrice(item.pep_valor_pro) }}
          </td>

          <td class="text-right" v-else>
            R$ 0
          </td>

          <td class="text-center">
            <button
              class="btn btn-danger btn-sm"
              @click="removerItem(item)"
              v-show="status_pedido === statuPedido.pendente"
            >
              X
            </button>

            <button
              class="btn btn-danger btn-sm"
              v-show="status_pedido !== statuPedido.pendente"
              :disabled="true"
            >
              X
            </button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>
<script>
import { mapActions, mapState } from "vuex";
import formatPrice from "../../utils/formatPrice";
export default {
  data() {
    return {
      formatPrice: formatPrice,
      value: 0,
    };
  },
  created() {
    this.id = this.$route.params.id;
  },
  computed: {
    ...mapState({
      pedido_produtos: (state) => state.pedidos.pedido_produtos,
      status_pedido: (state) => state.pedidos.status_pedido,
      statuPedido: (state) => state.pedidos.statuPedido,
    }),
  },
  mounted() {
    this.getPedidosProdutos(this.id).catch(() => {
      this.$vToastify.error("Falha ao carregar os pedidos");
    });
  },
  methods: {
    ...mapActions(["getPedidosProdutos", "setRemovePedidoProduto"]),
    subTotal(item) {
      if (item.des_id) {
        this.$store.commit("GET_SUB_TOTAL", item);
        this.$store.commit("GET_VALUE_DESCONTO");
      } else {
        item.pep_valor_pro = item.pep_quantidade * item.pro_valor;
        item.pep_valor_pro_desconto = 0;
      }
      this.$store.commit("GET_VALUE_TOTAL");
    },
    removerItem(dados) {
      this.setRemovePedidoProduto(dados).catch(() => {
        this.$vToastify.error("Falha ao remover item");
      });
    },
  },
};
</script>
