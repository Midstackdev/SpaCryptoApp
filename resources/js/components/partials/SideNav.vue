<template>
  <div>
    <aside class="menu">
      <p class="menu-label">
        General
      </p>
      <ul class="menu-list">
        <li>
          <a>Timeline</a>
        </li>
        <li>
          <router-link :to="{ name: 'account.overview'}">Account overview</router-link>
        </li>
        <li>
          <router-link :to="{ name: 'account.profile'}">Profile</router-link>
        </li>
        <li>
          <router-link :to="{ name: 'account.password'}">Change password</router-link>
        </li>
        <li>
         <router-link :to="{ name: 'account.deactivate'}">Deactivate account</router-link>
        </li>
        <li>
          <router-link :to="{ name: 'account.twofactor'}">Twofactor authentication</router-link>
        </li>
      </ul>
      <p class="menu-label">
        Transactions
      </p>
      <ul class="menu-list">
        <li><a>Payments</a></li>
        <li><a>Transfers</a></li>
        <li><a>Balance</a></li>
      </ul>
    </aside>
  </div>
</template>