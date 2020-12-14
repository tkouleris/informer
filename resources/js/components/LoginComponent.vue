<template>
    <div class="login">

        <form id="login" method="get">
            <label><b>Email
            </b>
            </label>
            <input v-model="email" @keypress="loginAtEnterPressed($event)" type="text" name="Uname" id="Uname" placeholder="Username">
            <br><br>
            <label><b>Password
            </b>
            </label>
            <input v-model="password" @keypress="loginAtEnterPressed($event)" type="Password" name="Pass" id="Pass" placeholder="Password">
            <br><br>
            <input @click="login_attempt" type="button" name="log" id="log" value="Log In Here">
            <br><br>
            <input type="checkbox" id="check">
            <span>Remember me</span>
            <br>
            <a href="register">create account</a>
        </form>
    </div>
</template>

<script>
import Vue from 'vue'
import axios from 'axios'
import config from '../config'
import VueAxios from 'vue-axios'
Vue.use(VueAxios,axios)

export default {
    name: "LoginComponent",
    data(){
        return {
            email: null,
            password: null
        }
    },
    methods:{
        login_attempt: function (){

            let credentials = {
                'email': this.email,
                'password': this.password
            }

            Vue.axios.post(config.API_URL + "/api/login", credentials)
                .then(
                    response =>{
                        localStorage.token = response.data.token;
                        localStorage.name = response.data.name;
                        localStorage.id = response.data.id;
                        this.$router.push('/vue/newsfeed');
                    }

                ).catch(
                    error=>alert('Wrong Username or Password')
                );
        },
        loginAtEnterPressed(event){
            if(event.keyCode !== 13){
                return;
            }
            this.login_attempt();
        }
    }
}
</script>

<style scoped>
body
{
    margin: 0;
    padding: 0;
    background-color:#6abadeba;
    font-family: 'Arial',serif;
}
.login{
    width: 500px;
    overflow: hidden;
    margin: auto;
    margin-top: 15px;
    padding: 80px;
    background: #808080;
    border-radius: 15px ;

}
h2{
    text-align: center;
    color: #277582;
    padding: 20px;
}
label{
    color: black;
    font-size: 17px;
}
#Uname{
    width: 300px;
    height: 30px;
    border: none;
    border-radius: 3px;
    padding-left: 8px;
}
#Pass{
    width: 300px;
    height: 30px;
    border: none;
    border-radius: 3px;
    padding-left: 8px;

}
#log{
    width: 300px;
    height: 30px;
    border: none;
    border-radius: 17px;
    padding-left: 7px;
    color: black;
}
span{
    color: white;
    font-size: 17px;
}
a{
    float: right;
    color: blue;
}
</style>
