<template>
    <div class="navbar-dark bg-info mb-2 ">
        <nav class="container navbar navbar-expand-sm ">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <router-link to="/" class="nav-link">
                    MTC
                    </router-link>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">{{ app.user ? app.user.name : '' }}</li>
                <div v-if="app.user == null">
                    <router-link to="/login" class="nav-item">Connexion</router-link>
                    <router-link to="/register" class="nav-item">Inscription</router-link>
                </div>
                <div v-else @click="logout">Déconnexion</div>
            </ul>
        </nav>
    </div>
</template>

<script>
export default {
    name: 'navbar',
    props: ['app'],
    data() {
        return {

        }
    },
    methods: {
        logout(){
            this.app.req.post('auth/logout').then(() => {
                this.app.user = null;
                this.$router.push('/login');
            })
        }
    }
}
</script>

<style lang="">
    
</style>