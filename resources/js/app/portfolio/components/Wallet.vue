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
							<form @submit.prevent="submit">
								<div class="block">
									<div class="field">
									  <label class="label">Address</label>
									  <div class="control">
									    <input class="input" type="text" v-model="address" :class="{ 'is-danger' : errors.address }" placeholder="Enter destination addres">
									  </div>
									  <p class="help is-danger" v-if="errors.address">
									  	{{ errors.address[0] }}
									  </p>
									</div>
									<div class="field">
									  <label class="label">Amount</label>
									  <div class="control">
									    <input class="input" type="text" v-model="amount" :class="{ 'is-danger' : errors.amount }" placeholder="Enter amont">
									  </div>
									  <p class="help is-danger" v-if="errors.amount">
									  	{{ errors.amount[0] }}
									  </p>
									</div>
								</div>
								<div class="block">
									<button type="submit" class="button is-warning is-small">Send coins</button>
								</div>
							</form>
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
			<hr>
		</div>
	</div>
</template>

<script>
	import { mapActions, mapGetters } from 'vuex'

	export default {
		data () {
			return {
				address: null,
				amount: null,
				errors: []
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
				getTransfers: 'portfolio/getTransfers',
				sendCoins: 'portfolio/sendCoins',
				unlock: 'portfolio/unlock'
			}),

			submit () {
				this.sendCoins({
					payload: {
						address: this.address,
						amount: this.amount,
					},

					context: this,

					id: this.$route.params.id
				}).then(() => {
					this.address = null
					this.amount = null
				})
			}
		},

		mounted () {
			this.getAWallet(this.$route.params.id)
			this.getTransfers(this.$route.params.id)
			this.unlock()
		}
	}
	
</script>