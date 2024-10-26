// import { registerVueControllerComponents } from '@symfony/ux-vue';
// import './bootstrap.js';
/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
// import './styles/app.css';

// registerVueControllerComponents(require.context('./vue/controllers', true, /\.vue$/));

import { createApp } from 'vue'
import { createPinia } from 'pinia'
import ToastPlugin from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-bootstrap.css';
import App from './App.vue'
import router from './router'
import 'bootstrap/dist/css/bootstrap.min.css'
import 'bootstrap/dist/js/bootstrap.bundle.min.js'
import 'bootstrap-icons/font/bootstrap-icons.css'
import i18n from './i18n';

const app = createApp(App)

app.use(ToastPlugin);
app.use(createPinia())
app.use(router)
app.use(i18n);



app.mount('#app')