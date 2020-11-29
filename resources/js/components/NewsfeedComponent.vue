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
            articles: null,
            header: null
        }
    },
    mounted() {

        this.getNews();

    },
    methods:{
        getNews: function (){
            this.initHeader();
            Vue.axios.get(config.API_URL + "/api/newsfeed", this.header)
                .then(response =>{
                    this.articles = response.data.articles
                })
                .catch(
                    error=>alert('Wrong Username or Password')
                );
        },
        initHeader: function (){
            this.header = {
                headers: {
                    Authorization: "Bearer " + localStorage.token
                }
            }
        }
    }
}
</script>

<style scoped>

</style>
