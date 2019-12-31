<template>
	<div>
		<section class="section">
			<div class="container">
				<h1 class="title">Change password</h1>
				<hr>
				<form @submit.prevent="submit">
					<div class="field">
					  <label class="label">Current password</label>
					  <div class="control">
					    <input class="input" type="password" v-model="password_current" :class="{ 'is-danger' : errors.password_current }">
					  </div>
					  <p class="help is-danger" v-if="errors.password_current">
					  	{{ errors.password_current[0] }}
					  </p>
					</div>

					<div class="field">
					  <label class="label">New password</label>
					  <div class="control">
					    <input class="input" type="password" v-model="password" :class="{ 'is-danger' : errors.password }">
					  </div>
					  <p class="help is-danger" v-if="errors.password">
					  	{{ errors.password[0] }}
					  </p>
					</div>
					<div class="field">
					  <label class="label">Confirm new password</label>
					  <div class="control">
					    <input class="input" type="password" v-model="password_confirmation" :class="{ 'is-danger' : errors.password_confirmation }">
					  </div>
					  <p class="help is-danger" v-if="errors.password_confirmation">
					  	{{ errors.password_confirmation[0] }}
					  </p>
					</div>
					<div class="control">
					  <button type="submit" class="button is-primary">Change password</button>
					</div>
				</form>
			</div>
		</section>
	</div>
</template>

<script>
	import { mapActions } from 'vuex'

	export default {
		data() {
			return {
				password_current: null,
				password: null,
				password_confirmation: null,
				errors: []
			}
		},

		methods: {
			...mapActions({
				updateUserPassword: 'account/updateUserPassword'
			}),

			submit () {
				this.updateUserPassword({
					payload: {
						password_current: this.password_current,
						password: this.password,
						password_confirmation: this.password_confirmation
					},

					context: this
				}).then(() => {
					this.password_current = null
					this.password = null
					this.password_confirmation = null
					this.errors = []
				})
			}
		}
	}
</script>		