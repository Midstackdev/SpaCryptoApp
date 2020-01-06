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

export const enableTwoFactor = ({ commit, dispatch }, { payload, context }) => {

	return axios.post('/api/account/twofactor', payload).then((response) => {
		commit('auth/setUserData', response.data.data, {root: true})
		dispatch('flashMessage', response.data.meta.success, {root: true})
	}).catch((error) => {
		context.errors = error.response.data.errors
		// console.log(error.response.data.errors)
	})
}

export const verifyTwoFactor = ({ commit, dispatch }, { payload, context }) => {

	return axios.post('/api/account/twofactor/verify', payload).then((response) => {
		commit('auth/setUserData', response.data.data, {root: true})
		dispatch('flashMessage', response.data.meta.success, {root: true})
	}).catch((error) => {
		context.errors = error.response.data.errors
		// console.log(error.response.data.errors)
	})
}

export const disableTwoFactor = ({ commit, dispatch }) => {

	return axios.delete('/api/account/twofactor').then((response) => {
		commit('auth/setUserData', response.data.data, {root: true})
		dispatch('flashMessage', response.data.meta.success, {root: true})
	}).catch((error) => {
		// context.errors = error.response.data.errors
		// console.log(error.response.data.errors)
	})
}

export const getResendToken = ({ commit, dispatch }) => {

	return axios.get('/api/account/twofactor/resend').then((response) => {
		console.log(response)
		// commit('setCountries', response.data.data)
	}).catch((error) => {
		// console.log(error.response.data.errors)
	})
}

export const fetchCountries = ({ commit, dispatch }) => {

	return axios.get('/api/account/twofactor').then((response) => {
		commit('setCountries', response.data.data)
	}).catch((error) => {
		console.log(error.response.data.errors)
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