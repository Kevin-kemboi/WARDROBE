import './assets/main.css';
import axios from 'axios';
import { createApp } from 'vue';
import { createPinia } from 'pinia';

import App from './App.vue';
import router from './router';

// Axios configuration
axios.defaults.baseURL = 'http://127.0.0.1:8001/';

// Create and configure the app
const app = createApp(App);

// Add a global property for image assets (assuming they're in /src/assets/)
app.config.globalProperties.$imagePath = '/src/assets/';

// Use Pinia and Router
app.use(createPinia());
app.use(router);

// Mount the app
app.mount('#app');