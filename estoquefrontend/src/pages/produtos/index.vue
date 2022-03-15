<template>
  <div class="container-fluid">
    <div class="card">
      <h5
        class="card-header d-flex align-items-center justify-content-between bg-transparent border-0"
      >
        <span>Produtos</span>
        <router-link
          :to="{ name: 'produtosCadastro' }"
          class="btn btn-secondary btn-sm"
          >Novo Produto</router-link
        >
      </h5>

      <div class="card-body p-1">
        <ProdutoListItens />
      </div>
    </div>
  </div>
</template>
<script>
import ProdutoListItens from "./produto_list_itens";
export default {
  components: {
    ProdutoListItens,
  },
};
</script>
