<template>
    <div class="container">
        <div class="row justify-content-center mt-1">
            <div class="col-md-12">
                <div>
                    <button @click="unfavorite()" class="btn btn-danger" v-if="result">
                        いいね解除
                    </button>
                    <button @click="favorite()" class="btn btn-success" v-else>
                        いいね
                    </button>
                    <p>いいね数：{{ count }}</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            post: {required:true},
        },
        data() {
            return {
                count: "",
                result: "false"
            }
        },
        mounted () {
            this.hasfavorites();
            this.countfavorites();
        },
        methods: {
            favorite() {
                try {
                    axios.get('/posts/' + this.post.id +'/favorites');
                        this.countfavorites();
                        this.hasfavorites();
                } catch (e) {
                    console.error(e)
                }
            },
            unfavorite() {
                try {
                    axios.get('/posts/' + this.post.id +'/unfavorites');
                        this.countfavorites();
                        this.hasfavorites();
                } catch (e) {
                    console.error(e)
                }
            },
            countfavorites() {
                try {
                    axios.get('/posts/' + this.post.id +'/countfavorites')
                        .then(res => {
                            this.count = res.data;
                        });
                } catch (e) {
                    console.error(e)
                }
            },
            hasfavorites() {
                try {
                    axios.get('/posts/' + this.post.id +'/hasfavorites')
                        .then(res => {
                            this.result = res.data;
                        });
                } catch (e) {
                    console.error(e)
                }
            }
        }
    }
</script>
