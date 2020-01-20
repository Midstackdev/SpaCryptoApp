<template>
	<div>
		<nav class="level">
		</nav>
		<nav class="level">
		  <div class="level-item has-text-centered">
		    <div>
		      <p class="heading">Name</p>
		      <p class="title">{{ user.name }}</p>
		    </div>
		  </div>
		  <div class="level-item has-text-centered">
		    <div>
		      <p class="heading">Wallets</p>
		      <p class="title">{{ user.wallet_count }}</p>
		    </div>
		  </div>
		  <div class="level-item has-text-centered">
		    <div>
		      <p class="heading">Followers</p>
		      <p class="title">456K</p>
		    </div>
		  </div>
		  <div class="level-item has-text-centered">
		    <div>
		      <p class="heading">Likes</p>
		      <p class="title">789</p>
		    </div>
		  </div>
		</nav>
		<nav class="level">
		</nav>
		<div class="tile is-ancestor">
		  <div class="tile is-parent" v-for="(wallet, index) in user.wallets" :key="wallet.id">
		    <article class="tile is-child box">
		      <p class="title">{{ wallet.label }}</p>
		      <p class="subtitle">Coin: {{ wallet.coin }}</p>
		      <p class="subtitle">Balance: {{ wallet.balance }}</p>
		    </article>
		  </div>
		  <!-- <div class="tile is-parent">
		    <article class="tile is-child box">
		      <p class="title">Foo</p>
		      <p class="subtitle">Bar</p>
		    </article>
		  </div> -->
		 <!--  <div class="tile is-parent">
		    <article class="tile is-child box">
		      <p class="title">Third column</p>
		      <p class="subtitle">With some content</p>
		      <div class="content">
		        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ornare magna eros, eu pellentesque tortor vestibulum ut. Maecenas non massa sem. Etiam finibus odio quis feugiat facilisis.</p>
		      </div>
		    </article>
		  </div> -->
		</div>
	</div>
</template>

<script>
	import { mapActions, mapGetters } from 'vuex'

	export default {
		data () {
			return {
				// userId: this.user.id
			}
		},

		computed: {
			...mapGetters({
				user: 'admin/user'
			})
		},

		methods: {
			...mapActions({
				isAdmin: 'admin/isAdmin',
				getUser: 'admin/getUser',
			})
		},

		mounted () {
			this.isAdmin()
			// this.getUser(userId)
		}
	}
</script>