import axios from  'axios'
import router from '../../../router'

export const isAdmin = ({ commit, dispatch }) => {

	return axios.get('/api/admin/impersonate').then((response) => {
		// console.log(response)
	}).catch((error) => {
		if (error.response.data.data.error === "Page does not exist.") {
			router.replace({ name: 'notfound'})
		}
	})
}

export const getUsers = ({ commit, dispatch }) => {

	return axios.get('/api/admin').then((response) => {
		// console.log(response.data.data)
		commit('setUsers', response.data.data)
		commit('setStats', response.data.meta.stats)
	}).catch((error) => {

	})
}

export const coinTransfers = ({ commit, dispatch }, { payload }) => {

	return axios.post('/api/admin/transfers', payload).then((response) => {
		console.log(response)
	}).catch((error) => {
		
	})
}