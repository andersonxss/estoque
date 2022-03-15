<template>
  <div>
    <button
      class="btn btn-success btn-block"
      v-show="status_pedido === statuPedido.pendente"
      @click="salvarPedido()"
      :disabled="value_produto_total > 0 ? false : true"
    >
      Salvar Pedido
    </button>

    <button
      class="btn btn-warning btn-block"
      v-show="status_pedido === statuPedido.análise"
      @click="encerrarPedido()"
    >
      Fechar Pedido
    </button>
  </div>
</template>

<script>
import { mapActions, mapState } from "vuex";

import formatPrice from "../../utils/formatPrice";
export default {
  data() {
    return {
      id: null,
      formatPrice: formatPrice,
    };
  },

  computed: {
    ...mapState({
      pedido_produtos: (state) => state.pedidos.pedido_produtos,
      status_pedido: (state) => state.pedidos.status_pedido,
      statuPedido: (state) => state.pedidos.statuPedido,
      value_produto_total: (state) => state.pedidos.value_produto_total,
    }),
  },
  created() {
    console.log(this.pedido_produtos);
    this.id = this.$route.params.id;
  },

  methods: {
    ...mapActions(["SetFecharPedido", "SetEncerrarPedido"]),

    salvarPedido() {
      //Atualizar os dados dos produtos relacionado com os pedidos
      const checkQuantidade = this.pedido_produtos.some(
        (elem) => elem.pep_quantidade === 0
      );
      if (checkQuantidade) {
        this.$vToastify.warning(
          "Existe produto que não foram adicionado quantidade."
        );
      } else {
        this.SetFecharPedido({ id: this.id, produtos: this.pedido_produtos })
          .then((response) => {
            this.$vToastify.success("Ação realizado com sucesso!");
            this.$store.commit(
              "GET_UPDATE_PEDIDOS_STATUS",
              response.data.ped_id_sta
            );
          })
          .catch(() => {
            this.$vToastify.error("Ação não realiado");
          });
      }
    },
    encerrarPedido() {
      this.SetEncerrarPedido(this.id)
        .then(() => {
          this.$vToastify.success("Pedido encerrado com sucesso!");
          this.$router.push("/");
        })
        .catch(() => {
          this.$vToastify.error("Ação não realiado");
        });
    },
  },
};
</script>
