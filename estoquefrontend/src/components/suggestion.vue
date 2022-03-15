<template>
  <div>
    <b>{{ item.pro_id }}</b> -
    <span>{{ item.pro_nome }}</span>
  </div>
</template>

<script>
export default {
  props: {
    item: { required: true }
  }
};
</script>


<style scope>
.vs__selected .vs__input {
  width: 100%;
  display: block;
  margin: 0 auto;
  padding: 0.5rem 0.7rem;
  font-size: 0.9rem;
  line-height: 1.25;
  color: #464a4c;
  outline: none;
  background-color: #fff;
  background-image: none;
  background-clip: padding-box;
  border: 1px solid #cecece;
  border-radius: 0.25rem;
  transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

.vue-suggestion .vs__list {
  width: 100%;
  text-align: left;
  border: none;
  border-top: none;
  max-height: 400px;
  overflow-y: auto;
  border-bottom: 1px solid #023d7b;
  position: relative;
  z-index: 1000;
}
.vue-suggestion .vs__list .vs__list-item {
  background-color: #fff;
  padding: 10px;
  border-left: 1px solid #023d7b;
  border-right: 1px solid #023d7b;
}
.vue-suggestion .vs__list .vs__list-item:last-child {
  border-bottom: none;
}
.vue-suggestion .vs__list .vs__list-item:hover {
  background-color: #eee !important;
}
.vue-suggestion .vs__list,
.vue-suggestion .vs__loading {
  position: absolute;
}
.vue-suggestion .vs__list .vs__list-item {
  cursor: pointer;
}
.vue-suggestion .vs__list .vs__list-item.vs__item-active {
  background-color: #f3f6fa;
}
</style>
