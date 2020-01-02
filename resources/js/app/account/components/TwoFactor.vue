<template>
	<div>
		<section class="section">
			<div class="container">
				<h1 class="title">Enable two factor lgoin</h1>
				<hr>
				<form @submit.prevent="submit">
					<div class="field">
					  <label class="label">Country code</label>
					  <div class="control is-expanded">
					  	 <div class="select is-fullwidth">
						    <select :class="{ 'is-danger' : errors.dial_code }">
						    	<option value="" selected>Country</option>
					    		<option :value="country.id" v-for="country in countries" :key="country.id">
					    			{{ country.name }} (+{{ country.code }})
					    		</option>
						    </select>
						</div>
					  </div>
					  <p class="help is-danger" v-if="errors.dial_code">
					  	{{ errors.dial_code[0] }}
					  </p>
					</div>

					<div class="field">
					  <label class="label">Phone number</label>
					  <div class="control">
					    <input class="input" type="password" v-model="phone_number" :class="{ 'is-danger' : errors.phone_number }">
					  </div>
					  <p class="help is-danger" v-if="errors.phone_number">
					  	{{ errors.phone_number[0] }}
					  </p>
					</div>

					<div class="control">
					  <button type="submit" class="button is-primary">Enable</button>
					</div>
				</form>
			</div>
		</section>
	</div>
</template>

<script>
	import { mapActions, mapGetters } from 'vuex'
	
	export default {
		data() {
			return {
				dial_code: null,
				phone_number: null,
				errors: []
			}
		},

		computed: {
			...mapGetters({
				countries: 'account/countries'
			})
		},

		methods: {
			...mapActions({
				fetchCountries: 'account/fetchCountries'
			}),

			submit () {
				console.log(this.countries)
			}
		},

		mounted () {
			this.fetchCountries()
		}
	}
</script>		