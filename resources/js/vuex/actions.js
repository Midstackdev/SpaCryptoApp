export const flashMessage = ({ commit }, message) => {
	commit('getMessage', message)

	setTimeout(() => {
		commit('clearMessage')
	}, 5000)
}