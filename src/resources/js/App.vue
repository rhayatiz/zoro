<template lang="">
    <div>
        <navbar :app="this"></navbar>
        <div class="main-wrapper">
            <spinner v-if="loading"></spinner>
            <div v-else-if="initiated">
                <router-view :app="this"/>
            </div>
        </div>
        <foot v-if="user" :app="this"></foot>
    </div>
</template>


<script>
import Navbar from './components/Navbar';
import Foot from './components/Foot';

export default {
    name: 'app',
    components: {
        Navbar,
        Foot
    },
    data(){
        return {
            alphaVantageKey: 'HJG1A2UT9PH8VMGO',
            user: null,
            loading: false,
            initiated: false,
            req: axios.create({
                baseUrl: BASE_URL
            })
        }
    },
    mounted() {
        this.init();
    },
    methods: {
        init(){
            this.loading = true;

            this.req.get('auth/init').then(response => {
                this.user = response.data.user;
                this.loading = false;
                this.initiated = true;
            })
        },
        getHistory : function(){
            this.req.get('https://www.alphavantage.co/query?function=DIGITAL_CURRENCY_MONTHLY&symbol=BTC&market=EUR&apikey=HJG1A2UT9PH8VMGO')
                .then(response => {
                    console.log(response)
                }).catch(error => {
                    console.log(error);
                });
        }
    }

};
</script>

<style lang="">
</style>