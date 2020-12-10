<template>

    <div class="container">
        <header-component></header-component>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h2 style="color: #000000;">User Settings</h2>
                    </div>

                    <div class="card-body">
                        <select class="browser-default custom-select" name="setting_country_select" @change="selectCountry($event)">
                            <option v-for="country in countries" :id="country.CountryID">{{ country.CountryName }}</option>
                        </select>

                        <div v-for="category in categories" class="form-check">
                            <input type="checkbox"
                                   class="form-check-input"
                                   :name="'chbx_category_' + category.CategoryID"
                                   :id="category.CategoryID"
                                   @change="set_selected_categories_for_country($event,category.CategoryID)"
                            >
                            <label class="form-check-label"  style="color: #000000;">
                                {{ category.CategoryName }}
                            </label>
                        </div>
                    </div>
                    <div class="card-header">
                        <h2 style="color: #000000;">Avatar</h2>
                    </div>
                    <div class="card-body">
<!--                        <form  enctype="multipart/form-data">-->
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="file" id="avatarToUpload" name="image" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <button @click="uploadAvatar"  class="btn btn-success">Upload</button>
                                </div>
                            </div>
<!--                        </form>-->
                    </div>
                    <div class="card-header">
                        <h2 style="color: #000000;">Change Password</h2>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="">

                            <div class="alert alert-danger" role="alert">
                                Passwords not match!
                            </div>

                            <div class="form-group row">
                                <label for="new_password" class="col-md-2 col-form-label text-md-right" style="color:black;">Password</label>
                                <div class="col-md-6">
                                    <input id="new_password" type="password" class="form-control" name="new_password" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password_confirm" class="col-md-2 col-form-label text-md-right" style="color:black;">Confirm</label>
                                <div class="col-md-6">
                                    <input id="password_confirm" type="password" class="form-control @error('confirm_password') is-invalid @enderror" name="password_confirm" required>
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Update Password
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
import HeaderComponent from "./HeaderComponent";
import Vue from "vue";
import config from "../config";
export default {
    name: "SettingsComponent",
    components: {HeaderComponent},
    data: function () {
        return {
            categories: null,
            countries:null,
            header:{
                headers: {
                    Authorization: "Bearer " + localStorage.token
                },
            }
        }
    },
    mounted() {
        this.initializePage();
    },
    methods:{
        initializePage: function ()
        {
            let full_url = config.API_URL + "/api/settings";
            Vue.axios.get(full_url, this.header)
                .then(response =>{
                    this.categories = response.data.Categories;
                    this.countries = response.data.Countries;
                })
                .catch(
                    error=>alert('No news found with this keyword')
                );
        },
        getCountryCategories(country_id){
            let full_url = config.API_URL + "/api/settings/categories/" + country_id;
            Vue.axios.get(full_url, this.header)
                .then(response =>{
                    response.data.forEach(function(category){
                        let el_category_checkbox = $('[name=chbx_category_'+category.setting_categoryid+']');
                        el_category_checkbox.prop('checked', false);
                        if(category.setting_active == 1)
                        {
                            el_category_checkbox.prop('checked', true);
                        }
                    });
                })
                .catch(
                    error=>alert('No news found with this keyword')
                );
        },
        selectCountry(event){
            let country_id = $('[name=setting_country_select]').children(":selected").attr("id");
            this.getCountryCategories(country_id);
        },
        set_selected_categories_for_country(event,category_id){
            let country_id = $('[name=setting_country_select]').find(":selected").attr('id');;
            let full_url = config.API_URL + "/api/settings/categories/set";
            let data = {
                'country_id':country_id,
                'category_id':category_id,
            }
            let self = this;
            Vue.axios.post(full_url, data, this.header)
                .then(response =>{
                    self.getCountryCategories(country_id);
                }).catch(
                    error=>alert('Error!!!')
                );
        },
        uploadAvatar(){
            var axios = require('axios');
            var FormData = require('form-data');
            var fs = require('fs');
            var data = new FormData();
            data.append('image', fs.createReadStream('/MyFiles/Downloads/tmp/fyllo_agona_gallis_premiera.jpg'));

            var config = {
                method: 'post',
                url: 'http://localhost/api/avatar/upload',
                headers: {
                    'Authorization': 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9sb2NhbGhvc3RcL2FwaVwvbG9naW4iLCJpYXQiOjE2MDc1NzI5NzYsImV4cCI6MTYwNzU3NjU3NiwibmJmIjoxNjA3NTcyOTc2LCJqdGkiOiIxdk1aa25rNnExVkgyQ0ZoIiwic3ViIjoxLCJwcnYiOiI4N2UwYWYxZWY5ZmQxNTgxMmZkZWM5NzE1M2ExNGUwYjA0NzU0NmFhIn0.Q3d2YpWrfbmXXwBF52le3EP21PpIaGaRxbIzcEbo-ss',
                    'Cookie': 'JSESSIONID=35405D33B49EECA4BFE709DFCFF2215D',
                    ...data.getHeaders()
                },
                data : data
            };

            axios(config)
                .then(function (response) {
                    console.log(JSON.stringify(response.data));
                })
                .catch(function (error) {
                    console.log(error);
                });
        }
    }
}
</script>

<style scoped>

</style>
