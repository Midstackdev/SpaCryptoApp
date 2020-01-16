import { Admin, Transactions } from '../components'

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
]