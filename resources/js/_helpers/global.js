import Vue from 'vue';
import Vuex from 'vuex'
import axios from 'axios'
import VueAxios from 'vue-axios'
import VueCookies from 'vue-cookies'

Vue.use(Vuex)
Vue.use(VueAxios, axios)
Vue.use(VueCookies)

export const store = new Vuex.Store({

	strict: false,

	state: {

		loading: false,
		currentEmployee: {},
		employees: [],

	},

	getters: {
		loggedEmployee(state) {
			return state.currentEmployee.employee;
		}
	},

	mutations: {
		SET_CURR_EMPLOYEE(state, employee) {
			state.currentEmployee = employee;
			localStorage.setItem('employee', JSON.stringify(employee));
		}
	},

	actions: {
		getCurrentEmployeeAsync({commit}, id) {
			try {
				axios
					.get('/api/employees/' + id)
					.then( res => {
						commit('SET_CURR_EMPLOYEE', res.data);
					})
					.catch( error => {

					});
			} catch (e) {
				console.log(e);
			}	
		}
	},

});