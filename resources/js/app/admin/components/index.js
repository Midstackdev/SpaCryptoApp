import Vue from 'vue'

export const Admin = Vue.component('admin', require('./Admin.vue').default)
export const Transactions = Vue.component('transactions', require('./Transactions.vue').default)
export const ViewWallet = Vue.component('view-wallet', require('./ViewWallet.vue').default)