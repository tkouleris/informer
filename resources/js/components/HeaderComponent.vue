<template>
    <div class="row justify-content-center">

        <div class="col-md-8">
            <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
                <div class="container">
                    <router-link class="navbar-brand" :to="{ path: 'newsfeed' }">Informer</router-link>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label=""
                    >
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto">

                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">

                            <li class="nav-item dropdown">

                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                                    <img class="rounded-circle z-depth-0 md-avatar size-1"
                                         :src="avatar_url"
                                    /> {{ username }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <router-link class="dropdown-item" :to="{ path: 'settings' }">Settings</router-link>
                                    <a class="dropdown-item" @click="logout">
                                        Logout
                                    </a>
                                </div>
                            </li>

                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </div>

</template>

<script>
import config from '../config'
export default {
    name: "HeaderComponent",
    data(){
        return {
            username: null,
            avatar_url:null,
        }
    },
    mounted: function () {
        this.username = localStorage.name
        this.avatar_url = config.API_URL + '/images/' + localStorage.id + '/avatar.jpg';
    },
    methods:{
        logout(){
            localStorage.clear();
            window.location.href = config.API_URL + '/vue';
        }
    }
}
</script>

<style scoped>

</style>
