<template>
	<div class="portfolio container">
		<section class="hero is-primary">
			<div class="hero-body">
				<div class="container">
					<nav class="level">
						<div class="level-item has-text-centered">
							<div>
								<p class="heading">BTC</p>
								<p class="title">3,456</p>
							</div>
						</div>
						<div class="level-item has-text-centered">
							<div>
								<p class="heading">ETH</p>
								<p class="title">123</p>
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
								<form @submit.prevent="submit">
									<div class="block">
										<div class="field">
										  <label class="label">Coin</label>
										  <div class="control is-expanded">
										  	 <div class="select is-fullwidth">
											    <select :class="{ 'is-danger' : errors.coin }" v-model="coin">
											    	<option value="" selected>Choose</option>
										    		<option :value="coin.identifier" v-for="coin in coins" :key="coin.id">
										    			{{ coin.identifier }}
										    		</option>
											    </select>
											</div>
										  </div>
										  <p class="help is-danger" v-if="errors.coin">
										  	{{ errors.coin[0] }}
										  </p>
										</div>
									</div>
									<div class="block">
										<button type="submit" class="button is-warning is-small">Create wallet</button>
									</div>
								</form>
							</div>
						</div>
					</nav>
				</div>
			</div>
		</section>

		<p class="title is-4">Wallets</p>
		<div class="card" v-for="wallet in wallets" :key="wallet.id">
			<div class="card-content">
				<div class="media">
					<div class="media-left">
						<figure class="image is-48x48">
							<img src="https://bulma.io/images/placeholders/96x96.png" alt="Placeholder image">
						</figure>
					</div>
					<div class="media-content">
						<router-link :to="{ name: 'wallet', params: { id: wallet.wallet_id} }"><p class="title is-4">{{ wallet.label }}</p></router-link>
						<p class="subtitle is-6">{{ wallet.coin }}</p>
					</div>
				</div>
			</div>
		<hr>
		</div>
		<modal
		v-show="isModalVisible"
		@close="closeModal"
		/>
	</div>
</template>

<script>
	import { mapGetters, mapActions } from 'vuex'
	import Modal from '../../../components/Modal'

	export default {
		components: {
			Modal
		},

		data () {
			return {
				isModalVisible: false,
				coin: '',
				errors: []
			}
		},

		computed: {
			...mapGetters({
				coins: 'portfolio/coins',
				wallets: 'portfolio/wallets',
			})
		},

		methods: {
			...mapActions({
				getCoins: 'portfolio/getCoins',
				getWallets: 'portfolio/getWallets',
				createWalllet: 'portfolio/createWalllet'
			}),

			submit () {
				this.createWalllet({
					payload: {
						coin: this.coin
					},

					context: this
				}).then(() => {
					this.coin = ''
				})
			},

			showModal() {
				this.isModalVisible = true;
			},

			closeModal() {
				this.isModalVisible = false;
			}
		},

		mounted () {
			this.getCoins()
			this.getWallets()
		}
	}
</script>