<template>
    <div class="app">
        <navigation></navigation>
        
        <div class="container">
        <notification></notification>
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
	import Notification from './Notification'

    export default {
    	components:  {
    		Notification
    	}
    }
</script>
