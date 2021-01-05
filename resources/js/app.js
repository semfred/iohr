require('./bootstrap');


import Vue from 'vue'
import axios from 'axios'
import VueAxios from 'vue-axios'
import VueCookies from 'vue-cookies'
import BootstrapVue from 'bootstrap-vue'
import VueSessionStorage from 'vue-sessionstorage'
import InfiniteLoading from 'vue-infinite-loading';


import { router } from './_helpers/router'
import { store } from './_helpers/global'

Vue.use(VueAxios, axios)
Vue.use(VueCookies)
Vue.use(BootstrapVue)
Vue.use(VueSessionStorage)
Vue.use(InfiniteLoading, {
    props: {
        spinner: 'waveDots',

    },

    system: {
        throttleLimit: 50,
    }
})


import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'


import App from './views/App';


// Auth Bearer
const token = $cookies.get('token');
if (token) {
	Vue.prototype.$http.defaults.headers.common['Authorization'] = 'Bearer ' + token
}

// MAIN APP
const app = new Vue({
    el: '#app',
    beforeCreate: function() {
    	console.log('app loaded');
    },
    components: { App },
    router,
    axios,
    store,
});
