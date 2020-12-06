<template>
    <div class="container" @scroll="handleScroll">
        <header-component></header-component>
        <SearchComponent></SearchComponent>
        <ArticleComponent v-for="article in articles" :article="article" :key="article.id"></ArticleComponent>
    </div>
</template>

<script>
import Vue from 'vue'
import axios from 'axios'
import config from '../config'
import VueAxios from 'vue-axios'

import ArticleComponent from "./ArticleComponent";
import SearchComponent from "./SearchComponent";
import HeaderComponent from "./HeaderComponent";

Vue.use(VueAxios,axios)

export default {
    name: "NewsfeedComponent",
    components:{
        HeaderComponent,
        ArticleComponent,
        SearchComponent
    },
    data: function () {
        return {
            articles: [],
            temp: [],
            header: null,
            currentPage: 1,
            totalPages:0,
        }
    },
    created() {
        document.addEventListener('scroll', this.handleScroll)
    },
    mounted() {
        this.getNews(null);
    },
    methods:{
        getNews:function (search_string) {
            let self = this;
            this.initHeader();
            this.initArticles()
            Vue.axios.get(this.getFullUrl(search_string), this.header)
                .then(response =>{
                    // for(var i = 0; i<response.data.articles.length; i++)
                    //     self.articles.push(response.data.articles[i]);
                    self.currentPage = response.data.page;
                    self.articles = response.data.articles;
                    self.totalPages = response.data.total_pages
                })
                .catch(
                    error => alert('No news found with this keyword')
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
            }else if(this.currentPage !== 1 && this.currentPage <= this.totalPages){
                full_url = full_url +"?page=" + this.currentPage;
            }
            return full_url;
        },
        handleScroll(){
            let bottomOfWindow = Math.max(
                window.pageYOffset,
                document.documentElement.scrollTop,
                document.body.scrollTop
            ) + window.innerHeight === document.documentElement.offsetHeight;


            if (bottomOfWindow) {
                this.currentPage++
                this.getNews(null);
            }
        }
    }
}
</script>

<style scoped>

</style>
