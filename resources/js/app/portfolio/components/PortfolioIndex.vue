<template>
	<div class="portfolio container">
		<section class="hero is-primary">
			<div class="hero-body">
				<div class="container">
					<form @submit.prevent="submit">
						<div class="field is-horizontal">
							<div class="field-body">
								<div class="field">
								  <label class="label">Label</label>
								  <div class="control">
								    <input class="input" type="text" v-model="label" :class="{ 'is-danger' : errors.label }" placeholder="Your wallet description">
								  </div>
								  <p class="help is-danger" v-if="errors.label">
								  	{{ errors.label[0] }}
								  </p>
								</div>
								<div class="field">
								  <label class="label">Passphrase</label>
								  <div class="control">
								    <input class="input" type="text" v-model="passphrase" :class="{ 'is-danger' : errors.passphrase }" placeholder="Longer passphrase to encrypt your wallet">
								  </div>
								  <p class="help is-danger" v-if="errors.passphrase">
								  	{{ errors.passphrase[0] }}
								  </p>
								</div>
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
								<div class="field">
									<div class="control">
										<button type="submit" class="button is-warning">Create wallet</button>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</section>

		<p class="title is-4">Wallets</p>
		<template v-if="wallets">			
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
		</template>
		<template v-else>
			<p>Create a wallet</p>
		</template>
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
				label: null,
				passphrase: null,
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
						coin: this.coin,
						label: this.label,
						passphrase: this.passphrase
					},

					context: this
				}).then(() => {
					this.coin = ''
					this.label = null
					this.passphrase = null
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