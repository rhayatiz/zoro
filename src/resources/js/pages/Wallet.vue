<template>
  <div class="mt-4 container text-white">

      <!------------------ WALLLET ------------->
      <div class="row px-3">
      <h4><i class="fas fa-wallet"></i> Wallet </h4><span class="ml-auto font-weight-light align-right">15N8ZpPq7Te9d8h7pURjZ102bSR3h8n8oAM</span>
      </div>

      <!-- Wallet content (owned crypto) -->
      <OwnedCrypto />

      <!------------------ ORDER HISTORY ------------->
      <OrderHistory />

  </div>
</template>

<script>
import OrderHistory from '../components/OrderHistory';
import OwnedCrypto from '../components/Owned-crypto';

export default {
  props: ['app'],
  
  data() {
    return {
      
    }
  },

  components: {
    OrderHistory: OrderHistory,
    OwnedCrypto: OwnedCrypto
  },

  mounted() {
    
  },

  methods: {
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