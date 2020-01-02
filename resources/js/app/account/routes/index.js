import { AccountIndex, AccountOverview, AccountProfile, ChanagePassword, AccountDeactivate, TwoFactor } from '../components'

export default [
	{
		path: '/account',
		component: AccountIndex,
		name: 'account',
		meta: {
			needsAuth: true
		},
		children: [
			{
				path: 'overview',
				component: AccountOverview,
				name: 'account.overview',
				meta: {
					needsAuth: true
				},
			},
			{
				path: 'profile',
				component: AccountProfile,
				name: 'account.profile',
				meta: {
					needsAuth: true
				},
			},
			{
				path: 'password',
				component: ChanagePassword,
				name: 'account.password',
				meta: {
					needsAuth: true
				},
			},
			{
				path: 'deactivate',
				component: AccountDeactivate,
				name: 'account.deactivate',
				meta: {
					needsAuth: true
				},
			},
			{
				path: 'twofactor',
				component: TwoFactor,
				name: 'account.twofactor',
				meta: {
					needsAuth: true
				},
			}
		]
	}
]