import Vue from 'vue';
import VueRouter from "vue-router";
import LoginComponent from "./components/LoginComponent";
import ExampleComponent from "./components/ExampleComponent";
import NewsfeedComponent from "./components/NewsfeedComponent";

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
            component: NewsfeedComponent
        },
        {
            path:vue_url + 'example',
            component: ExampleComponent
        }
    ]


})
