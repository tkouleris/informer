import Vue from 'vue';
import VueRouter from "vue-router";
import LoginComponent from "./components/LoginComponent";
import ExampleComponent from "./components/ExampleComponent";

Vue.use(VueRouter);

export default new VueRouter({
    mode:'history',
    routes:[
        {
            path:'/vue/',
            component: LoginComponent
        },
        {
            path:'/vue/example',
            component: ExampleComponent
        }
    ]


})
