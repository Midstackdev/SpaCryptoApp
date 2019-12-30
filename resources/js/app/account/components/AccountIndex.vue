<template>
	<div>
		<div class="columns">
		  <div class="column is-one-quarter">
		  	<side-nav></side-nav>
		  </div>
		  <div class="column">
		  	<router-view></router-view>
		  </div>
		</div>
	</div>
</template>

<script>
	import SideNav from '../../../components/partials/SideNav'
	export default {
		components: {
			SideNav
		}
	}
</script>	