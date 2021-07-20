<template>
  <div>
      <div class="row px-3 mt-5">
      <h4><i class="fas fa-history"></i> Order history</h4>
      </div>

      <table class="table table-striped table-light mt-3 rounded shadow">
        <thead>
          <tr>
            <th>Order</th>
            <th class="text-center">Type</th>
            <th class="text-center">Date</th>
            <th class="text-center">Cryptocurrency</th>
            <th class="text-center">Price</th>
            <th class="text-center">Quantity</th>
            <th class="text-center">Total</th>
          </tr>
        </thead>
        <tbody v-if="this.orders.length == 0">
          <tr><td class="text-center" colspan="7">No Orders</td></tr>
        </tbody>

        <tbody v-else>
          <tr v-for="order in orders" :key="order.id">
            <td class="text-center">{{ order.id }}</td>
            <td class="text-center">{{ order.type }}</td>
            <td class="text-center">{{ order.created_at }}</td>
            <td class="text-center">{{ order.cryptocurrency.name }}</td>
            <td class="text-center">{{ order.price }} €</td>
            <td class="text-center">{{ order.quantity }}</td>
            <td class="text-center">{{ (order.quantity * order.price).toFixed(2) }} €</td>
          </tr>
        </tbody>

      </table>
  </div>
</template>

<script>
export default {
    name: 'OrderHistory',

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

<style>

</style>