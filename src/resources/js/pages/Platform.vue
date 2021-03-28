<template lang="">
    <div class="container mt-4">
        <autocomplete @submit="doThis" :search="searchCryptocurrency" placeholder="Search a cryptocurrency"></autocomplete>
        <div class="col mt-5">
            <div v-if="loading">
                Chargement. . .
            </div>
            <div v-else-if="price" class="row container">
                <div>Current Price : </div>
                <span>{{ price }}</span>
                <div class="btn btn-sm btn-success mr-1">Buy</div>
                <div class="btn btn-sm btn-danger">Sell</div>
            </div>
        </div>
    </div>
</template>

<script>
import Autocomplete from '@trevoreyre/autocomplete-vue';
import '@trevoreyre/autocomplete-vue/dist/style.css';

export default {
    props: ['app'],
    components: {
        Autocomplete
    },
    data(){ 
        return {
            loading: false,
            Cryptos : [],
            price: ''
        }
    },
    mounted() {
        this.getCryptoCurrenciesList();
    },
    methods : {
        //returns list of cryptocurrencies to search input
        searchCryptocurrency: function(input){
            var result = [];
            if (input.length < 1) { return [] }
            this.loading = true;
            this.Cryptos.forEach((crypto, index) => {
                  (crypto.toLowerCase().includes(input.toLowerCase())) ?
                  result.push(crypto)
                  : null
            });
            this.loading = false;
            return result;
        },
        //fetch cryptocurrencies from db on load
        getCryptoCurrenciesList : function(){
            this.app.req.get('crypto/list').then(response => {
                this.Cryptos = response.data;
                console.log(response);
            }).catch(error => {
                console.log(error);
            });
        },
        doThis: function(result){
            this.getPrice(result);
        },
        //fetch crypto price from Alphavantage when choosing crypto from list
        getPrice : function(cryptocurrency){
            this.app.req.get('https://www.alphavantage.co/query?function=CURRENCY_EXCHANGE_RATE&from_currency='+cryptocurrency.substring(1, 4)+'&to_currency=EUR&apikey=HJG1A2UT9PH8VMGO').then(response => {
                console.log(response.data);
                this.price = response.data['Realtime Currency Exchange Rate']['5. Exchange Rate'];
            }).catch(error => {
                console.log(error);
            });
        }
    }
}
</script>

<style>
    
</style>