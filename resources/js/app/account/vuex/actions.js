import axios from  'axios'

export const updateUserProfile = ({ commit, dispatch }, { payload, context }) => {

	return axios.post('/api/account/profile', payload).then((response) => {
		commit('auth/setUserData', response.data.data, {root: true})
		dispatch('flashMessage', response.data.meta.success, {root: true})
	}).catch((error) => {
		context.errors = error.response.data.errors
	})
}

export const updateUserPassword = ({ commit, dispatch }, { payload, context }) => {

	return axios.post('/api/account/password', payload).then((response) => {
		dispatch('flashMessage', response.data.meta.success, {root: true})
	}).catch((error) => {
		context.errors = error.response.data.errors
	})
}