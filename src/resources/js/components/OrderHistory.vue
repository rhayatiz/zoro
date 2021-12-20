<template>
  <div>
      <div class="row px-3 mt-5">
      <h4><i class="fas fa-history"></i> Order history</h4>
      </div>
        <div class="OrderList mx-3">
          <template v-for="order in orders.data">
            <Order :key="order.id" 
            :type="order.type" 
            :date="order.created_at"
            :cryptocurrency="order.cryptocurrency.name"
            :price="order.price"
            :quantity="order.quantity" />
          </template>

          <pagination class="mt-2 mb-5 pb-3" align="center" :data="orders" @pagination-change-page="getResults"></pagination>
        </div>

  </div>
</template>

<script>
import Order from './Order';

export default {
    name: 'OrderHistory',

    components: {
      Order
    },

    data(){
        return {
          orders: {}
        }
    },
    mounted(){
      this.getResults();
    },
    methods: {
      getResults(page = 1){
        axios.get('order/list?page=' + page)
          .then(response => {
            this.orders = response.data.orders;
          });
      }
    },
}
</script>

<style scoped>
</style>