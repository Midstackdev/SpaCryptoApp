import axios from  'axios'

export const updateUserProfile = ({ commit }, { payload, context }) => {

	return axios.post('/api/account/profile', payload).then((response) => {
		commit('auth/setUserData', response.data.data, {root: true})
	}).catch((error) => {
		context.errors = error.response.data.errors
	})
}