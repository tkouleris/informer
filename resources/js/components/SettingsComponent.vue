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
                        <div class="row">
                            <div class="col-md-6">
                                <input type="file" id="avatarToUpload" name="image" class="form-control" @change="selectFile">
                            </div>
                            <div class="col-md-6">
                                <button @click="uploadAvatar"  class="btn btn-success">Upload</button>
                            </div>
                        </div>

                    </div>
                    <div class="card-header">
                        <h2 style="color: #000000;">Change Password</h2>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-danger d-none" id="password_notification" role="alert">
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
                                <button @click="updatePassword" class="btn btn-primary">
                                    Update Password
                                </button>
                            </div>
                        </div>
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
            selectedFile:null,
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
        selectFile(event){
            this.selectedFile = event.target.files[0]
        },
        uploadAvatar(){
            const fd = new FormData();
            fd.append('image',this.selectedFile, this.selectedFile.name);
            let full_url = config.API_URL + "/api/avatar/upload";
            axios.post(full_url,fd,this.header)
            .then(response=>{
                console.log(response)
            })
        },
        updatePassword(){
            if(!$('#password_notification').hasClass('d-none')){
                $('#password_notification').addClass('d-none')
            }
            let new_password = $('[name=new_password]').val();
            let password_confirm = $('[name=password_confirm]').val();

            let data = {
                'new_password': new_password,
                'password_confirm':password_confirm
            }
            let full_url = config.API_URL + "/api/settings/update-password";
            axios.post(full_url,data,this.header)
                .then(response=>{
                   alert('Password Changed!');
                }).catch( response=>{
                    $('#password_notification').removeClass('d-none');
                });
        }
    },

}
</script>

<style scoped>

</style>
