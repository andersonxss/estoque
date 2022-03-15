<template>
  <div>
    <div
      class="text-light d-flex align-items-center justify-content-between p-0"
      v-if="value_produto_total > 0"
    >
      <p class="text-dark align-middle">{{ produtos.length }} Produtos</p>
      <p class="bg-light p-2 text-right text-secondary">
        R${{ formatPrice(value_produto_total + value_produto_desconto) }}
      </p>
    </div>

    <div
      class="text-light d-flex align-items-center justify-content-between p-0"
      v-if="value_produto_desconto > 0"
    >
      <p class="text-dark align-middle">Desconto</p>
      <p class="bg-success p-2 text-right">
        R${{ formatPrice(value_produto_desconto) }}
      </p>
    </div>

    <div
      class="text-light d-flex align-items-center justify-content-between p-0"
      v-if="value_produto_total > 0"
    >
      <p class="text-dark align-middle">Valor Total</p>
      <p class="bg-secondary p-2 text-right">
        R${{ formatPrice(value_produto_total) }}
      </p>
    </div>
  </div>
</template>

<script>
import { mapState } from "vuex";
import formatPrice from "../../utils/formatPrice";
export default {
  data() {
    return {
      formatPrice: formatPrice,
    };
  },
  computed: {
    ...mapState({
      value_produto_total: (state) => state.pedidos.value_produto_total,
      value_produto_desconto: (state) => state.pedidos.value_produto_desconto,
      produtos: (state) => state.produtos.items,
    }),
  },
};
</script>
