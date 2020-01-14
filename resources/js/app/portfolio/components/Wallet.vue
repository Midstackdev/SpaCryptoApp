<template>
	<div>
		<nav class="level">
		  <p class="level-item has-text-centered">
		    <a class="link is-info">Home</a>
		  </p>
		  <p class="level-item has-text-centered">
		    <a class="link is-info">Menu</a>
		  </p>
		  <p class="level-item has-text-centered">
		    <img src="https://bulma.io/images/bulma-type.png" alt="" style="height: 30px;">
		  </p>
		  <p class="level-item has-text-centered">
		    <a class="link is-info">Reservations</a>
		  </p>
		  <p class="level-item has-text-centered">
		    <a class="link is-info">Contact</a>
		  </p>
		</nav>
		<section class="hero is-primary">
		  <div class="hero-body">
		    <div class="container">
				<nav class="level">
					<div class="level-item has-text-centered">
						<div>
							<p class="heading">Balance</p>
							<p class="title">{{ wallet.balance }}</p>
						</div>
					</div>
					<div class="level-item has-text-centered">
						<div>
							<p class="heading">Coin</p>
							<p class="title">{{wallet.coin}}</p>
						</div>
					</div>
					<div class="level-item has-text-centered">
						<div>
							<p class="heading">Address</p>
							<p class="title is-6">{{ wallet.address }}</p>
							<p class="heading">copy this address to recieve coins</p>
						</div>
					</div>
					<div class="level-item has-text-centered">
						<div>
							<div class="block">
								<button class="button is-success is-small">Deposit</button>
							</div>
							<div class="block">
								<button class="button is-danger is-small" @click.prevent="submit">Send</button>
							</div>
						</div>
					</div>
				</nav>
		    </div>
		  </div>
		</section>

		<p class="title is-4">Recent transactions</p>
		<div class="card" v-for="transfer in transfers" :key="transfer.id">
			<div class="card-content">
				<div class="media">
					<div class="media-left">
						<figure class="image is-48x48">
							<img src="https://bulma.io/images/placeholders/96x96.png" alt="Placeholder image">
						</figure>
					</div>
					<div class="media-content">
						<p>
					        <strong>$ {{ transfer.usd }}</strong> <small>{{ transfer.type }}</small> <small>{{ transfer.date }}</small>
					        <br>
					        {{ transfer.label }}
				    	</p>
						<p class="subtitle is-6">{{ transfer.state }}</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	import { mapActions, mapGetters } from 'vuex'

	export default {
		data () {
			return {

			}
		},

		computed: {
			...mapGetters({
				wallet: 'portfolio/wallet',
				transfers: 'portfolio/transfers'
			})
		},

		methods: {
			...mapActions({
				getAWallet: 'portfolio/getAWallet',
				getTransfers: 'portfolio/getTransfers'
			})
		},

		mounted () {
			this.getAWallet(this.$route.params.id)
			this.getTransfers(this.$route.params.id)
		}
	}
	
</script>