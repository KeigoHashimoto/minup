require('./bootstrap');

import { createApp } from 'vue';
import BudgetControlButtons from './Components/BudgetControlButtons.vue';
import FixedCostExpense from './Components/FixedCostExpense.vue';
import ChartDisp from './Components/ChartDisp.vue';

createApp({
    components: {
        FixedCostExpense,
    }
}).mount('#fixed-cost-expenses');

createApp({
    components: {
        BudgetControlButtons
    }
}).mount('#budget-control-btns');

createApp({
    components: {
        ChartDisp
    }
}).mount('#chart');

