require('./bootstrap');

import { createApp } from 'vue';
import Share from './Components/ShareComponent.vue';
import FixedCostExpense from './Components/FixedCostExpense.vue';
import FixedCostDropDown from './Components/FixedCostDropDown.vue';

createApp({
    components: {
        Share
    }
}).mount('#share');

createApp({
    components: {
        FixedCostExpense
    }
}).mount('#fixed-cost-expenses');

createApp({
    components: {
        FixedCostDropDown
    }
}).mount('#fixed-cost')