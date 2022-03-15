import api from "../../../service/api";
const actions = {
  getPedidos({ commit }) {
    commit("SET_PRELOADER", true);

    return api
      .get("/pedidos")
      .then((response) => {
        commit("SET_PEDIDOS", response.data);
      })
      .finally(() => {
        commit("SET_PRELOADER", false);
      });
  },
  getPedidosProdutos({ commit }, param) {
    commit("SET_PRELOADER", true);
    commit("SET_REMOVE_PEDIDOS_PRODUTOS");
    return api
      .get(`/pedidos_produtos/${param}`)
      .then((response) => {
        commit("GET_PEDIDOS_PRODUTOS", response.data);
        //UPDATE DO STATUS DO PEDIDO
        commit("GET_UPDATE_PEDIDOS_STATUS", response.data.pedido.ped_id_sta);
      })
      .finally(() => {
        commit("SET_PRELOADER", false);
      });
  },
  setNovoPedido({ commit }, param) {
    commit("SET_PRELOADER", true);

    return api.post("/pedidos", param).finally(() => {
      commit("SET_PRELOADER", false);
    });
  },
  setPedidoProdutos({ commit }, param) {
    commit("SET_PRELOADER", true);

    return api
      .post(`/pedidos_produtos`, {
        pep_quantidade: 0,
        pep_valor_pro: 0,
        pep_id_pro: parseInt(param.pro_id),
        pep_id_ped: param.ped_id,
        pep_id_use: param.use_id,
      })
      .then((response) => {
        const dados = {
          pep_id: response.data.pedidosproduto.id,
          pedido_valor_pro: response.data.pedidosproduto.pep_valor_pro,
          pep_valor_pro: response.data.pedidosproduto.pep_valor_pro,
          pep_id_pro: response.data.pedidosproduto.pep_id_pro,
          pep_id_ped: response.data.pedidosproduto.pep_id_ped,
          pro_id: param.pro_id,
          pro_nome: param.pro_nome,
          pro_id_sta: param.pro_id_sta,
          pro_des_id: response.data.produtos.pro_des_id,
          pro_valor: response.data.produtos.pro_valor,
          pro_quantidade: response.data.produtos.pro_quantidade,
          des_id: response.data.produtos.des_id,
          des_porcentagem: response.data.produtos.des_porcentagem,
          des_pro_id: response.data.produtos.des_pro_id,
          des_regra_one: response.data.produtos.des_regra_one,
          des_regra_two: response.data.produtos.des_regra_two,
          des_valor: response.data.produtos.des_valor,
          sta_id: param.sta_id,
          sta_nome: param.sta_nome,
          use_id: param.use_id,
        };

        commit("SET_ADD_PEDIDOS_PRODUTOS", dados);
        //Recalcular o valor total
        commit("GET_VALUE_TOTAL");
      })
      .finally(() => {
        commit("SET_PRELOADER", false);
      });
  },
  setRemovePedidoProduto({ commit }, param) {
    commit("SET_PRELOADER", true);

    return api
      .delete(`/pedidos_produtos/${param.pep_id}`)
      .then(() => {
        //Se esse item removido tiver desconto

        // //O desconto será removido
        commit("SET_REMOVER_PEDIDOS_PRODUTOS", param);

        // //Recalcular o valor total
        commit("GET_VALUE_TOTAL");

        // //Recalcular o valor do desconto
        commit("GET_VALUE_DESCONTO");
      })
      .finally(() => {
        commit("SET_PRELOADER", false);
      });
  },
  SetFecharPedido({ commit }, param) {
    console.log(JSON.stringify(param, null, 2));

    commit("SET_PRELOADER", true);
    return api
      .put(`/pedidos_produtos/baixa/${param.id}`, {
        produtos: param.produtos,
      })
      .finally(() => {
        commit("SET_PRELOADER", false);
      });
  },
  SetEncerrarPedido({ commit }, param) {
    commit("SET_PRELOADER", true);
    return api.put(`/pedidos/encerrar/${param}`).finally(() => {
      commit("SET_PRELOADER", false);
    });
  },
};

export default actions;
