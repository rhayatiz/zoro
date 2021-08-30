<template>
    <div>
        <div class="row d-flex justify-content-around mb-3">
            <div class="py-2 w-100 px-3">
                <form>
                    <div class="row">
                        <div class="col">
                            <input v-on:keyup="updateTotal()" v-model="quantity" type="number" class="form-control" placeholder="Quantity">
                        </div>
                        <div class="col">
                            <input v-on:keyup="updateQuantity()" v-model="total" type="number" class="form-control" placeholder="Total (€)">
                        </div>
                    </div>
                    <div v-if="Object.keys(this.errors).length > 0" class="row px-3">
                        <ul class="alert alert-danger col mt-2 py-1">
                            <li v-for="error in errors" :key="error">
                                {{error}}
                            </li>
                        </ul>
                    </div>
                </form>
            </div>
        </div>
        <div class="row align-content-middle px-3">
            <button @click="buy()" :disabled="Object.keys(this.errors).length > 0 || total <= 0 || total == 'NaN'" class="btn btn-sm btn-success ml-auto">Buy</button>
        </div>
    </div>
</template>

<script>

export default {
    props: ['app'],
    name: 'PlatformBuy',
    data(){
        return {
            cryptocurrency: this.$parent.chosenCrypto,
            price: this.$parent.price,
            quantity: 0,
            total: '',
            errors: {}
        }
    },

    methods: {
        init: function(){
            console.log('platform-buy init()...');
            console.log(this.app.user);
        },

        //update total when quantity changes
        updateTotal: function(){
            // this.total = this.total.replace(/,/g, '.');
            this.total = this.price * this.quantity;
            this.hasEnoughMoney();
        },

        //update quantity when Total changes
        updateQuantity: function(){
            console.log(this.total);
            console.log(this.total.replace(/,/g, '.'));
            // this.quantity = this.quantity.replace(/,/g, '.');
            this.quantity = (this.total / this.price).toFixed(4);
            this.hasEnoughMoney();
        },

        //if total exceeds available money, add error
        hasEnoughMoney: function(){
            if( this.app.user.wallet.available_money - this.total < 0 ){
                this.errors.not_enough_money = 'Vous n\'avez pas assez de liquidité.';
            }else{
                delete this.errors.not_enough_money;
            }
        },

        showToast(text){
            this.$toast(text);  // or this.$toast.bottom('bottom'); 
        },

        buy: function(){
            //check if user has enough money
            if( this.app.user.wallet.available_money - this.total > 0 ){
                //confirm/cancel buy
                console.log('buying '+this.cryptocurrency);
                console.log('ammount '+this.total);
                //execute order
                var data = {
                    type: 'buy',
                    price: this.total,
                    quantity: this.quantity,
                    cryptocurrencyCode: this.cryptocurrency
                };
                this.app.req.post('order/new', data).then(response => {
                    this.$parent.$parent.user = response.data.user;
                    this.$parent.action = false;
                    this.showToast('L\'ordre a été exécuté!')
                }).catch(error => {
                    console.log(error);
                })
                //snackbar order executed
            }
        }

    },

    mounted(){
        this.init();
    }

}
</script>

<style>

</style>