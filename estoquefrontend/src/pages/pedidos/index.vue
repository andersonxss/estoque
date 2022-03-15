<template>
  <div class="container-fluid">
    <div class="card bg-light mb-2">
      <h5
        class="card-header d-flex align-items-center justify-content-between bg-transparent border-0 "
      >
        <span>Pedidos</span>
        <button class="btn btn-secondary btn-sm" @click="novoPedido()">
          Novo
        </button>
      </h5>

      <div class="card-body p-1">
        <PedidosListItens />
      </div>
    </div>
  </div>
</template>

<script>
import { mapActions, mapState } from "vuex";

import PedidosListItens from "./pedidos_list_itens";
export default {
  components: {
    PedidosListItens,
  },
  computed: {
    ...mapState({
      statuPedido: (state) => state.pedidos.statuPedido,
      session_id: (state) => state.auth.me.id,
    }),
  },
  methods: {
    ...mapActions(["setNovoPedido"]),

    novoPedido() {
      this.$swal({
        title: "Deseja gerar um novo pedido?",
        showDenyButton: false,
        showCancelButton: true,
        confirmButtonText: `Gerar um novo pedido`,
        cancelButtonText: `Cancelar`,
      }).then((result) => {
        if (result.isConfirmed) {
          this.setNovoPedido({
            ped_valor_com_desconto: 0,
            ped_valor_sem_desconto: 0,
            ped_id_sta: this.statuPedido.pendente,
            ped_id_use: this.session_id,
          })
            .then((response) => {
              console.log(response);
              this.$vToastify.success("Ação realizado com sucesso!");
              this.$router.push({
                name: "pedidosSolicitar",
                params: { id: response.data.id },
              });
            })
            .catch(() => {
              this.$vToastify.error("Ação não realiado");
            });
        }
      });
    },
  },
};
</script>
