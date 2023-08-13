require('./bootstrap');

import { createApp } from 'vue';
import Share from './Components/ShareComponent.vue';

createApp({
    components:{
        Share
    }
}).mount('#share');