<template>
    <div v-scroll="onScroll" class="container">
        <header-component></header-component>
        <SearchComponent></SearchComponent>
        <ArticleComponent v-for="article in articles" :article="article" :key="article.id"></ArticleComponent>
    </div>
</template>

<script>
import Vue from 'vue'
import axios from 'axios'
import config from '../config'
import vuescroll from 'vue-scroll'
import VueAxios from 'vue-axios'


import ArticleComponent from "./ArticleComponent";
import SearchComponent from "./SearchComponent";
import HeaderComponent from "./HeaderComponent";


Vue.use(VueAxios,axios)
Vue.use(vuescroll)
export default {
    name: "NewsfeedComponent",
    components:{
        HeaderComponent,
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
        console.log('mounted');
        this.getNews(null);
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
            if(search_string !== null){
                full_url = full_url +"?search_query=" + search_string;
            }

            return full_url;
        },
        onScroll(){
            console.log('scroll');
        }
    }
}
</script>

<style scoped>

</style>
