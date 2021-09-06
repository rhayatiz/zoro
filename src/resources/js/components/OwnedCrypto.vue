<template>
    <div>
        <div class="ownedCrypto-container row bg-white text-dark rounded shadow">
            <div class="row w-100">
                <div class="col-3">{{ name }}</div>
                <div class="col-3">
                    <span class="font-weight-bold">Prix moyen:</span>
                    <span class="order-bloc-text">{{price}}€</span>
                </div>
                <div class="col-3">
                    <span class="font-weight-bold">Qté:</span>
                    <span>{{quantity}}</span>
                </div>
                <div class="col-3">
                    <span class="btn btn-sm btn-danger float-right">Sell</span>
                </div>
            </div>
            <div v-if="sellState" class="row sell">
                <div class="col-3">
                    <input type="number" min="0" b-vind:max="quantity">
                </div>
                <div class="col-3">Prix: {{ price }}</div>
                <div class="col-3">{{ name }}</div>

            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: [
        'Cryptocurrency',
        'name',
        'code',
        'quantity'
        ],
    name: 'OwnedCrypto',
    
    data() {
      return {
        sellState : false,
        price: 0
      }
    },
    methods: {
        init: function(){
            this.fetchPrice(this.code);
        },
        cancelSell: function(){
          this.sellState = false;
        },
        initiateSell: function(cryptocurrencyCode){
          this.sellState = true;
        },
        fetchPrice: function(cryptocurrencyCode){
        //fetch crypto price from Alphavantage when choosing crypto from list
            this.$parent.$parent.app.req.get('https://www.alphavantage.co/query?function=CURRENCY_EXCHANGE_RATE&from_currency='+cryptocurrencyCode+'&to_currency=EUR&apikey='+this.$parent.$parent.app.alphaVantageKey).then(response => {
                this.price = parseFloat(response.data['Realtime Currency Exchange Rate']['5. Exchange Rate']).toFixed(2);
                console.log('fetched price =='+this.price);
            }).catch(error => {
                console.log(error);
            });
        }
    },

    mounted() {
        this.init();
    },
}
</script>

<style scoped>
.ownedCrypto-container {
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