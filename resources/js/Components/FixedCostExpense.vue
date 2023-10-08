<template>
  <div>
    <div class="expenses-form">
      <div class="form-group">
        <label for="content">用途</label>
        <input class="form-control" name="content[]" type="text">
      </div>

      <div class="form-group">
        <label for="expense">出費</label>
        <input class="form-control" name="expense[]" type="text">
      </div>
    </div>
    <hr>
    <div class="expenses-form" v-for="(input,index) in inputs" :key="index">
      <div class="form-group">
        <label for="content">用途</label>
        <input class="form-control" name="content[]" type="text">
      </div>

      <div class="form-group">
        <label for="expense">出費</label>
        <input class="form-control" name="expense[]" type="text">
      </div>
      <hr>
    </div>
    <p class="expense-add" @click.prevent="addInput">+</p>
  </div>
</template>

<script>
export default{
  data() {
    return {
      inputs: []
    }
  },

  methods: {
    addInput() {
      this.inputs.push({});
    }
  }
}

</script>

<style scoped>
.expenses-form {
  margin-bottom: 1rem;
}

.expense-add {
  font-size: 1.5rem;
  text-align: right;
}
</style>