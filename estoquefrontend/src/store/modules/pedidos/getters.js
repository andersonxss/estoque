import stateProduto from "../produtos/state";
const getters = {
  GET_DESCONTO_PRODUTO(state, dados) {
    if (dados.des_regra_one) {
      const regra_one = dados.des_regra_one;
      const regra_two = dados.des_regra_two;
      const regra_valor = dados.des_valor;
      const quantidade = dados.pep_quantidade;
      const valor = dados.pro_valor;
      const newValor = valor * quantidade;
      const regra_porcentagem = dados.des_porcentagem / 100;

      //Se o valor entrar na regra deve-se gerar desconto no produto
      if (
        regra_one >= quantidade &&
        regra_two <= quantidade &&
        newValor > regra_valor
      ) {
        const decontoPreco = newValor - regra_porcentagem * newValor;

        return {
          valorProduto: decontoPreco,
          valorDesconto: newValor - decontoPreco,
          stateDesconto: true,
        };
      } else {
        return {
          valorProduto: newValor,
          valorDesconto: 0,
          stateDesconto: false,
        };
      }
    }
  },
  UPDATE_STATE_PEDIDO_PRODUTO_ALL(dados) {
    dados.map((produtos) => {
      stateProduto.items.find(
        (elem) => elem.pro_id === produtos.pro_id
      ).sta_id = 2;
    });
  },
  UPDATE_STATE_PEDIDO_PRODUTO_UNIQUE(item, status = 2) {
    stateProduto.items.find(
      (elem) => elem.pro_id === item.pro_id
    ).sta_id = status;
  },
};
export default getters;
