<template>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-body">
                    <div>
                        <p style="color: #000000">
                            <b> {{ this.article.source.name }} </b> - {{ this.article.publishedAt }}
                        </p>
                        <img width="100%" height="350px;" :src="img" />
                        <a :href="url" target="_blank"  ><h3>{{ this.article.title }}</h3></a>
                        <p style="color: #000000">{{ this.article.description }}</p>
                    </div>
                    <div style="margin-bottom: 10px;">
                        <span style="color: black;">category: </span><span style="color: black;font-weight: bold;">{{ this.article.category }}</span>
                    </div>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "ArticleComponent",
    props:['article'],
    data: function () {
        return {
            url: null,
            img: null
        }
    },
    mounted() {
        this.url = this.article.url
        this.img = this.article.urlToImage;
    }
}
</script>

<style scoped>

</style>
