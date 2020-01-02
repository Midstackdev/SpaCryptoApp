import Vue from 'vue'

export const Login = Vue.component('login', require('./Login.vue').default);
export const Register = Vue.component('register', require('./Register.vue').default);
export const VerifyEmail = Vue.component('verify-email', require('./VerifyEmail.vue').default);