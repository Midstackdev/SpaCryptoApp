<template>
	<div class="transactions container">
		<nav class="level">
		  
		</nav>
		<!-- Main container -->
		<nav class="level">
		  <!-- Left side -->
		  <div class="level-left">
		    <div class="level-item">
		      <p class="subtitle is-5">
		        <strong>Coin</strong>
		      </p>
		    </div>
		    <div class="level-item">
			    <form @submit.prevent="submit">
			      <div class="field has-addons">
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
			        <p class="control">
			          <button type="submit" class="button is-primary">
			            All Transactions
			          </button>
			        </p>
			      </div>
			    </form>
		    </div>
		  </div>

		  <!-- Right side -->
		  <div class="level-right">
		    <p class="level-item"><strong>All</strong></p>
		    <p class="level-item"><a>Published</a></p>
		    <p class="level-item"><a>Drafts</a></p>
		    <p class="level-item"><a>Deleted</a></p>
		    <p class="level-item"><a class="button is-success">New</a></p>
		  </div>
		</nav>
	</div>
</template>

<script>
	import { mapActions, mapGetters } from 'vuex'

	export default {
		data () {
			return {
				coin: '',
				errors: []
			}
		},

		computed: {
			...mapGetters({
				coins: 'portfolio/coins',
			})
		},

		methods: {
			...mapActions({
				isAdmin: 'admin/isAdmin',
				getCoins: 'portfolio/getCoins',
				coinTransfers: 'admin/coinTransfers',
			}),

			submit () {
				this.coinTransfers({
					payload: {
						coin: this.coin
					}
				})
			}
		},

		mounted () {
			this.isAdmin()
			this.getCoins()
		}
	}
</script>