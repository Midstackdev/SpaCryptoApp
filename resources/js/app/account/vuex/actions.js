import axios from  'axios'
import { setHttpToken } from '../../../helpers'

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

export const fetchCountries = ({ commit, dispatch }) => {

	return axios.get('/api/account/twofactor').then((response) => {
		commit('setCountries', response.data.data)
	}).catch((error) => {
		context.errors = error.response.data.errors
	})
}

export const deactivateAccount = ({ commit, dispatch }, { payload, context }) => {

	return axios.post('/api/account/deactivate', payload).then((response) => {
		// dispatch('auth/logout', {root: true})
		commit('auth/setAuthenticated', false, {root: true})
		commit('auth/setUserData', null, {root: true})
		commit('auth/setToken', null, {root: true})
		setHttpToken(null)
		dispatch('flashMessage', response.data.meta.success, {root: true})
	}).catch((error) => {
		context.errors = error.response.data.errors
	})
}