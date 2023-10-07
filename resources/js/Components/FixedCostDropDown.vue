<template>
  <div class="fixed-cost-drop">
    <button @click="toggle">固定値を挿入する</button>
    <select name="fixedCostSelect"
     v-model="costId"
     v-if="toggleFlag"
     @change="submit">
      <option value="">選択して下さい</option>
      <option :value="cost.id" 
      v-for="(cost,index) in costs" 
      :key="index"
      >
        {{ cost.cost_title }}
      </option>
    </select>

  </div>
</template>

<script setup>
import { ref, onMounted, defineProps } from 'vue';

const costs = ref(null);
const costId = ref("");
const props = defineProps({
    'budget_id': Number
})
const toggleFlag = ref(false);

const toggle = () => {
    toggleFlag.value = !toggleFlag.value;
}

const getCost = () => {
  axios.get('/api/get-costs')
  .then(res => {
    costs.value = res.data;
  })
  .catch(err => {
    console.log(err);  
  })
}

const submit = () => {
    if (confirm('固定費を追加しますか？')) {
        const data = {
        fiexedCostId: costId.value,
        budgetId : props.budget_id
        }
        axios.post('/api/post-fixed-cost-expenses',data)
        .then(res => {
            console.log(res);
            window.location.href = `/budget/${props.budget_id}/show`;
        })
        .catch(err => {
            console.log(err);
        }) 
    } else {
        costId.value = "";
    }
}

onMounted(() => {
    getCost();
})

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
</style>