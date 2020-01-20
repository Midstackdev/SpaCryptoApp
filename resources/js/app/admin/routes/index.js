import { Admin, Transactions, ViewWallet } from '../components'

export default [
	{
		path: '/admin',
		name: 'admin',
		component: Admin,
		meta: {
			needsAuth: true
		}
	},
	{
		path: '/admin-tranfers',
		name: 'admin.transactions',
		component: Transactions,
		meta: {
			needsAuth: true
		}
	},
	{
		path: '/admin-wallet',
		name: 'admin.wallet',
		component: ViewWallet,
		meta: {
			needsAuth: true
		}
	},
]