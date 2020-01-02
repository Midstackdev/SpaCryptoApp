import Vue from 'vue'

export const AccountIndex = Vue.component('account-index', require('./AccountIndex.vue').default)
export const AccountOverview = Vue.component('account', require('./AccountOverview.vue').default)
export const AccountProfile = Vue.component('account-profile', require('./AccountProfile.vue').default)
export const ChanagePassword = Vue.component('account-password', require('./ChanagePassword.vue').default)
export const AccountDeactivate = Vue.component('account-deactivate', require('./AccountDeactivate.vue').default)
export const TwoFactor = Vue.component('two-factor', require('./TwoFactor.vue').default)