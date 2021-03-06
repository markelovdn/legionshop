/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
// Vue.component('home-component', require('./components/HomeComponent.vue').default);
// Vue.component('category-component', require('./components/CategoryComponent.vue').default);
// Vue.component('basket-component', require('./components/BasketComponent.vue').default);
Vue.component('navbar-component', require('./components/NavBarComponent.vue').default);
Vue.component('password-component', require('./components/PasswordComponent.vue').default);
Vue.component('address-component', require('./components/AddressComponent.vue').default);
Vue.component('main-info-profile-component', require('./components/MainInfoProfileComponent.vue').default);
// Vue.component('admin-users-component', require('./components/Admin/UsersComponent.vue').default);
// Vue.component('login-component', require('./components/Auth/LoginComponent.vue').default);
// Vue.component('register-component', require('./components/Auth/RegisterComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import store from './store/store.js'
import router from './router/router.js'

const app = new Vue({
    el: '#app',
    store,
    router
});
