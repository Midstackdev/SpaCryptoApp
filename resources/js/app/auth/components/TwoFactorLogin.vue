<template>
	<div class="container login">
		<div class="columns">
			<div class="column is-offset-one-quarter is-half">
				<div class="card">
					<div class="card-content">
						<p class="title">Sms Token</p>
						<hr>
						<form @submit.prevent="verify">
							<div class="field">
							  <label class="label">Verification token</label>
							  <div class="control">
							    <input class="input" type="text" v-model="token" :class="{ 'is-danger' : errors.token }">
							  </div>
							  <p class="help is-danger" v-if="errors.token">
							  	{{ errors.token[0] }}
							  </p>
							</div>

							<div class="field is-grouped is-grouped-centered">
							  <p class="control">
							  	<button type="submit" class="button is-primary">Verify</button>
							    
							  </p>
							  <p class="control">
							    <a class="button is-light" @click.prevent="getToken">
							      Resend token
							    </a>
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
				token: null,
				errors: []
			}
		},

		methods: {
			...mapActions({
				verifyLogin: 'auth/verifyLogin',
				getResendToken: 'account/getResendToken'
			}),

			verify () {
				this.verifyLogin({
					payload: {
						token: this.token
					},
					context: this
				}).then(() => {
					//refresh page
					//this.$router.go()
				})
			},

			getToken () {
				this.getResendToken()
			}
		}
	}
</script>