<template>
    <div class="container mt-5">
        <h3 class="text-center">Register</h3>
        <form class="w-75 w-md-50 mx-auto">
            <div v-if="errors.length" class="alert alert-danger">
                <ul class="m-0">
                    <li v-for="err in errors" :key="err">
                        {{ err }}
                    </li>
                </ul>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label" for="name">Name</label>
                <div class="col-sm-9">
                    <input class="form-control" type="text" placeholder="name" v-model="name">
                </div>
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

            <div class="form-group row">
                <label class="col-sm-3 col-form-label" for="name">Password confirm</label>
                <div class="col-sm-9">
                    <input class="form-control" type="password" placeholder="Password confirm" v-model="passwordConfirm">
                </div>
            </div>


            <div v-on:click="onSubmit()" class="mt-2 btn-sm btn-success text-center" type="submit">Inscription</div>
        </form> 
        </div> 
</template>

<script>

export default {
    name: 'register',
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
        onSubmit: function(){
            this.errors = [];
            if (!this.name){
                this.errors.push("Name is required");
            }
            if (!this.username){
                this.errors.push("Username is required");
            }
            if (!this.password){
                this.errors.push("Password is required")
            }
            if (!this.passwordConfirm){
                this.errors.push("Password confirmation is required")
            }
            if(this.password != this.passwordConfirm){
                this.errors.push('Passwords are not identical');
            }

            if (!this.errors.length){
                const data = {
                    username: this.username,
                    password: this.password,
                    passwordConfirm: this.passwordConfirm,
                    name: this.name
                };

                this.app.req.post('auth/register', data).then(response => {
                    this.app.user = response.data;
                    this.$router.push("/");
                    console.log(response);
                }).catch(error => {
                    this.errors.push(error.response.data.error)
                    console.log(error);
                })
            }
        }

    }
}
</script>

<style>

</style>