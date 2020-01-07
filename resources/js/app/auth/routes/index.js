import { Login, Register, VerifyEmail, ForgotPassword, ResetPassword, TwoFactorLogin } from '../components'

export default [
	{
		path: '/login',
		component: Login,
		name: 'login',
		meta: {
			guest: true,
			needsAuth: false
		}
	},
	{
		path: '/register',
		component: Register,
		name: 'register',
		meta: {
			guest: true,
			needsAuth: false
		}
	},
	{
		path: '/verify-email',
		component: VerifyEmail,
		name: 'email.verify',
		meta: {
			guest: true,
			needsAuth: false
		}
	},
	{
		path: '/forgot-password',
		component: ForgotPassword,
		name: 'password.forget',
		meta: {
			guest: true,
			needsAuth: false
		}
	},
	{
		path: '/password-reset',
		component: ResetPassword,
		name: 'password.reset',
		meta: {
			guest: true,
			needsAuth: false
		}
	},
	{
		path: '/twofactor-login',
		component: TwoFactorLogin,
		name: 'twofactor.login',
		meta: {
			guest: true,
			needsAuth: false
		}
	}
]