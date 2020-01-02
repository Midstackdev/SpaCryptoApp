import { Home, EmailVerified } from '../components'

export default [
	{
		path: '/',
		component: Home,
		name: 'home',
		meta: {
			// guest: true,
			needsAuth: false
		},
		
	},
	{	
		path: '/email-verified',
		component: EmailVerified,
		name: 'email.verified',
		meta: {
			// guest: true,
			needsAuth: false
		}
	}
]