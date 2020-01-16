<template>
	<div class="timeline container">
		<p>{{ index }}</p>
	</div>
</template>

<script>
	
	export default {
		data () {
			return {
				index: null
			}
		},

		mounted () {
			axios.get('/api/admin/impersonate').then((response) => {
				this.index = response.data.data
			}).catch((error) => {
				if (error.response.data.data.error === "Page does not exist.") {
					this.$router.push({ name: 'notfound'})
				}
			})
		}
	}
</script>