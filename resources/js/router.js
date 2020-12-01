import Vue from 'vue';
import VueRouter from "vue-router";
import LoginComponent from "./components/LoginComponent";
import ExampleComponent from "./components/ExampleComponent";
import NewsfeedComponent from "./components/NewsfeedComponent";
import config from "./config.js"

Vue.use(VueRouter);
var vue_url = "/vue/"
export default new VueRouter({
    mode:'history',
    routes:[
        {
            path:vue_url,
            component: LoginComponent
        },
        {
            path: vue_url + 'newsfeed',
            component: NewsfeedComponent,
            beforeEnter:(to, from, next) =>{
                if(localStorage.token == null){
                    next(vue_url);
                }else{
                    next();
                }
            }
        },
        {
            path:vue_url + 'example',
            component: ExampleComponent
        }
    ]


})
