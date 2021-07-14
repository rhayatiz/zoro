<template>
    <div>
        <div class="row d-flex justify-content-around mb-3">
            <div class="py-2 w-100 px-3">
                <form>
                    <div class="row">
                        <div class="col">
                            <input v-on:keyup="updateTotal()" v-model="quantity" type="text" class="form-control" placeholder="Quantity">
                        </div>
                        <div class="col">
                            <input v-on:keyup="updateQuantity()" v-model="total" type="text" class="form-control" placeholder="Total (€)">
                        </div>
                    </div>
                    <div v-if="this.errors.length > 0" class="row px-3">
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
            <div @click="buy()" v-bind:class="{ disabled : this.errors.length > 0 }" class="btn btn-sm btn-success ml-auto">Buy</div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'PlatformBuy',
    data(){
        return {
            price: this.$parent.price,
            quantity: 0,
            total: '',
            errors: {}
        }
    },

    methods: {
        init: function(){
        },

        //Validates quantity (integer)
        checkQuantity: function(){
            return true;
        },

        //Validates total (float)
        checkTotal: function(){
            return true;
        },

        //update total when quantity changes
        updateTotal: function(){
            if(this.checkQuantity){
                this.total = this.price * this.quantity;
                //if total exceeds available money, show error
                if( this.$parent.$parent.user.wallet.available_money - this.total < 0 ){
                    this.errors['not_enough_money'] = 'Vous n\'avez pas assez de liquidité.';
                    console.log('errerur');
                }else{
                    this.errors.removeItem("not_enough_money");
                }
                console.log(this.errors);
            }
        },

        //update quantity when Total changes
        updateQuantity: function(){
            if(this.checkTotal){
                this.quantity = (this.total / this.price).toFixed(4);
            }
        },

        buy: function(){
            //check if user has enough money
            if( this.$parent.$parent.user.wallet.available_money - this.total > 0 ){
                console.log('executed');
            }
            //confirm/cancel buy

            //execute order

            //snackbar order executed
        }

    },

    mounted(){
        this.init();
    }

}
</script>

<style>

</style>