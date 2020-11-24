<template>

    <div class="login">
        <form id="login" method="get" action="login.php">
            <label><b>User Name
            </b>
            </label>
            <input v-model="email" type="text" name="Uname" id="Uname" placeholder="Username">
            <br><br>
            <label><b>Password
            </b>
            </label>
            <input v-model="password" type="Password" name="Pass" id="Pass" placeholder="Password">
            <br><br>
            <input @click="login_attempt" type="button" name="log" id="log" value="Log In Here">
            <br><br>
            <input type="checkbox" id="check">
            <span>Remember me</span>
<!--            <br><br>-->
<!--            Forgot <a href="#">Password</a>-->
        </form>
    </div>
</template>

<script>
import Vue from 'vue'
import axios from 'axios'
import VueAxios from 'vue-axios'
Vue.use(VueAxios,axios)
export default {
    name: "InformerComponent",
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
            Vue.axios.post("api/login", credentials)
                .then(response => console.log(response))
                .catch(error=>alert('Wrong Username or Password'));
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
    /*margin: 20px 0px 0px 450px;*/
    padding: 80px;
    background: #23463f;
    border-radius: 15px ;

}
h2{
    text-align: center;
    color: #277582;
    padding: 20px;
}
label{
    color: #08ffd1;
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
    color: blue;
}
span{
    color: white;
    font-size: 17px;
}
a{
    float: right;
    background-color: grey;
}
</style>
