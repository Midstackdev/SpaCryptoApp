<template>
	<div class="container register">
		<div class="columns">
			<div class="column is-offset-one-quarter is-half">
				<div class="card">
					<div class="card-content">
						<p class="title">Register</p>
						<hr>
						<form @submit.prevent="submit">
							<div class="notification is-success" v-if="false">
								<button class="delete"></button>
								Please check your email to verify
							</div>
							<div class="field">
								<label for="name" class="label">Name</label>
								<div class="control">
									<input type="text" class="input" v-model="name" :class="{ 'is-danger' : errors.name }">
								</div>
								<p class="help is-danger" v-if="errors.name">
									{{ errors.name[0] }}
								</p>
							</div>
							<div class="field">
								<label for="email" class="label">Email</label>
								<div class="control">
									<input type="email" class="input" v-model="email" :class="{ 'is-danger' : errors.email }">
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
								<p class="control">
									<button type="submit" class="button is-success">
										Register
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
	import { mapActions } from 'vuex'

	export default {
		data () {
			return {
				name: null,
				email: null,
				password: null,
				errors: []
			}
		},

		methods: {
			...mapActions({
				register: 'auth/register'
			}),

			submit () {
				this.register({
					payload: {
						name: this.name,
						email: this.email,
						password: this.password,
					},

					context: this
				}).then(() => {
					this.name = null
					this.email = null
					this.password = null
					this.errors = []
					this.$router.replace({ name: 'home' })
				})
			}
		}
	}
</script>