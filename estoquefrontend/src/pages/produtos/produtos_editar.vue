<template>
  <div class="container">
    <div class="card">
      <div
        class="card-header d-flex align-items-center justify-content-between"
      >
        <span>
          <b>Produtos Editar</b>
        </span>
      </div>

      <div class="card-body">
        <form v-on:submit.prevent="submitForm">
          <div class="form-group">
            <label class="" for="exampleInputNome">Nome</label>
            <input
              type="text"
              class="form-control"
              id="exampleInputNome"
              v-model="form.pro_nome"
            />
            <span v-if="allerros.pro_nome" class="text-danger">{{
              allerros.pro_nome[0]
            }}</span>
          </div>
          <div class="form-group">
            <label class="" for="exampleInputQuantidade">Quantidade</label>
            <input
              type="text"
              class="form-control"
              id="exampleInputQuantidade"
              v-model="form.pro_quantidade"
            />
            <span v-if="allerros.pro_quantidade" class="text-danger">{{
              allerros.pro_quantidade[0]
            }}</span>
          </div>

          <div class="form-group">
            <label class="" for="exampleInputValor">Valor</label>
            <input
              type="text"
              class="form-control"
              id="exampleInputValor"
              v-model="form.pro_valor"
            />
            <span v-if="allerros.pro_valor" class="text-danger">{{
              allerros.pro_valor[0]
            }}</span>
          </div>

          <div class="form-group form-check">
            <input
              type="checkbox"
              @change="updateCkeck()"
              class="form-check-input"
              :disabled="this.disabled"
              id="exampleCheck1"
            />

            <label class="form-check-label " for="exampleCheck1"
              >Aplicar desconto?</label
            >
          </div>

          <div class="form-group" v-if="this.form.status === true">
            <div
              class="custom-control custom-radio custom-control-inline"
              v-for="(item, index) in descontos"
              :key="index"
            >
              <input
                type="radio"
                :id="index"
                name="customRadioInline"
                @click="valueCkeck(item.des_id)"
                class="custom-control-input"
              />
              <label class="custom-control-label " :for="index">
                <b>Regra 1</b>
                Valor maior igual a {{ item.des_regra_one }} -
                <b>Regra 2</b>
                Valor menor igual {{ item.des_regra_two }} -
                <b>Regra 3</b>
                Valor total acima de
                {{ formatPrice(item.des_valor) }}
              </label>
            </div>
          </div>

          <div
            class="card border-0 mb-3"
            v-if="this.statusDescontoAplicado === true"
          >
            <div class="card-header border-0 bg-transparent">
              <span>
                <b>Desconto aplicado</b>
              </span>
              <a
                href="javaScript:void(0)"
                @click="removeDescontoProduto()"
                class="btn btn-danger btn-sm float-right"
                >Excluir</a
              >
            </div>
            <div class="card-body border">
              <p>
                <b>Regra 1:</b>
                Valor maior igual a
                {{ this.des_regra_two }}
              </p>
              <p>
                <b>Regra 2:</b>
                Valor menor igual
                {{ this.des_regra_one }}
              </p>
              <p>
                <b>Regra 3:</b>
                Valor total acima de
                {{ formatPrice(this.des_valor) }}
              </p>
            </div>
          </div>
          <button type="submit" class="btn btn-secondary">Editar</button>

          <a
            v-if="this.pro_id_sta == 1"
            href="javaScript:void(0)"
            @click="desativarProduto()"
            class="btn btn-danger btn-sm float-right"
            >Desativar</a
          >

          <a
            v-if="this.pro_id_sta == 2"
            href="javaScript:void(0)"
            @click="desativarProduto()"
            class="btn btn-success btn-sm float-right"
            >Ativar</a
          >
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import api from "../../service/api";
import formatPrice from "../../utils/formatPrice";
export default {
  data() {
    return {
      descontos: [],
      allerros: [],
      formatPrice: formatPrice,
      statusDescontoAplicado: false,
      disabled: true,
      id: null,
      idDesconto: false,
      des_regra_one: null,
      des_regra_two: null,
      des_valor: null,
      pro_id_sta: null,
      form: {
        pro_nome: "",
        pro_quantidade: "",
        pro_valor: "",
        status: false,
        valueDesconto: false,
      },
    };
  },

  created() {
    this.id = this.$route.params.id;
    this.getDadosForm();
  },
  methods: {
    updateCkeck() {
      this.form.status = this.form.status ? false : true;
      if (this.form.status == false) {
        this.form.valueDesconto = false;
      }
    },
    valueCkeck(val) {
      this.form.valueDesconto = val;
    },
    getListDescontos() {
      api
        .get("/descontos")
        .then((response) => {
          this.descontos = response.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    getDadosForm() {
      api
        .get(`/produtos/${this.id}`)
        .then((response) => {
          this.form.pro_nome = response.data.pro_nome;
          this.form.pro_quantidade = response.data.pro_quantidade;
          this.form.pro_valor = response.data.pro_valor;
          this.pro_id_sta = response.data.pro_id_sta;

          //Se esse produto estiver relacionado com algum descontodo deve-se exibir o desconto
          if (response.data.des_pro_id != null) {
            this.des_regra_one = response.data.des_regra_one;
            this.des_regra_two = response.data.des_regra_two;
            this.des_valor = response.data.des_valor;
            this.statusDescontoAplicado = true;
            this.idDesconto = response.data.pro_des_id;
          } else {
            this.getListDescontos();
            this.disabled = false;
            this.statusDescontoAplicado = false;
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
    submitForm() {
      api
        .put(`/produtos/${this.id}`, this.form)
        .then(() => {
          this.$vToastify.success("Ação realizado com sucesso!");
          this.$router.push("/produtos");
        })
        .catch(() => {
          this.$vToastify.error("Ação não realiado");
        });
    },
    removeDescontoProduto() {
      api
        .delete(`/produto_desconto/${this.idDesconto}`)
        .then((response) => {
          if (response) {
            this.$vToastify.success("Ação realizado com sucesso!");
            this.statusDescontoAplicado = false;
            this.disabled = false;
            this.getListDescontos();
          }
        })
        .catch(() => {
          this.$vToastify.error("Ação não realiado");
        });
    },
    desativarProduto() {
      api
        .put(`/produtos/desativar/${this.id}`)
        .then((response) => {
          console.log(response);
          this.$vToastify.success("Ação realizado com sucesso!");
          this.$router.push("/produtos");
        })
        .catch((error) => {
          this.allerros = error.response.data.errors;
          this.$vToastify.error("Ação não realiado");
        });
    },
  },
};
</script>
