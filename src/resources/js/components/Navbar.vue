<template>
    <div class="navbar-container navbar-dark mb-2">
        <nav class="container navbar navbar-expand-sm ">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <router-link to="/" class="logo nav-link text-dark">
                    ZORO
                    </router-link>
                </li>
            </ul>

            <ul v-if="this.app.user != null" class="navbar-nav mx-auto">
                <li class="nav-item">
                    <router-link to="/platform" class="nav-item text-white">Platforme</router-link>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto">
                <li class="nav-item mr-4">{{ app.user ? 'Hello, '+app.user.name : '' }}</li>
                <div v-if="app.user == null">
                    <router-link to="/login" class="nav-item btn-login mr-3">Connexion</router-link>
                    <router-link to="/register" class="nav-item btn-signup">Inscription</router-link>
                </div>
                <a class="nav-item cursor-pointer" v-else @click="logout">Déconnexion</a>
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
    html {
        height: auto;
    }
    
    html, body {
        color: rgb(255, 255, 255);
        background: rgb(2,0,36);
        background: linear-gradient(126deg, rgba(2,0,36,1) 0%, rgba(54,122,180,1) 0%, rgba(29,93,219,1) 55%, rgba(0,82,153,1) 98%);
    }

    .btn-login {
        border-radius: 15px;
        padding: 5px 15px;
        color: #23d1d1  ;
        border: 1px solid #23d1d1;
    }

    .btn-signup {
        border-radius: 15px;
        padding: 5px 15px;
        color: #211ab1;
        background-color: #23d1d1; /* fallback for old browsers */
    }

    .btn-signup:hover{
        text-decoration: none;
        background-color: #1ca7a7; /* fallback for old browsers */
        color: #211ab1;
    }

    .btn-login:hover {
        text-decoration: none;
        color: #211ab1;
        background-color: #23d1d1; /* fallback for old browsers */
    }

    .logo {
        font-weight: 700;
    }

    .logo:hover {
        font-weight: 900;
        color: rgb(255, 255, 255)
    }

    .cursor-pointer:hover {
        cursor: pointer;
    }
</style>