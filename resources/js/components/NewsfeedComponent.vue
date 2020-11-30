<template>
    <div class="container">
        <SearchComponent></SearchComponent>
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
import SearchComponent from "./SearchComponent";
export default {
    name: "NewsfeedComponent",
    components:{
        ArticleComponent,
        SearchComponent
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
        getNews: function (search_string){
            this.initHeader();
            this.initArticles()
            Vue.axios.get(this.getFullUrl(search_string), this.header)
                .then(response =>{
                    this.articles = response.data.articles
                })
                .catch(
                    error=>alert('No news found with this keyword')
                );
        },
        initHeader: function (){
            this.header = {
                headers: {
                    Authorization: "Bearer " + localStorage.token
                }
            }
        },
        initArticles()
        {
            this.articles = null;
        },
        getFullUrl(search_string)
        {
            let full_url = config.API_URL + "/api/newsfeed";
            if(search_string !== undefined){
                full_url = full_url +"?search_query=" + search_string;
            }
            return full_url;
        }
    }
}
</script>

<style scoped>

</style>
