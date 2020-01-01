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
		path: '/verify-email',
		component: EmailVerified,
		name: 'email.verify',
		meta: {
			// guest: true,
			needsAuth: false
		}
	}
]