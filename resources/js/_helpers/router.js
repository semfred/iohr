import Vue from 'vue';
import VueRouter from 'vue-router';
import NProgress from 'nprogress'

import { globalVar } from './global'

Vue.use(VueRouter);

import Hello from '../views/Hello';
import Home from '../views/dashboard/Home';
import Login from '../views/Login';
import Employees from '../views/dashboard/admin/employee/index';
import CreateEmployees from '../views/dashboard/admin/employee/create';


// ROUTES
export const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/app',
            name: 'home',
            component: Home,
            meta: {
            	requiresAuth: true
            }
        },
        {
            path: '/app/hello',
            name: 'hello',
            component: Hello,
            meta: {
            	requiresAuth: true
            }
        },
        {
        	path: '/app/login',
        	name: 'login',
        	component: Login,
        },
        {
            path: '/app/admin/employees',
            name: 'admin.employees',
            component: Employees
        },
        {
            path: '/app/admin/employees/create',
            name: 'admin.employees.create',
            component: CreateEmployees
        },


        { path: '*', redirect: '/app' }
    ],
});

// PROGRESS BAR FOR EACH PAGE
router.beforeResolve((to, from, next) => {
  if (to.name) {
      NProgress.start();
  }
  next()
})

router.beforeEach((to, from, next) => {
	if (to.matched.some(record => record.meta.requiresAuth) && !$cookies.get('isLoggedIn')) {
		router.push('/app/login');
	} else {
		next()
	}
})

router.afterEach((to, from) => {
  NProgress.done()
  // console.log(router.currentRoute.name);
})
