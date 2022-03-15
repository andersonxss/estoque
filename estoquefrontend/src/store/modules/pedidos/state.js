const state = {
  items: {
    data: [],
  },
  pedido_produtos: {
    data: [],
  },
  sub_total: null,
  status_produto_desconto: false,
  status_pedido: null,
  value_produto_desconto: 0,
  value_produto_total: 0,
  statuPedido: {
    ativo: 1,
    inativo: 2,
    finalizado: 3,
    cancelado: 4,
    análise: 5,
    pendente: 6,
  },
};
export default state;
