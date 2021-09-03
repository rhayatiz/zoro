<template>
  <div>
      <div class="row px-3 mt-5">
      <h4><i class="fas fa-history"></i> Order history</h4>
      </div>
        <div class="OrderList">
          <template v-for="order in orders">
            <Order :key="order.id" 
            :type="order.type" 
            :date="order.created_at"
            :cryptocurrency="order.cryptocurrency.name"
            :price="order.price"
            :quantity="order.quantity" />
          </template>
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
          orders: []
        }
    },

    mounted() {
      this.fetchOrders();
    },

    methods: {
        fetchOrders: function(){
          this.$parent.app.req.get('order/list').then(response => {
              if(response.data.orders.length > 0){
                this.orders = response.data.orders;
                console.log(response.data.orders);
              }
          }).catch(error => {
              console.log(error);
          });
        }
    },

}
</script>

<style scoped>
</style>