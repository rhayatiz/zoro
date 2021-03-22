<template>
    <div class="navbar-container navbar-dark mb-2">
        <nav class="container navbar navbar-expand-sm ">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <router-link to="/" class="nav-link text-dark">
                    ZORO
                    </router-link>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item mr-4">{{ app.user ? 'Hello, '+app.user.name : '' }}</li>
                <div v-if="app.user == null">
                    <router-link to="/login" class="nav-item">Connexion</router-link>
                    <router-link to="/register" class="nav-item">Inscription</router-link>
                </div>
                <a class="nav-item" v-else @click="logout">Déconnexion</a>
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

<style>
    .navbar-container {
        background: #e9e7e7;
        box-shadow:  6px 6px 12px #e2e0e0,
                    -6px -6px 12px #f0eeee;
    }
</style>