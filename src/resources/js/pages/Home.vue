<template lang="">
    <div class="container">
        <h1>home pageee</h1>
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

<style lang="">
    
</style>