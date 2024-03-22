import { createApp } from 'vue'
import './bootstrap';
import Index from './pages/index.vue'
import VueMask from '@devindex/vue-mask';
 
const app = createApp()

app.component('App', Index)

app.use(VueMask)

app.mount('#app')