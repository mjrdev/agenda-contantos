import { createApp } from 'vue'
import './bootstrap';
import Counter from './pages/index.vue'
 
const app = createApp()

app.component('App', Counter)

app.mount('#app')