<template>
	<div>
		<section class="section">
			<div class="container">
				<h1 class="title">Deactivate your account</h1>
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

					<div class="control">
					  <button type="submit" class="button is-primary">Deactivate account</button>
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
				errors: []
			}
		},

		methods: {
			...mapActions({
				deactivateAccount: 'account/deactivateAccount'
			}),

			submit () {
				this.deactivateAccount({
					payload: {
						password_current: this.password_current
					},

					context: this
				}).then(() => {
					this.$router.replace({ name: 'home' })
				})
			}
		}
	}
</script>		