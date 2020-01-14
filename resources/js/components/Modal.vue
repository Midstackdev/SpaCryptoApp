<template>
	<div>
		<div class="modal" role="dialog" aria-labelledby="modalTitle" aria-describedby="modalDescription">
		  <div class="modal-background"></div>
		  <div class="modal-content">
		  	<slot name="header">
		  	</slot>

		  	<slot name="body">
		  		I am a default body
		  	</slot>

		  	<slot name="footer">
		  		i am a default footer
		  		<button class="close is-small"></button>
		  	</slot>
		  </div>
		  <button class="modal-close is-large" aria-label="close"></button>
		</div>
	</div>
</template>

<script>
	export default {
		name: 'modal',

		methods: {
			close() {
				this.$emit('close');
			},
		},
	};
</script>