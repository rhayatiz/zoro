<template>
  <div>
      <table class="table table-striped table-light mt-3 rounded shadow">
        <thead>
          <tr>
            <th>Cryptocurrency</th>
            <th class="text-center">Quantity</th>
            <th class="text-center">Average price</th>
            <th class="text-center"></th>
          </tr>
        </thead>
            
            
        <tbody v-if="this.ownedCryptos.length == 0">
          <tr><td class="text-center" colspan="6">Empty wallet</td></tr>
        </tbody>

        <tbody v-else>
          <tr v-for="ownedCrypto in ownedCryptos" :key="ownedCrypto.id">
            <td class="text-center">{{ ownedCrypto.cryptocurrency.name }}</td>
            <td class="text-center">{{ ownedCrypto.quantity }}</td>
            <td class="text-center">{{ ownedCrypto.average_price }}</td>
            <td class="text-center">Sell</td>
          </tr>
        </tbody>

      </table>
  </div>
</template>

<script>
export default {
    name: 'OwnedCrypto',
    props: ['ownedCryptos'],
    methods: {
        init: function(){
            console.log("owned crypto");
            console.log(this.ownedCrypto);
            console.log("owned crypto..");
        }
    },

    mounted() {
        this.init();
    },

}
</script>

<style>

</style>