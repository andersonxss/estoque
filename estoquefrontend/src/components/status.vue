<template>
  <span v-if="this.status.id==1" class="badge badge-info">{{this.status.nome}}</span>
  <span v-else-if="this.status.id==2" class="badge badge-danger">{{this.status.nome}}</span>
  <span v-else-if="this.status.id==3" class="badge badge-success">{{this.status.nome}}</span>
  <span v-else-if="this.status.id==4" class="badge badge-danger">{{this.status.nome}}</span>
  <span v-else-if="this.status.id==5" class="badge badge-warning">{{this.status.nome}}</span>
  <span v-else-if="this.status.id==6" class="badge badge-primary">{{this.status.nome}}</span>
</template>




<script>
export default {
  props: { status },

  data: function() {
    return {
      items: [
        { id: 1, class: "badge-info" },
        { id: 2, class: "badge-danger" },
        { id: 3, class: "badge-success" },
        { id: 4, class: "badge-danger" },
        { id: 5, class: "badge-warning" },
        { id: 6, class: "badge-primary" }
      ]
    };
  },
  created() {}
};
</script>