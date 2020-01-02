<template>
	<div class="container login">
		<div class="columns">
			<div class="column is-offset-one-quarter is-half">
				<div class="card">
					<div class="card-content">
						<p class="title">Reset forgotten password</p>
						<hr>
						<form @submit.prevent="submit">	
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
								<p class="control">
									<button type="submit" class="button is-success">
										Send password reset link
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
				email: null,
				errors: []
			}
		},

		methods: {
			...mapActions({
				resendPassword: 'auth/resendPassword'
			}),

			submit () {
				this.resendPassword({
					payload: {
						email: this.email
					},

					context: this
				}).then(() => {
					this.email = null
					this.errors = []
				})
			}
		}
	}
</script>