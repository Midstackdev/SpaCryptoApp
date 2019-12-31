<template>
    <div class="notification is-success" v-if="message">
    	<button class="delete" @click.prevent=""></button>
        {{ message }}
    </div>
</template>

<script>
	import { mapGetters } from 'vuex'

    export default {
    	computed: {
    		...mapGetters ({
    			message: 'message'
    		})
    	}
    }
</script>

<style>
	.message {
		position: fixed;
		top: 0; left: 0;
		background-color: tomato;
		color: #fff;
		height: 60px;
		width: 100%;
		display: flex;
		align-items: center;
		justify-content: center;
		font-size: 1.2em;
	}
</style>