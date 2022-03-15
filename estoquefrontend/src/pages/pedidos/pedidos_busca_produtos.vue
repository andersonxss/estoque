<template>
  <b-card>
    <h6>Buscar Produto</h6>
    <vue-suggestion
      class
      :items="dados"
      v-model="item"
      :setLabel="setLabel"
      :itemTemplate="itemTemplate"
      @changed="inputChange"
      @selected="itemSelected"
    ></vue-suggestion>
  </b-card>
</template>

<script>
import { mapActions, mapState } from "vuex";
import itemTemplate from "../../components/suggestion";

export default {
  data() {
    return {
      id: null,
      itemTemplate,
      item: {},
      dados: [],
    };
  },
  created() {
    this.id = this.$route.params.id;
  },
  computed: {
    ...mapState({
      produtos: (state) => state.produtos.items,
      session: (state) => state.auth.me,
    }),
  },
  mounted() {
    this.getProdutos().catch(() => {
      this.$vToastify.error("Falha ao carregar os pedidos");
    });
  },
  methods: {
    ...mapActions(["getProdutos", "setPedidoProdutos"]),
    itemSelected(itemSelecionado) {
      itemSelecionado.ped_id = parseInt(this.id);
      itemSelecionado.use_id = parseInt(this.session.use_id_per);

      this.setPedidoProdutos(itemSelecionado);
    },
    setLabel(item) {
      console.log(item);
    },
    inputChange(text) {
      //Selecionar o item da lista
      const getProdutos = this.produtos.filter((elem) => elem.sta_id === 1);

      const itemSelecionado = getProdutos.filter((item) =>
        item.pro_nome.toLowerCase().includes(text.toLowerCase())
      );

      this.dados = itemSelecionado;
    },
  },
};
</script>
