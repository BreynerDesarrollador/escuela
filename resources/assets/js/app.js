/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import VueRouter from 'vue-router'
import RingLoader from 'vue-spinner/src/RingLoader.vue'
import VTooltip from 'v-tooltip'
import VueTimeago from 'vue-timeago'
import VueProgressBar from 'vue-progressbar'
import Breabcrumbs from 'vue-2-breadcrumbs';
import datepicker from 'vue-bootstrap-datetimepicker'
import mixin from '../js/router/mixin'
import {ServerTable, ClientTable, Event} from 'vue-tables-2';
import InfiniteLoading from 'vue-infinite-loading';
import {state, mutations} from './router/mutacion';
import Vuex from 'vuex'


import App from './components/App.vue'
//router configuracion
import routerimport from "./router/router";

require('./bootstrap');
require('toastr');

window.Vue = require('vue');


const options = {
    color: '#1976d2',
    failedColor: '#e53935',
    thickness: '3px',
    transition: {
        speed: '0.2s',
        opacity: '0.6s',
        termination: 300
    },
    autoRevert: true,
    location: 'top',
    inverse: false
};
// Using font-awesome 5 icons
$.extend(true, $.fn.datetimepicker.defaults, {
    icons: {
        time: 'icon ion-ios-time',
        date: 'icon ion-ios-calendar',
        up: 'icon ion-ios-arrow-up',
        down: 'icon ion-ios-arrow-down',
        previous: 'icon ion-ios-arrow-back',
        next: 'icon ion-ios-arrow-forward',
        today: 'icon ion-ios-today',
        clear: 'icon ion-ios-close-circle-outline',
        close: 'icon ion-ios-close'
    }
});

Vue.use(VueProgressBar, options);
Vue.use(VueRouter);
Vue.use(VTooltip);
Vue.use(Breabcrumbs);
Vue.use(Vuex);
Vue.use(VueTimeago, {
    name: 'Timeago', // Component name, `Timeago` by default
    locale: undefined, // Default locale
    locales: {
        'es-ES': require('date-fns/locale/es'),
        'es': require('date-fns/locale/es'),
    }
});
const defaultTableOpt = {
    skin: 'table',
    perPageValues: [10, 25, 50, 100, 250, 500, 1000],
    pagination: {
        edge: true,
    },
    texts: {
        first: '<<',
        last: '>>',
    },
    sortIcon: {
        base: 'fa',
        up: 'fa-sort-asc',
        down: 'fa-sort-desc',
        is: 'fa-sort',
    },
};
Vue.use(ServerTable, defaultTableOpt, false, 'bootstrap4');
Vue.use(ClientTable, defaultTableOpt, false, 'bootstrap4');
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
var router = new VueRouter({
    //mode:'history',
    mode: 'hash', // https://router.vuejs.org/api/#mode
    linkActiveClass: 'active',
    scrollBehavior: () => ({y: 0}),
    routes: routerimport
});


Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('app', App);
Vue.component('ring-loader', RingLoader);
Vue.component('navbar', require('./components/partials/_navbar'));
Vue.component('footer-app', require('./components/partials/_footer'));
Vue.component('sidebar', require('./components/partials/_sidebar'));
Vue.component('error', require('./components/views/error/error'));
Vue.component("select2", require('./components/component/select2'));
Vue.component("datePicker", datepicker);
Vue.component("InfiniteLoading", InfiniteLoading);

Vue.mixin(mixin);

const store = new Vuex.Store({
    state,
    mutations
});
window.store = store;

new Vue({
    router,
    store,
}).$mount('#app');
