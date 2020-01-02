<template>
	<div class="container login">
		<div class="columns">
			<div class="column is-offset-one-quarter is-half">
				<div class="card">
					<div class="card-content">
						<p class="title">Reset password</p>
						<hr>
						<form @submit.prevent="submit">
							<div class="field">
								<label for="email" class="label">Email</label>
								<div class="control">
									<input type="email" class="input" v-model="email" disabled>
								</div>
								<p class="help is-danger" v-if="errors.email">
								   {{ errors.email[0] }}
								</p>
							</div>
							<div class="field">
								<label for="password" class="label">Password</label>
								<div class="control">
									<input type="password" class="input" v-model="password" :class="{ 'is-danger' : errors.password }">
								</div>
								<p class="help is-danger" v-if="errors.password">
								   {{ errors.password[0] }}
								</p>
							</div>
							<div class="field">
								<label for="password_confirmation" class="label">Confirm password</label>
								<div class="control">
									<input type="password" class="input" v-model="password_confirmation" :class="{ 'is-danger' : errors.password_confirmation }">
								</div>
								<p class="help is-danger" v-if="errors.password_confirmation">
							  	    {{ errors.password_confirmation[0] }}
							    </p>
							</div>
							<div class="field">
								<p class="control">
									<button type="submit" class="button is-success">
										Reset password
									</button>
								</p>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
</div>
</template>

<script>
	import { mapActions, mapGetters } from 'vuex'

	export default {
		data () {
			return {
				email: null,
				password: null,
				password_confirmation: null,
				errors: []
			}
		},

		methods: {
			...mapActions({
				setToken: 'auth/setToken',
				fetchUser: 'auth/fetchUser',
				flashMessage: 'flashMessage'
			}),

			submit () {
				return axios.post(this.$route.query.queryURL, {		
					email: this.email,
					password: this.password,
					password_confirmation: this.password_confirmation,
					
				}).then((response) => {

					this.setToken(response.data.meta.token).then(() => {
						this.fetchUser()
						this.$router.replace({ name: 'timeline' })
					})

				}).catch((error) => {
					if (error.response.status === 403) {
						this.flashMessage(error.response.data.data.error)
						this.$router.replace({ name: 'login' })
						return
					}
					this.errors = error.response.data.errors
				})
				console.log(this.$route.query.queryURL)
			}
		},

		mounted () {
			this.email = this.$route.query.email
		}
	}
</script>