<template>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <input class="form-control" type="text"
                           v-model="txt_search"
                           placeholder="Search"
                           aria-label="Search"
                           value=""
                           @keypress="search_news($event)"
                    >
                    <i class="fas fa-search" aria-hidden="true"></i>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "SearchComponent",
    data: function () {
        return {
            txt_search: null,
        }
    },
    methods:{
        getSearchString()
        {
            return this.txt_search;
        },
        search_news($event)
        {
            if ($event.keyCode !== 13) {
                return;
            }
            this.$parent.getNews(this.txt_search);
        }
    }

}
</script>

<style scoped>

</style>
