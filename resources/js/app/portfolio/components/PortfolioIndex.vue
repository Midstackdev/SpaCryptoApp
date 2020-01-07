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
				        <div class="block">
						    <button class="button is-success is-small">Deposit</button>
						</div>
						<div class="block">
						    <button class="button is-danger is-small">Withdraw</button>
						</div>
				    </div>
				  </div>
				</nav>
		    </div>
		  </div>
		</section>
		<p class="title is-4">Recent transactions</p>
		<div class="card">
			<div class="card-content">
				<div class="media">
			      <div class="media-left">
			        <figure class="image is-48x48">
			          <img src="https://bulma.io/images/placeholders/96x96.png" alt="Placeholder image">
			        </figure>
			      </div>
			      <div class="media-content">
			        <p class="title is-4">John Smith</p>
			        <p class="subtitle is-6">@johnsmith</p>
			      </div>
			    </div>
			</div>
		</div>
	</div>
</template>

<script>
	
	export default {
		data () {
			return {
				index: null
			}
		},

		mounted () {
			axios.get('/api/timeline').then((response) => {
				this.index = response.data.data
			})
		}
	}
</script>