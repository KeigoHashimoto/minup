<template>
  <div class="fixed-cost-drop">
    <select name="fixedCostSelect"
     v-model="costId"
     @change="submit">
      <option value="">固定費を選択して下さい</option>
      <option :value="cost.id" 
      v-for="(cost,index) in costs" 
      :key="index"
      >
        {{ cost.cost_title }}
      </option>
    </select>
    <small class="small"><a href="/fixed-cost/create-form">固定費はこちらから登録できます。</a></small>
  </div>
</template>

<script>
import { ref } from 'vue';
export default{
  data() {
    return {
      costs: ref(null),
      costId: ref(""),
      toggleFlag: ref(false)
    }
  },

  props: {
    budget_id: {
      type: Number
    }
  },

  methods: {
    getCost(){
      axios.get('/api/get-costs')
      .then(res => {
        this.costs = res.data;
      })
      .catch(err => {
        console.log(err);  
      })
    },

    submit(){
      if (confirm('固定費を追加しますか？')) {
          const data = {
          fiexedCostId: this.costId,
          budgetId : this.budget_id
          }
          axios.post('/api/post-fixed-cost-expenses',data)
          .then(res => {
              window.location.href = `/budget/${this.budget_id}/show`;
          })
          .catch(err => {
              console.log(err);
          }) 
      } else {
          this.costId = "";
      }
    }
  },

  mounted() {
    this.getCost()
  }
}



</script>

<style scoped>
 select {
    height: fit-content;
    width: fit-content;
    padding:2px;
    font-size: 1.2rem;
    margin: 5px auto;
 }

 button {
    background: #acff9f;
    border: none;
    border-radius: 5px;
    width: fit-content;
    padding:10px;
    margin: 5px auto;
    cursor: pointer;
 }

 .fixed-cost-drop {
    display: flex;
    flex-direction: column;
 }

 .small {
   letter-spacing: 1;
   text-decoration: underline;
 }
</style>