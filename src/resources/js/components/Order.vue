<template lang="">
    <div>
            <div class="order-container row bg-white text-dark rounded shadow">
                <div class="col-4 col-xl">{{ date | formatDate }}</div>
                <div class="col-4 col-xl text-capitalize" 
                    v-bind:class="typeColor">{{ type }}</div>
                <div class="col-4 col-xl">{{ cryptocurrency }}</div>
                <div class="col-4 col-xl d-flex flex-column flex-sm-row">
                    <span class="font-weight-bold">Prix:</span>
                    <span class="order-bloc-text">{{ price }}€</span>
                </div>
                <div class="col-4 col-xl d-flex flex-column flex-sm-row">
                    <span class="font-weight-bold">Qté:</span>
                    <span class="order-bloc-text">{{ quantity }}</span>
                </div>
                <div class="col-4 col-xl d-flex flex-column flex-sm-row">
                    <span class="order-bloc-title font-weight-bold">Total:</span>
                    <span class="order-bloc-text">{{(quantity * price).toFixed(2)}} €</span>
                </div>
      </div>
    </div>
</template>

<script>
import moment from 'moment';

export default {
    name : 'Order',
    props : [
         'type',
         'date',
         'cryptocurrency',
         'price',
         'quantity'
    ],
    computed: {
        typeColor: function(){
            if (this.type == 'buy'){
                return 'color-green';
            }else if(this.type == 'sell'){
                return 'color-red';
            }
        }
    },
    filters: {
        formatDate: function(value) {
            if (value) {
                return moment(String(value)).format('MM-DD-YYYY hh:mm')
            }
        }
    }
}
</script>

<style scoped>
.order-container {
  padding: 10px 20px;
  margin-bottom: 2px;
}
.font-weight-bold {
  font-weight: 700 !important;
}
.order-bloc-text {
  margin-left: 5px;
}
.color-red {
    color: rgb(194, 67, 67);
}
.color-green {
    color: rgb(86, 192, 86);
}
</style>