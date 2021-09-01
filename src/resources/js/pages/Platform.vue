<template lang="">
    <div class="container mt-4">
        <autocomplete class="text-dark" @submit="doThis" :search="searchCryptocurrency" placeholder="Search a cryptocurrency"></autocomplete>
        <div class="col mt-4">
            <div v-if="loading">
                Chargement. . .
            </div>
            <div v-else-if="price" class="row container d-flex flex-column main-wrapper">
                <div class="row">
                    <highcharts id="chart" :constructorType="'stockChart'" :options="chartOptions"></highcharts>
                </div>
                <div class="row mt-3 price-card p-2">
                    <div class="price-card-inner mx-auto">
                        <div class="row px-3">
                            <div class="col-8 h2 text-dark font-weight-light">Current Price : <span class="font-weight-bold">{{ price }}</span>EUR</div>
                            <div v-if="action == false" class="col-4">
                                        <div @click="action = 'buy'" class="col btn btn-sm btn-success shadow">Buy</div>
                            </div>
                            <div v-else class="col-4">
                                <div @click="action = false" class="btn btn-sm btn-light float-right">X</div>
                            </div>
                        </div>
                        <!-- buy -->
                        <div v-if="action == 'buy'"  class="col-12">
                            <PlatformBuy :app='this.app'/>
                        </div>
                        <!-- sell -->
                        <div v-if="action == 'Sell'"  class="col-12">
                            <div class="row d-flex justify-content-around mb-3">
                                <div class="py-2 w-100 px-3">
                                    <form>
                                        <div class="row">
                                            <div class="col">
                                                <input v-bind="quantity" type="text" class="form-control" placeholder="Quantity">
                                            </div>
                                            <div class="col">
                                                <input v-bind="total" type="text" class="form-control" placeholder="Total (€)">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="row align-content-middle px-3">
                                <div class="btn btn-sm btn-danger ml-auto">Sell</div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Autocomplete from '@trevoreyre/autocomplete-vue';
import '@trevoreyre/autocomplete-vue/dist/style.css';
import Highcharts from "highcharts";
import Stock from "highcharts/modules/stock";
import {Chart} from 'highcharts-vue';
import PlatformBuy from '../components/Platform-buy';

export default {
    props: ['app'],
    components: {
        Autocomplete,
        highcharts: Chart,
        PlatformBuy: PlatformBuy
    },
    data(){ 
        return {
            chosenCrypto: '',
            action: false,
            loading: false,
            Cryptos : [],
            price: '',
            chartOptions: {
                navigator: {
                    enabled: false
                },
                series: [{
                    type: 'spline',
                    data: [1,2,3] // sample data
                }],
                chart: {
                    borderRadius: 15,
                    shadow: true,
                    margin: [50, 50, 50, 50],
                },
                scrollbar: {
                    enabled: false
                }
            }
        }
    },
    mounted() {
        //Choose eth by default
        //this.DebugEth();

        this.getCryptoCurrenciesList();
        Stock(Highcharts);
    },
    methods : {
        //Choose eth by default
        DebugEth: function(){
            console.log('Debugging is active ... -- Platform.vue@DebugEth();')
            this.getPrice('ETH');
        },

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
        doThis: function(input){
            Stock(Highcharts);
            let cryptocurrencyCode = input.substring(1, input.indexOf(')'));
            this.getPrice(cryptocurrencyCode);
            this.getData(cryptocurrencyCode);
            this.chosenCrypto = cryptocurrencyCode;
        },
        //fetch crypto price from Alphavantage when choosing crypto from list
        getPrice : function(cryptocurrencyCode){
            this.app.req.get('https://www.alphavantage.co/query?function=CURRENCY_EXCHANGE_RATE&from_currency='+cryptocurrencyCode+'&to_currency=EUR&apikey='+this.app.alphaVantageKey).then(response => {
                console.log(response.data);
                this.price = parseFloat(response.data['Realtime Currency Exchange Rate']['5. Exchange Rate']).toFixed(2);
            }).catch(error => {
                console.log(error);
            });
        },

        //get necessary data for the chart
        getData: function(cryptocurrencyCode){
            this.chartOptions.series[0].data = [1, 2, 3, 4];
            this.app.req.get('https://www.alphavantage.co/query?function=DIGITAL_CURRENCY_DAILY&symbol='+cryptocurrencyCode+'&market=EUR&apikey='+this.app.alphaVantageKey)
               .then(response => {
                //    console.log(response.data['Time Series (Digital Currency Daily)']);
                   let series = [];
                   for (var key in response.data['Time Series (Digital Currency Daily)']) {
                       let timestamp = new Date(key).getTime();
                       let val = parseFloat(response.data['Time Series (Digital Currency Daily)'][key]['4a. close (EUR)']).toFixed(2);
                       series.push([timestamp, parseFloat(val)]);
                    }
                    this.chartOptions.series[0].data = series;
               }).catch(error => {
                   console.log(error);
               });
               this.action = '';
        }

    }
}
</script>

<style>
    .price-card {
        background-color: white;
        border-radius: 20px;
        border: 2px solid rgb(204, 204, 204);
    }

    #chart {
        width: 100%;
    }

    .main-wrapper {
        margin-bottom: 75px;
    }
</style>