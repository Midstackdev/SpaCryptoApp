import { PortfolioIndex } from '../components'

export default [
	{
		path: '/portfolio',
		name: 'portfolio.index',
		component: PortfolioIndex,
		meta: {
			needsAuth: true
		}
	}
]