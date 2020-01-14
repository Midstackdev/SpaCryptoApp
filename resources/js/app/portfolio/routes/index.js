import { PortfolioIndex, Wallet } from '../components'

export default [
	{
		path: '/portfolio',
		name: 'portfolio.index',
		component: PortfolioIndex,
		meta: {
			needsAuth: true
		}
	},
	{
		path: '/wallet/:id',
		name: 'wallet',
		component: Wallet,
		meta: {
			needsAuth: true
		}
	}
]