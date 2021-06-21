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
                <div class="row mt-3 price-card">
                    <div class="col-12 h2 my-3 text-dark">Current Price : <span>{{ price }}</span></div>
                    <div class="col-12">
                        <div class="row d-flex justify-content-around mb-3">
                            <div class="col-5 btn btn-sm btn-danger">Sell</div>
                            <div class="col-5 btn btn-sm btn-success">Buy</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Autocomplete from '@trevoreyre/autocomplete-vue';
import ApexCharts from 'apexcharts';
import '@trevoreyre/autocomplete-vue/dist/style.css';
import Highcharts from "highcharts";
import Stock from "highcharts/modules/stock";
import {Chart} from 'highcharts-vue';


export default {
    props: ['app'],
    components: {
        Autocomplete,
        highcharts: Chart 
    },
    data(){ 
        return {
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
        this.getCryptoCurrenciesList();
        Stock(Highcharts);
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
        doThis: function(input){
            Stock(Highcharts);
            let cryptocurrencyCode = input.substring(1, input.indexOf(')'));
            this.getPrice(cryptocurrencyCode);
            this.getData(cryptocurrencyCode);
            
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
               })
        }

    }
}
</script>

<style>
    .price-card {
        background-color: white;
        border-radius: 20px;
    }

    #chart {
        width: 100%;
    }

    .main-wrapper {
        margin-bottom: 15vh;
    }
</style>