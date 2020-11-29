<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">

                    <div class="card-body">
                        <div>
                            <p style="color: #000000">
                                <b> Site </b> - time
                            </p>
                            <img width="100%" height="350px;" src="/img/no_image_available.jpg" />
                            <a href="" target="_blank"  ><h3>News title</h3></a>
                            <p style="color: #000000">A small description of the news</p>
                        </div>
                        <div style="margin-bottom: 10px;border-bottom: 1px dotted black;">
                            <span style="color: black;">category: </span><span style="color: black;font-weight: bold;">cagetories of the news</span>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Vue from 'vue'
import axios from 'axios'
import config from '../config'
import VueAxios from 'vue-axios'
Vue.use(VueAxios,axios)
export default {
    name: "NewsfeedComponent",
    mounted() {
        var yourConfig = {
            headers: {
                Authorization: "Bearer " + localStorage.token
            }
        }

        Vue.axios.get(config.API_URL + "/api/newsfeed", yourConfig)
            .then(response =>{
                console.log(response);
            })
            .catch(
            error=>alert('Wrong Username or Password')
        );
    }
}
</script>

<style scoped>

</style>
