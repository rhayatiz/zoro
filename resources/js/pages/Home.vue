<template lang="">
    <div class="container">
        <div class="row mt-5 mx-auto">
            <div class="col-5 col-sm-6 d-flex flex-column justify-content-md-center">
                <div class="h-50">
                    <div id="logo" class="align-bottom ">ZORO</div>
                    <div>Your favourite Cryptocurrency exchange platform</div>
                    <div class="mb-2">Join us now and start trading cryptocurrencies !</div>
                    <div>Sign up to claim your 100 000$ Virtual money.</div>
                    <div class="mt-3">
                        <router-link v-if="this.app.user != null" to="/register" class="nav-item btn-signup">Sign up</router-link>
                    </div>
                </div>
            </div>
            <div class="col-5 col-sm-6">
                <img class="" width="500" :src="'/img/home_logo.png'" />
            </div>
        </div>

        <!-- CARDS -->
        <div class="card-wrapper row mt-5 cards-row">
            <div class="col-lg-4 col-xs-12 mb-sm-5">
                <div class="box-part text-center">
                    <div class="title">
                        <h4>Low fees</h4>
                    </div>

                    <div class="">
                        <img class="svg-image"
                            :src="'/img/low_fees.svg'"
                            alt="low fees art"
                             />
                    </div>
                    
                    <div class="text">
                        <span>ZORO is one of the cheapest platform out here, we offer very competitive fees.</span>
                    </div>
                    
                    
                </div>
            </div>	 
            
            <div class="col-lg-4 col-xs-12 mb-sm-5">
                <div class="box-part text-center">
                    <div class="title">
                        <h4>Cryptocurrencies support</h4>
                    </div>
                    
                    <div class="">
                        <img class="svg-image"
                            :src="'/img/cryptocurrencies.svg'"
                            alt="cryptocurrencies art"
                             />
                    </div>

                    <div class="text">
                        <span>ZORO supports most of cryptocurrencies, we work hard to enable our users to trade most cryptocurrencies.</span>
                    </div>
                </div>
            </div>	 
            
            <div class="col-lg-4 col-xs-12">
                <div class="box-part text-center">
                    
                    <div class="title">
                        <h4>Virtual wallet</h4>
                    </div>

                    <div class="">
                        <img class="svg-image"
                            :src="'/img/online_wallet.svg'"
                            alt="virtual wallet"
                             />
                    </div>
                    
                    <div class="text">
                        <span>ZORO provides its users a free and secure virtual wallet to store your cryptocurrencies.</span>
                    </div>
                </div>
            </div>	 
        </div>
        <!-- CARDS -->
    </div>
</template>

<script>
export default {
    props: ['app'],
    mounted() {
        this.getHistory();
    },
    methods : {
        getHistory : function(){
            this.app.req.get('https://www.alphavantage.co/query?function=DIGITAL_CURRENCY_MONTHLY&symbol=BTC&market=EUR&apikey=HJG1A2UT9PH8VMGO')
                .then(response => {
                    console.log(response.data)
                }).catch(error => {
                    console.log(error);
                });
        }
    }
}
</script>

<style scoped>
    .box-part {
        margin-bottom: 70px !important;
    }

    .box-part:last-child {
        margin-bottom: 0px !important;
    }


    .card-wrapper {
        margin-top: 100px !important;
    }

    .text {
        width: 70%;
        margin: 0 auto;
    }

    .cards-row {
        margin-top: 50px;
    }

    .svg-image {
        height: 180px;
        margin: 20px 0px;
    }

    #logo {
        font-size: 4rem;
        letter-spacing: -6px;
        font-weight: 900;
    }

    @media screen and (max-width: 1050px) {
        img {
            width: 400px;
        }
    }

    @media screen and (max-width: 850px) {
        #logo {
            font-size: 3rem;
        }
        img {
            width: 300px;
        }
    }

    @media screen and (max-width: 650px) {
        img {
            width: 250px;
        }
    }
</style>