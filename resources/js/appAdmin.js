/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */


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
Vue.component('menubuilder', require('./components/MenuBuilder.vue').default);
// Vue.component('orderwindow', require('./components/Orderwindow.vue').default);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.use(require('vue-moment'));
Vue.use(Vuex);

const store = new Vuex.Store({
    state: {
        menu: [],
    },
    getters: {
        getMenu(state) {
            return state.menu
        },
    },
    mutations: {
        addCategoryToMenu (state, cat) {
            let menu = this.state.menu
            let category = {
                id: cat.id,
                name: cat.text,
                products: [],
            }
            menu.push(category)
            Vue.set(state,'menu', menu)
        },
        addProductToCategory (state, data) {
            let cat = data.cat
            let product = data.product
            let menu = this.state.menu
            menu[cat].products.push(product)
            // let category = {
            //     id: cat.id,
            //     name: cat.text,
            //     products: [],
            // }
            // menu.push(category)
            Vue.set(state,'menu', menu)
        },
    }
})



const app = new Vue({
    el: '.app',
    store: store,
});
