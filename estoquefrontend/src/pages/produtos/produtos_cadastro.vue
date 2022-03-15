<template>
  <div class="container">
    <div class="card">
      <div
        class="card-header d-flex align-items-center justify-content-between"
      >
        <span>
          <b>Produtos Cadastro</b>
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
              type="number"
              step="0.01"
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
          <button type="submit" class="btn btn-secondary">Cadastrar</button>
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
    this.getListDescontos();
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
    submitForm() {
      api
        .post("/produtos", this.form)
        .then(() => {
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
