

require('./bootstrap');

window.Vue = require('vue');



Vue.component('table-component', require('./components/TableComponent.vue').default);
Vue.component('guest-table-component', require('./components/GuestTableComponent.vue').default);
Vue.component('download-btn-component', require('./components/DownloadBtnComponent.vue').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
