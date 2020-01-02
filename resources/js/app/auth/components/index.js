import Vue from 'vue'

export const Login = Vue.component('login', require('./Login.vue').default);
export const Register = Vue.component('register', require('./Register.vue').default);
export const VerifyEmail = Vue.component('verify-email', require('./VerifyEmail.vue').default);
export const ForgotPassword = Vue.component('forgot-password', require('./ForgotPassword.vue').default);
export const ResetPassword = Vue.component('password-reset', require('./ResetPassword.vue').default);