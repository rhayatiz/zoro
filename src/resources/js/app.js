require('./bootstrap');
window.Vue = require('vue');

import VueRouter from 'vue-router';
import routes from './routes';
import App from './App.vue';

Vue.use(VueRouter);
Vue.component('spinner', require('vue-simple-spinner'));

const router = new VueRouter({
    mode: 'hash',
    routes
});

new Vue({
    router,
    render : h => h(App)
}).$mount('#app');