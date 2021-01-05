<template>
        <form @submit.prevent="login">
            <fieldset class="form-group">
                <label for="username">Email</label>
                <input type="email" v-model="email" name="email" class="form-control">
            </fieldset>
            <fieldset class="form-group">
                <label for="password">Password</label>
                <input type="password" v-model="password" name="password" class="form-control">
            </fieldset>
            <fieldset class="form-group">
                <b-button
                    type="submit"
                    variant="success"
                    :disabled="isLoading">
                    <b-spinner
                        small
                        type="grow"
                        v-if="isLoading">
                    </b-spinner>
                    <span>{{ submitText }}</span>
                </b-button>
            </fieldset>
        </form>
</template>

<script>

    export default {
        data() {
            return {
                email: '',
                password: '',
                error: false,
                isLoading: false,
                submitText: 'Login',
                employee_id: 0,

            }
        },

        methods: {

            login () {
                this.isLoading = true;
                this.submitText = 'Logging in...'
                this.$http.post('/api/login', {
                    email: this.email,
                    password: this.password
                }).then( request => this.loginSuccessful(request) )
                  .catch( () => this.loginFailed() )
            },

            loginSuccessful (req) {
                if (!req.data.token) {
                    this.loginFailed();
                    return;
                }
                console.log(req);
                if ( !$cookies.get('token') ) $cookies.set('token', req.data.token, '30d');
                if ( !$cookies.get('isLoggedIn') ) $cookies.set('isLoggedIn', req.status == 200, '30d');
                this.error = false;

                this.$router.replace(this.$route.query.redirect || '/app');
            },

            loginFailed () {
                this.isLoading = false;
                this.submitText = 'Login';
                $cookies.remove('token');
                $cookies.remove('isLoggedIn');
            },

        },
    }
</script>
