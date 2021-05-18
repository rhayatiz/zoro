<template>
    <div class="foot">
        <div class="container align-middle d-flex justify-content-between">
             <div class="menu">FOOTER HERE</div>
             <div class="menu d-flex flex-column">
                 <div>DAILY W/L</div>
                 <div>CASH DISPO?</div>
             </div>
             <div class="menu">Mon portefeuille</div>
        </div>
    </div>
</template>

<script>
export default {
    
}
</script>

<style scoped>
.menu {
    vertical-align: middle;
}

.foot{
    width: 100%;
    height: 10vh;
    border-top: 1px solid rgb(146, 80, 25);
    position: fixed;
    bottom: 0;
    z-index: 10;
    background: rgb(223, 223, 223);
}
</style>