<template>
    <div class="foot pt-2">
        <div class="container align-middle d-flex justify-content-between">
            <div class="menu d-flex flex-column">
                 <div class="text-center text-white">DAILY W/L</div>
                 <div class="pill wl-green text-center px-2 font-weight-bold">+213,12 (+6%)</div>
            </div>

            <div class="menu d-flex flex-column">
                <div class="text-center text-white">Montant disponible</div>
                <div class="text-center pill bg-light"><span id="available-money">{{ availableMoney }}</span> €</div>
            </div>

            <div class="menu d-flex flex-column">
                <div class="text-center text-white my-auto">
                    <router-link to="/Wallet" class="text-white">Mon portefeuille</router-link>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            availableMoney: 0        
        }
    },

    mounted() {
        this.availableMoney = this.formatAvailableMoney();
    },
    
    methods: {
        formatAvailableMoney: function(){
            let x = this.$parent.user.wallet.available_money;
            var parts = x.toString().split(".");
            parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, " ");
            return parts.join(",");
        }
    },
}
</script>

<style scoped>
.pill {
    border-radius: 10px;
}

.wl-green {
    background-color: rgb(107, 185, 133);
    color: rgb(9, 110, 42);
}

.wl-red {
    background-color: rgb(185, 107, 107);
    color: rgb(110, 9, 9);
}

.menu {
    vertical-align: middle;
}

.foot{
    color: rgb(26, 26, 26);
    width: 100%;
    height: 75px;
    border-top: 1px solid rgb(243, 243, 243);
    position: fixed;
    bottom: 0;
    z-index: 10;
    background:rgba(0,0,0,0.5);
}
</style>