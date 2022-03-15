import getters from "./getters";

export default {
  SET_PEDIDOS(state, pedidos) {
    state.items = pedidos;
  },
  SET_PEDIDOS_PRODUTOS(state, pedidos_produtos) {
    state.items = pedidos_produtos;
  },
  GET_PEDIDOS_PRODUTOS(state, dados) {
    //DESATIVAR TODOS OS PRODUTOS DO COMPONENTE DE SELECIONAR PRODUTO
    getters.UPDATE_STATE_PEDIDO_PRODUTO_ALL(dados.pedido_produtos);

    dados.pedido_produtos.map((elem, i) => {
      dados.pedido_produtos[i].pedido_valor_pro = elem.pep_valor_pro;
    });

    state.pedido_produtos = dados.pedido_produtos;
    state.value_produto_total = dados.pedido.ped_valor_sem_desconto;
    state.status_pedido = dados.pedido.ped_id_sta;
    state.status_produto_desconto =
      dados.pedido.ped_valor_com_desconto > 0 ? true : false;

    state.value_produto_desconto = dados.pedido.ped_valor_com_desconto;
  },
  GET_UPDATE_PEDIDOS_STATUS(state, dados) {
    state.status_pedido = dados;
  },
  SET_ADD_PEDIDOS_PRODUTOS(state, pedidos_produtos) {
    state.pedido_produtos.push(pedidos_produtos);
    //DESATIVAR O PRODUTO DO COMPONENTE DE SELECIONAR PRODUTO
    getters.UPDATE_STATE_PEDIDO_PRODUTO_UNIQUE(pedidos_produtos);
  },
  SET_REMOVER_PEDIDOS_PRODUTOS(state, produto) {
    const remove = state.pedido_produtos.filter(
      (elem) => elem.pro_id !== produto.pro_id
    );
    state.pedido_produtos = remove;
    //ATIVAR O PRODUTO DO COMPONENTE DE SELECIONAR PRODUTO
    getters.UPDATE_STATE_PEDIDO_PRODUTO_UNIQUE(produto, 1);
  },
  GET_SUB_TOTAL(state, item) {
    const retornoDesconto = getters.GET_DESCONTO_PRODUTO(state, item);
    item.pep_valor_pro = retornoDesconto.stateDesconto
      ? retornoDesconto.valorProduto
      : retornoDesconto.valorProduto;
    item.pep_valor_pro_desconto = retornoDesconto.valorDesconto;
  },
  GET_VALUE_TOTAL(state) {
    let total = state.pedido_produtos.reduce((total, valor) => {
      const setvalor = isNaN(valor.pep_valor_pro) ? 0 : valor.pep_valor_pro;

      return total + setvalor;
    }, 0);
    state.value_produto_total = total;
  },
  GET_VALUE_DESCONTO(state) {
    let total = state.pedido_produtos.reduce((total, valor) => {
      const setvalor = isNaN(valor.pep_valor_pro_desconto)
        ? 0
        : valor.pep_valor_pro_desconto;

      return total + setvalor;
    }, 0);

    state.value_produto_desconto = total;
  },
  SET_REMOVE_PEDIDOS_PRODUTOS(state) {
    state.pedido_produtos = [];
  },

  GET_DADOS() {
    // const dados = {
    //   pedido: {
    //     pep_id: response.data.pedidosproduto.id,
    //     pep_valor_pro: response.data.pedidosproduto.pep_valor_pro,
    //     pep_id_pro: response.data.pedidosproduto.pep_id_pro,
    //     pep_id_ped: response.data.pedidosproduto.pep_id_ped,
    //   },
    //   desconto: {
    //     des_id: response.data.produtos.des_id,
    //     des_porcentagem: response.data.produtos.des_porcentagem,
    //     des_pro_id: response.data.produtos.des_pro_id,
    //     des_regra_one: response.data.produtos.des_regra_one,
    //     des_regra_two: response.data.produtos.des_regra_two,
    //     des_valor: response.data.produtos.des_valor,
    //   },
    //   produto: {
    //     pro_id: param.pro_id,
    //     pro_nome: param.pro_nome,
    //     pro_id_sta: param.pro_id_sta,
    //     pro_valor: response.data.produtos.pro_valor,
    //     pro_quantidade: response.data.produtos.pro_quantidade,
    //   },
    // };
  },
};
