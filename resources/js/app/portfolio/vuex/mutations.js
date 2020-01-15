export const setCoins = (state, data) => {
	state.coins = data
}

export const setWallets = (state, data) => {
	state.wallets = data
}

export const setTransfers = (state, data) => {
	state.transfers = data
}

export const setNewTransfer = (state, data) => {
	state.transfers.unshift(data)
}

export const setWallet = (state, data) => {
	state.wallet = data
}