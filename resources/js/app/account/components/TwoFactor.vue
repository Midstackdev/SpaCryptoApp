<template>
	<div>
		<section class="section">
			<div class="container">
				<h1 class="title">Two factor login</h1>
				<hr>
				<template v-if="user.data.twoFaEnabled">
					<form @submit.prevent="disable">
						<div class="field">
						  <label class="label">Disable two factor</label>
						  <div class="control">
						    <p>Two factor authentication is enabled on your account.</p>
						  </div>
						</div>

						<div class="control">
						  <button type="submit" class="button is-primary">Disable</button>
						</div>
					</form>
				</template>
				<template v-else>	
					<template v-if="user.data.twoFaVerified">
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

							<div class="control">
							  <button type="submit" class="button is-primary">Verify</button>
							</div>
							<div class="field is-grouped is-grouped-centered">
							  <p class="control">
							    <a class="button is-primary" @click.prevent="getToken">
							      Resend token
							    </a>
							  </p>
							  <p class="control">
							    <a class="button is-light">
							      Cancel
							    </a>
							  </p>
							</div>
						</form>
					</template>
					<template v-else>
						<form @submit.prevent="submit">
							<div class="field">
							  <label class="label">Country code</label>
							  <div class="control is-expanded">
							  	 <div class="select is-fullwidth">
								    <select :class="{ 'is-danger' : errors.dial_code }" v-model="dial_code">
								    	<option value="" selected>Country</option>
							    		<option :value="country.code" v-for="country in countries" :key="country.id">
							    			{{ country.name }} (+{{ country.code }})
							    		</option>
								    </select>
								</div>
							  </div>
							  <p class="help is-danger" v-if="errors.dial_code">
							  	{{ errors.dial_code[0] }}
							  </p>
							</div>

							<div class="field">
							  <label class="label">Phone number</label>
							  <div class="control">
							    <input class="input" type="text" v-model="phone_number" :class="{ 'is-danger' : errors.phone_number }">
							  </div>
							  <p class="help is-danger" v-if="errors.phone_number">
							  	{{ errors.phone_number[0] }}
							  </p>
							</div>

							<div class="control">
							  <button type="submit" class="button is-primary">Enable</button>
							</div>
						</form>
					</template>
				</template>
			</div>
		</section>
	</div>
</template>

<script>
	import { mapActions, mapGetters } from 'vuex'
	
	export default {
		data() {
			return {
				dial_code: '',
				phone_number: null,
				token: null,
				errors: []
			}
		},

		computed: {
			...mapGetters({
				countries: 'account/countries',
				user: 'auth/user'
				
			})
		},

		methods: {
			...mapActions({
				fetchCountries: 'account/fetchCountries',
				enableTwoFactor: 'account/enableTwoFactor',
				verifyTwoFactor: 'account/verifyTwoFactor',
				disableTwoFactor: 'account/disableTwoFactor',
				getResendToken: 'account/getResendToken'
			}),

			submit () {
				this.enableTwoFactor({
					payload: {
						dial_code: this.dial_code,
						phone_number: this.phone_number,
					},

					context: this
				}).then(() => {
					this.dial_code = ''
					this.phone_number = null
				})
			},

			verify () {
				this.verifyTwoFactor({
					payload: {
						token: this.token
					},
					context: this
				}).then(() => {
					//refresh page
					//this.$router.go()
				})
			},

			disable () {
				this.disableTwoFactor().then(() => {
					//refresh page
					//this.$router.go()
				})
			},

			getToken () {
				this.getResendToken()
			}
		},

		mounted () {
			this.fetchCountries()
		}
	}
</script>		