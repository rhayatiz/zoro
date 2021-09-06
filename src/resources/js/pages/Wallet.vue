<template>
  <div class="mt-4 container text-white">
      <!-- Wallet content (owned crypto) -->
      <OwnedCryptoList :ownedCryptos="this.app.user.wallet.owned_crypto" />
      <!------------------ ORDER HISTORY ------------->
      <OrderHistory :app="this.app"/>
  </div>
</template>

<script>
import OrderHistory from '../components/OrderHistory';
import OwnedCryptoList from '../components/OwnedCryptoList';

export default {
  props: ['app'],
  
  data() {
    return {
    }
  },

  components: {
    OrderHistory: OrderHistory,
    OwnedCryptoList: OwnedCryptoList
  },

  mounted() {
    this.init();
  },

  methods: {
    init: function(){
      this.app.user.original ? 
      this.user = this.app.user.original.user
      : this.user = this.app.user; 
    }
  },
}
</script>

<style>

.pill {
    border-radius: 10px;
}

.wl-green {
    background-color: rgb(161, 219, 186);
    color: rgb(9, 110, 42);
}

.wl-red {
    background-color: rgb(219, 157, 157);
    color: rgb(128, 25, 25);
}

th, td {
  vertical-align: middle !important;
}

</style>