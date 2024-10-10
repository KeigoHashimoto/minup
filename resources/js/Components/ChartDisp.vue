<template>
  <canvas id="chart1">
  </canvas>
</template>

<script setup>
import { defineProps, ref, onMounted } from 'vue';
import Chart from 'chart.js/auto';

const contentsAry = ref([]);
const dataAry = ref([]);

const props = defineProps({
    expenses: {
        type: Object,
        required: true
    }
})

const getTitle = () => {
    if (props.expenses.length <= 0) {
        return '';
    }
    return props.expenses[0].title;
}

const getContents = () => {
    for (let i = 0; i < props.expenses.length; i++) {
        contentsAry.value.push(props.expenses[i].content);
        dataAry.value.push(props.expenses[i].expense);
    }
}

onMounted(() => {
    getContents();
    const ctx1 = document.getElementById('chart1').getContext('2d');
    const myChart1 = new Chart(ctx1, {
        type: 'bar',
        data: {
            labels: contentsAry.value,
            datasets: [{
                label: getTitle(),
                data: dataAry.value,
                backgroundColor: 'rgba(75, 192, 192, 0.6)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
})


</script>

<style>

</style>