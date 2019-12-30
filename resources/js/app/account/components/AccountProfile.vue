<template>
	<div>
		<section class="section">
			<div class="container">
				<h1 class="title">Account profile</h1>
				<hr>
				<form @submit.prevent="submit">
					<div class="field">
					  <label class="label">Name</label>
					  <div class="control">
					    <input class="input" type="text" placeholder="e.g Alex Smith" v-model="name" :class="{ 'is-danger' : errors.name }">
					  </div>
					  <p class="help is-danger" v-if="errors.name">
					  	{{ errors.name[0] }}
					  </p>
					</div>

					<div class="field">
					  <label class="label">Email</label>
					  <div class="control">
					    <input class="input" type="email" placeholder="e.g. alexsmith@gmail.com" v-model="email" :class="{ 'is-danger' : errors.email }">
					  </div>
					  <p class="help is-danger" v-if="errors.email">
					  	{{ errors.email[0] }}
					  </p>
					</div>
					<div class="control">
					  <button type="submit" class="button is-primary">Submit</button>
					</div>
				</form>
			</div>
		</section>
	</div>
</template>

<script>
	import { mapGetters, mapActions } from 'vuex'
	export default {
		data() {
			return {
				name: null,
				email: null,
				errors: []
			}
		},

		computed: {
			...mapGetters({
				user: 'auth/user'
			})
		},

		methods: {
			...mapActions({
				updateUserProfile: 'account/updateUserProfile'
			}),

			fillUserData () {
				this.name = this.user.data.name
				this.email = this.user.data.email
			},

			submit () {
				this.updateUserProfile({
					payload: {
						name: this.name,
						email: this.email,
					},
					context: this
				})
			}
		},

		mounted () {
			this.fillUserData()
		}
	}
</script>		