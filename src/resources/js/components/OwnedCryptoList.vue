<template>
  <div>
      <div class="row px-3">
      <h4><i class="fas fa-wallet"></i> Wallet </h4><span class="ml-auto font-weight-light align-right">{{ this.$parent.app.user.wallet.address }}</span>
      </div>

      <table class="table table-striped table-light mt-3 rounded shadow">
        <thead>
          <tr>
            <th>Cryptocurrency</th>
            <th class="text-center">Quantity</th>
            <th class="text-center">Average price</th>
            <th class="text-center">Value</th>
          </tr>
        </thead>
            
            
        <tbody v-if="this.ownedCryptos.length == 0">
          <tr><td class="text-center" colspan="6">Empty wallet</td></tr>
        </tbody>

        <tbody v-else>
          <!-- Beginning ownedcrypto -->
            <tr v-for="ownedCrypto in ownedCryptos" :key="ownedCrypto.id">
              <td class="text-center">{{ ownedCrypto.cryptocurrency.name }}</td>
              <td class="text-center">{{ ownedCrypto.quantity }}</td>
              <td class="text-center">{{ ownedCrypto.average_price }}€</td>
              <td class="text-center">
                {{ (ownedCrypto.quantity * ownedCrypto.average_price).toFixed(2) }}€
              </td>
            </tr>
          <!-- End ownedcrypto -->
        </tbody>

      </table>
  </div>
</template>

<script>
import OwnedCrypto from './OwnedCrypto';


export default {
    name: 'OwnedCryptoList',
    props: ['ownedCryptos'],
    components: {
      OwnedCrypto: OwnedCrypto
    }
}
</script>

<style>

</style>