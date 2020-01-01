<template>
	<div class="home container">
		Email has been verified
	</div>
</template>

<script>
	import { mapActions, mapGetters } from 'vuex'

	export default {
		methods: {
			...mapActions({
				activateUser: 'auth/activateUser',
				setToken: 'auth/setToken',
				fetchUser: 'auth/fetchUser',
				flashMessage: 'flashMessage'
			})
		},

		computed: {
			...mapGetters({

			})
		},

		mounted () {
			return axios.get(this.$route.query.queryURL).then((response) => {
				
				this.setToken(response.data.meta.token).then(() => {
					this.fetchUser()
				})
			}).catch((error) => {
				console.log(error.response.data.data.error)
				this.flashMessage(error.response.data.data.error)
			})
			// this.activateUser(this.$route.query.queryURL)
			// console.log(this.$route.query.queryURL)
		}
	}
</script>