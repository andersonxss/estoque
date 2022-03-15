<template>
  <div class="container-fluid">
    <div class="card">
      <h5
        class="card-header d-flex align-items-center justify-content-between bg-transparent border-0"
      >
        <span>Usuários</span>
        <router-link
          :to="{ name: 'usuarioscadastro' }"
          class="btn btn-secondary btn-sm"
          >Novo</router-link
        >
      </h5>

      <div class="card-body p-1">
        <UsuarioListItens />
      </div>
    </div>
  </div>
</template>
<script>
import UsuarioListItens from "./usuario_list_itens";
export default {
  components: {
    UsuarioListItens,
  },
};
</script>
