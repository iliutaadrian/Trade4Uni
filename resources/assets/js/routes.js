import Home from './components/page/Home.vue';

import Login from './components/auth/Login.vue';
import Register from './components/auth/Register.vue';
import ForgotPassword from './components/auth/ForgotPassword.vue';
import ChangePassword from './components/auth/ChangePassword.vue';
import ChangeUserPassword from './components/user/ChangeUserPassword.vue';

import UserProfile from './components/user/UserProfile.vue';

import CustomersMain from './components/customers/Main.vue';
import CustomersList from './components/customers/List.vue';
import NewCustomer from './components/customers/New.vue';
import Customer from './components/customers/View.vue';

import ContactUs from './components/page/ContactUs.vue';
import NotFound from './components/page/NotFound.vue';

export const routes = [
    {
        path: '/',
        component: Home
    },
    {
        path: '/login',
        component: Login
    },
    {
        path: '/register',
        component: Register
    },
    {
        path: '/forgot-password',
        component: ForgotPassword
    },
    {
        path: '/change-password',
        component: ChangePassword
    },
    {
        path: '/contact-us',
        component: ContactUs
    },
    {
        path: '/user-profile',
        component: UserProfile,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/user-change-password',
        component: ChangeUserPassword,
        meta:{
            requiresAuth: true
        }
    },
    {
        path: '/customers',
        component: CustomersMain,
        meta: {
            requiresAuth: true
        },
        children: [
            {
                path: '/',
                component: CustomersList
            },
            {
                path: 'new',
                component: NewCustomer
            },
            {
                path: ':id',
                component: Customer
            }
        ]
    },
    {
        path: '*',
        component: NotFound
    }
];