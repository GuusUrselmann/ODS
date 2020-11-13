/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import { InertiaApp } from '@inertiajs/inertia-vue';
window.Vue = require('vue');
import Vuex from 'vuex';

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
// Vue.component('productsmenu', require('./components/ProductsMenu.vue').default);
// Vue.component('orderlist', require('./components/OrderList.vue').default);
// Vue.component('headercart', require('./components/HeaderCart.vue').default);
// Vue.component('orderwindow', require('./components/Orderwindow.vue').default);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.use(require('vue-moment'));
Vue.use(InertiaApp);
Vue.use(Vuex);

const store = new Vuex.Store({
    state: {
        cart: {},
        conditions: {},
        amount: 0
    },
    getters: {
        getCart(state) {
            return state.cart
        },
        getConditions(state) {
            return state.conditions
        },
        getAmount(state) {
            return state.amount
        },
    },
    actions: {
        initCart(state) {
            axios.post(url()+'/api/getcart', {
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            })
            .then(response => {
                state.commit('updateCart', response.data.cart)
                state.commit('updateConditions', response.data.conditions)
                state.commit('updateAmount', response.data.amount)
            })
            .catch(error => {
                console.log(error);
           });
        }
    },
    mutations: {
        updateCart (state, data) {
            Vue.set(state,'cart', data)
        },
        updateConditions (state, data) {
            Vue.set(state,'conditions', data)
        },
        updateAmount (state, data) {
            Vue.set(state,'amount', data)
        },
    }
})

const app = document.getElementById('app')
new Vue({
  render: h => h(InertiaApp, {
    props: {
      initialPage: JSON.parse(app.dataset.page),
      resolveComponent: name => require(`./Pages/${name}`).default,
    },
  }),
  store: store,
}).$mount(app)
