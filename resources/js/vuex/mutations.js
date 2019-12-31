export const getMessage = (state, message) => {
	state.message = message
}

export const clearMessage = (state, message) => {
	state.message = null
}