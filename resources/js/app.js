require('./bootstrap');
window.Vue = require('vue');

import VueRouter from 'vue-router';
import routes from './routes';
import App from './App.vue';
import 'vue2-toast/lib/toast.css';
import Toast from 'vue2-toast';

Vue.use(VueRouter);
Vue.use(Toast);
Vue.component('spinner', require('vue-simple-spinner'));

const router = new VueRouter({
    mode: 'hash',
    routes
});

new Vue({
    router,
    render : h => h(App)
}).$mount('#app');