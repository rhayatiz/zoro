<template>
    <div class="container mt-5">
        <h3 class="text-center">Login</h3>
        <form class="w-75 w-md-50 mx-auto">
            <div v-if="errors.length" class="alert alert-danger">
                <ul class="m-0">
                    <li v-for="err in errors" :key="err">
                        {{ err }}
                    </li>
                </ul>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label" for="name">Username</label>
                <div class="col-sm-9">
                    <input class="form-control" type="text" placeholder="username" v-model="username">
                </div>
            </div>
            
            <div class="form-group row">
                <label class="col-sm-3 col-form-label" for="name">Password</label>
                <div class="col-sm-9">
                    <input class="form-control" type="password" placeholder="password" v-model="password">
                </div>
            </div>

            <div v-on:click="onLogin()" class="mt-2 btn-sm btn-success text-center" type="submit">Connexion</div>
        </form> 
        </div> 
</template>

<script>

export default {
    name: 'login',
    props: ['app'],

    data(){
        return {
            name: '',
            username: '',
            password: '',
            passwordConfirm: '',
            errors: []
        }
    },
    methods : {
        onLogin: function(){
            this.errors = [];
            if (!this.username){
                this.errors.push("Username is required");
            }
            if (!this.password){
                this.errors.push("Password is required")
            }

            if (!this.errors.length){
                const data = {
                    username: this.username,
                    password: this.password,
                };

                this.app.req.post('auth/login', data).then(response => {
                    this.app.user = response.data;
                    this.$router.push("/");
                    console.log(response);
                }).catch(error => {
                    console.log(error);
                })
            }
        }

    }
}
</script>

<style>

</style>