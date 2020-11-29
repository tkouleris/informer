<template>
    <div class="container">
        <ArticleComponent v-for="article in articles" :article="article"></ArticleComponent>
    </div>
</template>

<script>
import Vue from 'vue'
import axios from 'axios'
import config from '../config'
import VueAxios from 'vue-axios'

Vue.use(VueAxios,axios)
import ArticleComponent from "./ArticleComponent";
export default {
    name: "NewsfeedComponent",
    components:{
      ArticleComponent
    },
    data: function () {
        return {
            articles: null
        }
    },
    mounted() {
        var yourConfig = {
            headers: {
                Authorization: "Bearer " + localStorage.token
            }
        }

        Vue.axios.get(config.API_URL + "/api/newsfeed", yourConfig)
            .then(response =>{
                this.articles = response.data.articles
            })
            .catch(
            error=>alert('Wrong Username or Password')
        );
    }
}
</script>

<style scoped>

</style>
