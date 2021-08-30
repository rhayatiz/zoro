<template lang="">
    <div style="height:100%; width:100%;">
        <navbar :app="this"></navbar>
        <div class="main-wrapper h-100">

            
            <div class="main col col-md-10 mx-0 mx-md-auto">
                <spinner v-if="loading"></spinner>
                <div v-else-if="initiated">
                    <router-view :app="this"/>
                </div>
            </div>

            
        </div>
        <foot v-if="this.user != null" :app="this" :key="this.footerKey"></foot>
    </div>
</template>


<script>
import Navbar from './components/Navbar';
import Foot from './components/Foot';
import Sidebar from './components/Sidebar';

export default {
    name: 'app',
    components: {
        Navbar,
        Foot,
        Sidebar
    },
    data(){
        return {
            footerKey: 1,
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
        this.$router.onReady(() => this.routeLoaded());
    },
    watch: {
        user: function () {
            console.log ("App.vue, user has been updated");
            this.footerKey++;
        }
    },
    methods: {
        init(){
            this.loading = true;

            this.req.get('auth/init').then(response => {
                console.log('init response')
                console.log(response);
                this.user = response.data.user;
                this.loading = false;
                this.initiated = true;
            });
            console.log(this.user);
        },
        routeLoaded() {
            this.init();
        }
        // getHistory : function(){
        //     this.req.get('https://www.alphavantage.co/query?function=DIGITAL_CURRENCY_MONTHLY&symbol=BTC&market=EUR&apikey=HJG1A2UT9PH8VMGO')
        //         .then(response => {
        //             console.log(response)
        //         }).catch(error => {
        //             console.log(error);
        //         });
        // }
    }

};
</script>

<style>
    html {
        height: auto;
    }
    
    body{
        height: 100%;
    }
</style>