import axios from 'axios'

export const getCoins = ({ commit, dispatch }) => {

	return axios.get('/api/portfolio/getcoins').then((response) => {
		commit('setCoins', response.data.data)
	}).catch((error) => {
		console.log(error.response.data.error)
	})
}

export const getWallets = ({ commit, dispatch }) => {

	return axios.get('/api/portfolio/allwallets').then((response) => {
		commit('setWallets', response.data.data)
	}).catch((error) => {
		console.log(error.response.data.error)
	})
}

export const getAWallet = ({ commit, dispatch }, id ) => {

	return axios.get(`/api/portfolio/${id}`).then((response) => {
		commit('setWallet', response.data.meta.wallet)
	}).catch((error) => {
		console.log(error.response.data.error)
	})
}

export const getTransfers = ({ commit, dispatch }, id ) => {

	return axios.get(`/api/portfolio/gettransfers/${id}`).then((response) => {
		commit('setTransfers', response.data.meta.transfers)
	}).catch((error) => {
		console.log(error.response.data.error)
	})
}

export const unlock = ({ commit, dispatch }) => {

	return axios.get(`/api/portfolio/unlock`).then((response) => {
		// commit('setTransfers', response.data.meta.transfers)
	}).catch((error) => {
		console.log(error.response.data.error)
	})
}

export const createWalllet = ( {commit, dispatch } , { payload, context }) => {

	return axios.post('/api/portfolio', payload).then((response) => {
		commit('setWallets', response.data.data.wallets)
		dispatch('flashMessage', response.data.meta.success, {root: true})
	}).catch((error) => {
		context.errors = error.response.data.errors
	}) 
}

export const sendCoins = ( {commit, dispatch } , { id, payload, context }) => {

	return axios.post(`/api/portfolio/sendtransfer/${id}`, payload).then((response) => {
		commit('setNewTransfer', response.data.meta.transfer)
		dispatch('flashMessage', response.data.meta.success, {root: true})
	}).catch((error) => {
		context.errors = error.response.data.errors
	}) 
}