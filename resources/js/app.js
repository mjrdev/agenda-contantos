import { createApp } from 'vue'
import './bootstrap';
import Index from './pages/index.vue'
 
const app = createApp()

app.component('App', Index)

app.mount('#app')