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
    <div class="expenses-form" v-for="(input,index) in inputs" :key="index">
      <div class="form-group">
        <label for="content">用途</label>
        <input class="form-control" name="content[]" type="text">
      </div>

      <div class="form-group">
        <label for="expense">出費</label>
        <input class="form-control" name="expense[]" type="text">
      </div>
    </div>
    <button @click.prevent="addInput">追加</button>
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
  display: flex;  
}

</style>