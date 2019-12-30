import Vue from 'vue'
import Vuex from 'vuex'
import auth from '../app/auth/vuex'
import account from '../app/account/vuex'

Vue.use(Vuex)

export default new Vuex.Store({
	modules: {
		auth: auth,
		account: account
	}
})