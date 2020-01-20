<template>
	<div class="admin container">
		<nav class="level">
		</nav>
		<nav class="level">
		  <div class="level-item has-text-centered">
		    <div>
		      <p class="heading">Users</p>
		      <p class="title">{{ stats.users_count }}</p>
		    </div>
		  </div>
		  <div class="level-item has-text-centered">
		    <div>
		      <p class="heading">Wallets</p>
		      <p class="title">{{ stats.wallet_count }}</p>
		    </div>
		  </div>
		  <div class="level-item has-text-centered">
		    <div>
		      <p class="heading">Transactions</p>
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
		<br>
		<p class="title is-4">All users</p>
		<div>
			<table class="table is-striped is-narrow is-hoverable is-fullwidth">
			  <thead>
			    <tr>
			      <th>Sr.</th>
			      <th>Name</th>
			      <th>Email</th>
			      <th>Status</th>
			      <th>Wallets</th>
			      <th>Manage</th>
			  </tr>
			</thead>
			<tbody>
			    <tr v-for="(user, index) in users" :key="user.id">
			      <th>{{ index + 1 }}</th>
			      <td>{{ user.name }}</td>
			      <td>{{ user.email }}</td>
			      <td v-if="user.active"><span class="tag is-success">Active</span></td>
			      <td v-else><span class="tag is-danger">Inactive</span></td>
			      <td>{{ user.wallet_count }}</td>
			      <td>
			      	<div class="buttons has-addons">
			      	  <button type="button" @click.prevent="view(user.id)" class="button is-small is-link">View</button>
			      	  <button v-if="!user.active" class="button is-small is-primary">Activative</button>
			      	  <button class="button is-small is-danger is-selected">Delete</button>
			      	</div>
			      </td>
			  </tr>
			</tbody>
		</table>
		</div>
	</div>
</template>

<script>
	import { mapActions, mapGetters } from 'vuex'

	export default {
		data () {
			return {
				index: null
			}
		},

		computed: {
			...mapGetters({
				users: 'admin/users',
				stats: 'admin/stats',
			})
		},

		methods: {
			...mapActions({
				isAdmin: 'admin/isAdmin',
				getUsers: 'admin/getUsers',
				getUser: 'admin/getUser',
			}),

			view (userId) {
				this.getUser(userId)
				.then(() => {
					// this.$router.push({ name: 'admin.wallet' })
				})
			}
		},

		mounted () {
			this.isAdmin()
			this.getUsers()
		}
	}
</script>