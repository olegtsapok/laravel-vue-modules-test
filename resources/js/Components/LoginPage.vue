<template>
    <Navigation />

    <main class="main">
      <section class="pane"></section>

      <section class="pane module-settings-pane">
        <h3>Please Login (email:123)</h3>
        <div class="nav">
            <div class="form-group">
            <form id="loginForm" method='post' action="/login">
                <label for="email">Email</label>
                <div>
                  <input
                    id="clickout"
                    type="text"
                    name="email"
                    placeholder=""
                    v-model="email"
                  />
                </div>
                <label for="password">Password</label>
                <div>
                  <input
                    id="password"
                    type="password"
                    name="password"
                    placeholder=""
                    v-model="password"
                  />
                </div>
                <input type="hidden" name="_token" v-model="csrfToken" />
                <div>
                    <button @click.stop.prevent="login" class="button">Login</button>
                </div>
                <div>
                    <button @click.stop.prevent="register" class="button">Register</button>
                </div>
            </form>
            </div>
       </div> 
       <h4 class='error'>{{ responseError }}</h4>
      </section>

      <section class="pane"></section>
    </main>

</template>

<script setup>
    import { ref } from 'vue';
    import { getCsrfToken, hadleResponseError } from '../utils.js'

    const email = ref('');
    const password = ref('');
    const responseError = ref('');
    const csrfToken = ref(getCsrfToken());

    function login() {
        responseError.value = '';
        axios.post('/api/user/auth', {'email': email.value, 'password': password.value, })
        .then(function (response) {
          // handle success
          localStorage.setItem('user-token', response.data.data.token);
          document.getElementById('loginForm').submit();
        })
        .catch(function (error) {
          responseError.value = hadleResponseError(error);
        });
    }

    function register() {
        responseError.value = '';
        axios.post('/api/user/register', {'email': email.value, 'password': password.value, })
        .then(function (response) {
          // handle success
            alert('User registered');
        })
        .catch(function (error) {
          responseError.value = hadleResponseError(error);
        });
    }
</script>